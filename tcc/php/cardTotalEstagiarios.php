<?php
include_once 'db.php';
session_start();

$id_empresa = $_SESSION['id_usuario'];  // ou id_empresa, dependendo da sua sessão

$sql = "SELECT COUNT(*) AS total FROM estagiarios WHERE id_empresa = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_empresa);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    $dados = $result->fetch_assoc();
    echo $dados['total'];
} else {
    echo "0";
}

$stmt->close();
$conn->close();
?>
