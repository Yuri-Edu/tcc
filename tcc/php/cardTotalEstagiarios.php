<?php
include_once 'db.php';


$id_empresa = $_SESSION['id_usuario'];  // ou id_empresa, dependendo da sua sessão

$sql = "SELECT COUNT(*) AS total FROM estagios WHERE empresa_id = ?";
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

?>
