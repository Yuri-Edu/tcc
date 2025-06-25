<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once 'db.php';

$aluno_id = $_SESSION['id_usuario'];

$sql = "SELECT 
            c.id AS candidatura_id,
            v.titulo,
            v.empresa,
            v.localidade,
            v.modalidade,
            v.curso,
            v.valor_bolsa,
            c.data_candidatura,
            c.status
        FROM candidaturas c
        INNER JOIN vagas v ON c.vaga_id = v.id
        WHERE c.aluno_id = ?
        ORDER BY c.data_candidatura DESC";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    $erro = "Erro na preparação da consulta: " . $conn->error;
} else {
    $stmt->bind_param("i", $aluno_id);
    if (!$stmt->execute()) {
        $erro = "Erro na execução da consulta: " . $stmt->error;
    } else {
        $result = $stmt->get_result();
    }
    $stmt->close();
}
$conn->close();
?>
