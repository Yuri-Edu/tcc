<?php
session_start();
include 'db.php';

header('Content-Type: application/json');

// Verifica se o usuário está logado
$usuario_id = $_SESSION['id'] ?? 0;
if ($usuario_id == 0) {
    echo json_encode(["error" => "Usuário não logado."]);
    exit;
}

$busca = $_GET['busca'] ?? '';
$filtro = $_GET['filtro'] ?? 'todos';

// Monta a SQL
$sql = "SELECT 
            m.id, 
            u.email AS remetente, 
            m.assunto, 
            m.corpo, 
            m.data_envio, 
            u.tipo_usuario 
        FROM mensagens m
        JOIN usuarios u ON m.remetente_id = u.id
        WHERE m.destinatario_id = ? ";

$params = [$usuario_id];
$types = "i";

// Filtro de busca
if (!empty($busca)) {
    $sql .= " AND (m.assunto LIKE ? OR u.email LIKE ?) ";
    $params[] = "%$busca%";
    $params[] = "%$busca%";
    $types .= "ss";
}

// Filtro por tipo de usuário
if ($filtro !== 'todos') {
    $sql .= " AND u.tipo_usuario = ? ";
    $params[] = $filtro;
    $types .= "s";
}

$sql .= " ORDER BY m.data_envio DESC";

// Prepara a SQL
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["error" => "Erro na preparação da consulta: " . $conn->error]);
    exit;
}

// Faz o bind dos parâmetros
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

// Executa
$stmt->execute();
$result = $stmt->get_result();

// Monta o retorno
$mensagens = [];
while ($row = $result->fetch_assoc()) {
    $mensagens[] = $row;
}

// Retorna como JSON
echo json_encode($mensagens);
