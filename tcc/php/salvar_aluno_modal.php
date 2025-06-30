<?php
session_start();
include 'db.php';

$id_instituicao = $_SESSION['id_instituicao'] ?? null;
if (!$id_instituicao) {
  echo json_encode(['erro' => 'Instituição não autenticada.']);
  exit;
}

$nome      = $_POST['nome'] ?? '';
$matricula = $_POST['matricula'] ?? '';
$email     = $_POST['email'] ?? '';
$curso     = $_POST['curso'] ?? '';
$periodo   = $_POST['periodo'] ?? '';
$turno     = $_POST['turno'] ?? '';

if (empty($nome) || empty($matricula) || empty($email)) {
  echo json_encode(['erro' => 'Preencha os campos obrigatórios.']);
  exit;
}

$sql = "INSERT INTO alunos (nome, matricula, email, curso, periodo, turno, instituicao_id)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssi", $nome, $matricula, $email, $curso, $periodo, $turno, $id_instituicao);

if ($stmt->execute()) {
  echo json_encode(['sucesso' => true]);
} else {
  echo json_encode(['erro' => 'Erro ao salvar: ' . $stmt->error]);
}
