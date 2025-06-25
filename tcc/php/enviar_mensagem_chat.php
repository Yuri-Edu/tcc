<?php
session_start();
include 'db.php';

$remetente = $_SESSION['id'] ?? null;
$destinatario_email = $_POST['destinatario'] ?? '';
$assunto = $_POST['assunto'] ?? '';
$mensagem = $_POST['mensagem'] ?? '';
$anexo = null;

// Validação simples
if (!$remetente || !$destinatario_email || !$assunto || !$mensagem) {
    die('Dados incompletos');
}

// Buscar o destinatário pelo e-mail
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $destinatario_email);
$stmt->execute();
$result = $stmt->get_result();
$dest = $result->fetch_assoc();

if (!$dest) {
    die('Destinatário não encontrado');
}

$destinatario = $dest['id'];

// Upload de anexo (se houver)
if (!empty($_FILES['anexo']['name'])) {
    $pasta = '../uploads/';
    if (!is_dir($pasta)) mkdir($pasta, 0777, true);

    $nomeArquivo = time() . '_' . basename($_FILES['anexo']['name']);
    $caminho = $pasta . $nomeArquivo;

    if (move_uploaded_file($_FILES['anexo']['tmp_name'], $caminho)) {
        $anexo = $nomeArquivo;
    }
}

// Inserir mensagem
$sql = "INSERT INTO mensagens (remetente_id, destinatario_id, assunto, mensagem, anexo) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iisss", $remetente, $destinatario, $assunto, $mensagem, $anexo);
$stmt->execute();

header('Location: ../pagina_com_chat.php');
exit;
?>
