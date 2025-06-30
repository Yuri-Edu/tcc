<?php
session_start();
include 'db.php';

$id_instituicao = $_SESSION['id_instituicao'] ?? null;

if (!$id_instituicao) {
  echo json_encode(["erro" => "Instituição não logada."]);
  exit;
}

$sql = "SELECT id, nome, email, cpf, telefone FROM alunos WHERE instituicao_id = ? ORDER BY nome";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_instituicao);
$stmt->execute();
$result = $stmt->get_result();

$alunos = [];
while ($row = $result->fetch_assoc()) {
  $alunos[] = $row;
}

echo json_encode($alunos);
