<?php
include_once 'db.php';
session_start();

$id_estagiario = $_GET['id'];

// Buscar dados da vaga
$sql = "SELECT * FROM estagiarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_estagiario);
$stmt->execute();
$result = $stmt->get_result();
$estagiario = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $empresa_ìd = $_POST['empresa'];
    $curso = $_POST['curso'];
    $duracao = $_POST['duracao'];
    $periodo = $_POST['periodo'];
    $inicio = $_POST['inicio'];
    $termino = $_POST['termino'];
    $status = $_POST['status'];
    $estagiario = $_POST['estagiario'];

    $sql = "UPDATE estagiarios SET empresa_id=?, curso=?, duracao=?, periodo=?, inicio=?, termino=?, status=?, estagiario=?
            WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssssi", $empresa_id, $curso, $duracao, $periodo, $inicio, $termino, $status, $estagiario, $id_estagiario);

    if ($stmt->execute()) {
        echo "Cadastro alterado com sucesso!!";
    } else {
        echo "Erro ao atualizar: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>
