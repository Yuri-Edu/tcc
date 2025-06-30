<?php
session_start();
include 'db.php';

$status = $_GET['status'] ?? '';
$usuario_tipo = $_SESSION['tipo_usuario'] ?? 'instituicao'; // 'empresa' ou 'instituicao'
$id_usuario = $_SESSION['id_usuario'] ?? null;

$sql = "SELECT 
          contratos.id AS contrato_id,
          alunos.nome AS aluno_nome,
          empresa.nome AS empresa_nome,
          alunos.curso AS curso,
          contratos.carga_horaria,
          contratos.inicio,
          contratos.termino,
          contratos.status,
          vagas.turno
        FROM contratos
        JOIN candidaturas ON contratos.candidatura_id = candidaturas.id
        JOIN alunos ON candidaturas.aluno_id = alunos.id
        JOIN vagas ON candidaturas.vaga_id = vagas.id
        JOIN empresa ON vagas.empresa_id = empresa.id";


$where = [];
$params = [];
$tipos = "";

// Filtro por status (se informado)
if (!empty($status)) {
  $where[] = "contratos.status = ?";
  $params[] = $status;
  $tipos .= "s";
}

// Se for empresa, filtra pelos contratos das vagas dela
if ($usuario_tipo === "empresa") {
  $where[] = "empresa.id_usuario = ?";
  $params[] = $id_usuario;
  $tipos .= "i";
}

// Aplica os filtros na query
if (!empty($where)) {
  $sql .= " WHERE " . implode(" AND ", $where);
}

$stmt = $conn->prepare($sql);
if (!empty($params)) {
  $stmt->bind_param($tipos, ...$params);
}
if (!$stmt) {
  die("Erro ao preparar SQL: " . $conn->error . "\nSQL: " . $sql);
}


$stmt->execute();
$result = $stmt->get_result();

$estagios = [];
while ($row = $result->fetch_assoc()) {
  $estagios[] = $row;
}

echo json_encode($estagios);
?>
