<?php
session_start();
include 'db.php'; // conexão com o banco ($mysqli)

// ID do usuário logado
$id_usuario = $_SESSION['id_usuario'] ?? null;

if (!$id_usuario) {
    echo json_encode(["erro" => "Usuário não logado"]);
    exit;
}

$sql = "SELECT nome, genero,email, cpf, telefone FROM alunos WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(["erro" => "Aluno não encontrado"]);
}
