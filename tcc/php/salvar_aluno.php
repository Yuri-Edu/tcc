<?php
session_start();
include 'db.php'; // Garante que $conn está definido

header('Content-Type: application/json');

$id_usuario = $_SESSION['id_usuario'] ?? null;
if (!$id_usuario) {
    echo json_encode(["erro" => "Usuário não logado."]);
    exit;
}

// Coleta de dados do formulário
$nome     = $_POST['nome']     ?? '';
$genero   = $_POST['genero']   ?? '';
$email    = $_POST['email']    ?? '';
$cpf      = $_POST['cpf']      ?? '';
$telefone = $_POST['telefone'] ?? '';
$id_instituicao = $_POST['instituicao_id'] ?? '';
$outra_instituicao = trim($_POST['outra_instituicao'] ?? '');

// Valida a instituição selecionada ou insere nova
if ($id_instituicao === 'outra') {
    if ($outra_instituicao === '') {
        echo json_encode(["erro" => "Você selecionou 'Outra instituição', mas não preencheu o nome."]);
        exit;
    }

    // Verifica se já existe uma instituição com esse nome
    $stmt = $conn->prepare("SELECT id FROM instituicao WHERE LOWER(TRIM(nome)) = LOWER(TRIM(?))");
    $stmt->bind_param("s", $outra_instituicao);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $id_instituicao = $res->fetch_assoc()['id'];
    } else {
        // Insere nova instituição
        $stmt = $conn->prepare("INSERT INTO instituicao (nome) VALUES (?)");
        $stmt->bind_param("s", $outra_instituicao);
        if (!$stmt->execute()) {
            echo json_encode(["erro" => "Erro ao inserir nova instituição: " . $stmt->error]);
            exit;
        }
        $id_instituicao = $stmt->insert_id;
    }
} else {
    $id_instituicao = intval($id_instituicao); // Segurança: força número
}

// Atualiza dados do aluno no banco, incluindo id_instituicao e genero
$sql = "UPDATE alunos SET nome = ?, genero = ?, email = ?, cpf = ?, telefone = ?, id_instituicao = ? WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["erro" => "Erro no prepare: " . $conn->error]);
    exit;
}

$stmt->bind_param("ssssssi", $nome, $genero, $email, $cpf, $telefone, $id_instituicao, $id_usuario);

if ($stmt->execute()) {
    echo json_encode(["sucesso" => true]);
} else {
    echo json_encode(["erro" => "Erro ao salvar no banco: " . $stmt->error]);
}
