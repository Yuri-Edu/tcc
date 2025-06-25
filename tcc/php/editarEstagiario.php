<?php
include_once 'db.php';
session_start();

// ✅ Verifica se o parâmetro ID foi enviado via GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID do estagiário inválido ou não informado.");
}

$id_estagiario = (int) $_GET['id']; // Converte para inteiro por segurança

// 🔍 Busca dados do estágio
$sql = "SELECT * FROM estagios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_estagiario);
$stmt->execute();
$result = $stmt->get_result();
$estagiario = $result->fetch_assoc();

// ⚠️ Valida se encontrou
if (!$estagiario) {
    die("Estágio não encontrado.");
}

// ✅ Verifica se formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $empresa_id = $_POST['empresa'];
    $curso = $_POST['curso'];
    $duracao = $_POST['duracao'];
    $periodo = $_POST['periodo'];
    $inicio = $_POST['inicio'];
    $termino = $_POST['termino'];
    $status = $_POST['status'];
    $estagiario_nome = $_POST['estagiario'];

    $sql = "UPDATE estagios 
            SET empresa_id = ?, curso = ?, duracao = ?, periodo = ?, inicio = ?, termino = ?, status = ?, estagiario = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssssi", $empresa_id, $curso, $duracao, $periodo, $inicio, $termino, $status, $estagiario_nome, $id_estagiario);

    if ($stmt->execute()) {
        echo "Cadastro alterado com sucesso!";
    } else {
        echo "Erro ao atualizar: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>
