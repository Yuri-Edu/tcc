<?php
session_start();
include 'db.php';

$remetente = $_SESSION['id'] ?? null;
$mensagem_id = $_POST['mensagem_id'] ?? null;
$resposta = $_POST['resposta'] ?? '';

if (!$remetente || !$mensagem_id || !$resposta) {
    die('Dados incompletos');
}

// Pega a mensagem original para identificar o destinatário
$sql = "SELECT remetente_id FROM mensagens WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $mensagem_id);
$stmt->execute();
$result = $stmt->get_result();
$mensagemOriginal = $result->fetch_assoc();

if (!$mensagemOriginal) {
    die('Mensagem original não encontrada');
}

$destinatario = $mensagemOriginal['remetente_id'];
$assunto = "RE: Resposta da sua mensagem";

// Inserir resposta como nova mensagem
$sql = "INSERT INTO mensagens (remetente_id, destinatario_id, assunto, mensagem) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiss", $remetente, $destinatario, $assunto, $resposta);
$stmt->execute();

header('Location: ../pagina_com_chat.php');
exit;
?>
