<?php

include_once 'db.php';


$id_empresa = $_SESSION['id_usuario'];  // ou $_SESSION['id_empresa'] conforme seu sistema

$sql = "SELECT COUNT(*) AS total FROM estagios WHERE empresa_id = ? AND status = 'Em curso'";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Erro ao preparar a SQL: " . $conn->error);
}

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

?>
