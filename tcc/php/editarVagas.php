<?php
include_once 'db.php';
session_start();

// ✅ Verifica se o ID foi passado corretamente
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID da vaga não informado ou inválido.");
}

$id_vaga = (int) $_GET['id'];

// 🔍 Busca os dados da vaga
$sql = "SELECT * FROM vagas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_vaga);
$stmt->execute();
$result = $stmt->get_result();
$vaga = $result->fetch_assoc();

// ❗ Se a vaga não for encontrada
if (!$vaga) {
    die("Vaga não encontrada.");
}

// ✅ Se for envio de formulário (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $requisitos = $_POST['requisitos'];
    $curso = $_POST['curso'];
    $turno = $_POST['turno'];
    $tipo = $_POST['tipo'];
    $status = $_POST['status'];

    $sql = "UPDATE vagas 
            SET titulo=?, descricao=?, requisitos=?, curso=?, turno=?, tipo=?, status=? 
            WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $titulo, $descricao, $requisitos, $curso, $turno, $tipo, $status, $id_vaga);

    if ($stmt->execute()) {
        echo "Vaga atualizada!";
        header("Location: listar_vagas.php");
        exit;
    } else {
        echo "Erro ao atualizar: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>
