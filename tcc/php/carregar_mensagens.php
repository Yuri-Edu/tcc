<?php
include 'db.php';
session_start();

if (!isset($_SESSION['id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Usuário não autenticado']);
    exit;
}

$usuario_id = $_SESSION['id'];

$stmt = $conn->prepare("SELECT m.id, u.email AS remetente_email, m.assunto, m.data_envio, m.status, m.lida
                        FROM mensagens m
                        JOIN usuarios u ON m.remetente_id = u.id
                        WHERE m.destinatario_id = ?
                        ORDER BY m.data_envio DESC");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

$mensagens = [];
while ($row = $result->fetch_assoc()) {
    $mensagens[] = $row;
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($mensagens);
?>
