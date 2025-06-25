<?php
session_start();
include_once 'db.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['empresa_id']) && !isset($_SESSION['instituicao_id'])) {
    header('Location: ../tela_login/index.php');
    exit();
}

// Identifica quem está logado
if (isset($_SESSION['empresa_id'])) {
    $id = $_SESSION['empresa_id'];
    $campo_id = 'id_empresa';
} else {
    $id = $_SESSION['instituicao_id'];
    $campo_id = 'id_instituicao';
}

// Verifica se os dados foram enviados
if (isset($_POST['documentName'], $_POST['documentCategory']) && isset($_FILES['documentFile'])) {

    // Dados do formulário
    $nomeDocumento = trim($_POST['documentName']);
    $categoria = trim($_POST['documentCategory']);

    // Dados do arquivo
    $arquivo = $_FILES['documentFile'];
    $nomeArquivo = basename($arquivo['name']);
    $caminhoDestino = '../documentos/' . $nomeArquivo;

    // Validação simples (pode ser expandida)
    $permitidos = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png'];
    $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));

    if (!in_array($extensao, $permitidos)) {
        echo "Tipo de arquivo não permitido.";
        exit();
    }

    // Move o arquivo para a pasta documentos
    if (move_uploaded_file($arquivo['tmp_name'], $caminhoDestino)) {
        
        // Insere no banco de dados
        $sql = "INSERT INTO documentos (nome, categoria, arquivo, data_upload, status, $campo_id)
                VALUES (?, ?, ?, NOW(), 'pendente', ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nomeDocumento, $categoria, $nomeArquivo, $id);

        if ($stmt->execute()) {
            header('Location: ../perfil/empresa.php?upload=sucesso');
            exit();
        } else {
            echo "Erro ao salvar no banco de dados.";
        }

        $stmt->close();

    } else {
        echo "Erro ao fazer upload do arquivo.";
    }
} else {
    echo "Dados incompletos.";
}

$conn->close();
?>
