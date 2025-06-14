<?php
session_start();
include 'db.php';

// Pegando remetente do usuário logado (melhor prática)
$remetente_id = $_SESSION['id'] ?? null;
if (!$remetente_id) {
    die("Usuário não logado.");
}

// Recebe dados do formulário com validação básica
$destinatario = trim($_POST['destinatario'] ?? '');
$assunto = trim($_POST['assunto'] ?? '');
$mensagem = trim($_POST['mensagem'] ?? '');

if (empty($destinatario) || empty($assunto) || empty($mensagem)) {
    die("Todos os campos são obrigatórios.");
}

// Buscar ID do destinatário
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $destinatario);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("Destinatário não encontrado.");
}

$destinatario_id = $row['id'];

// Inserir mensagem
$stmt = $conn->prepare("INSERT INTO mensagens (remetente_id, destinatario_id, assunto, corpo, data_envio, status, respondida) VALUES (?, ?, ?, ?, NOW(), 'novo', 0)");
$stmt->bind_param("iiss", $remetente_id, $destinatario_id, $assunto, $mensagem);
$stmt->execute();

$mensagem_id = $stmt->insert_id;

// Salvar anexo se existir
if (isset($_FILES['anexo']) && $_FILES['anexo']['error'] === 0) {
    $nome = $_FILES['anexo']['name'];
    $tmp = $_FILES['anexo']['tmp_name'];
    $tipo = $_FILES['anexo']['type'];
    $tamanho = $_FILES['anexo']['size'];

    // Validação simples (exemplo: limitar tamanho até 5MB)
    if ($tamanho > 5 * 1024 * 1024) {
        die("Arquivo muito grande. Máximo 5MB.");
    }

    // Defina o caminho para salvar uploads
    $destino = "../uploads/" . uniqid() . "_" . basename($nome);

    if (move_uploaded_file($tmp, $destino)) {
        $stmt = $conn->prepare("INSERT INTO anexos (mensagem_id, nome_arquivo, caminho_arquivo, tipo_arquivo, tamanho) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isssi", $mensagem_id, $nome, $destino, $tipo, $tamanho);
        $stmt->execute();
    } else {
        die("Erro ao salvar o arquivo.");
    }
}

header("Location: ../interface.php?secao=mensagens&status=enviado");
exit;
?>
