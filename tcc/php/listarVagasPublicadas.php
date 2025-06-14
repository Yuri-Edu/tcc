<?php
include_once 'db.php';

$filtro_curso = $_GET['curso'] ?? '';
$filtro_localidade = $_GET['localidade'] ?? '';
$filtro_tipo = $_GET['tipo'] ?? '';
$busca = $_GET['busca'] ?? '';

// SQL base
$sql = "SELECT * FROM vagas WHERE status = 'ativa'";
$param = [];
$types = '';

// Filtros dinâmicos
if (!empty($filtro_curso)) {
    $sql .= " AND curso = ?";
    $param[] = $filtro_curso;
    $types .= 's';
}

if (!empty($filtro_localidade)) {
    $sql .= " AND localidade = ?";
    $param[] = $filtro_localidade;
    $types .= 's';
}

if (!empty($filtro_tipo)) {
    $sql .= " AND tipo = ?";
    $param[] = $filtro_tipo;
    $types .= 's';
}

if (!empty($busca)) {
    $sql .= " AND (titulo LIKE ? OR empresa LIKE ? OR localidade LIKE ?)";
    $busca_param = "%$busca%";
    $param[] = $busca_param;
    $param[] = $busca_param;
    $param[] = $busca_param;
    $types .= 'sss';
}

$sql .= " ORDER BY data_publicacao DESC";

// Prepara a query
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo '<div class="alert alert-danger">Erro na preparação da consulta: ' . $conn->error . '</div>';
    exit;
}

if ($param) {
    $stmt->bind_param($types, ...$param);
}

if (!$stmt->execute()) {
    echo '<div class="alert alert-danger">Erro na execução da consulta: ' . $stmt->error . '</div>';
    exit;
}

$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    while ($vaga = $result->fetch_assoc()) {
        echo '<div class="col-md-6 mb-4">';
        echo '  <div class="card-dark p-3 bg-dark text-white h-100">';
        echo '    <h5>' . htmlspecialchars($vaga['titulo']) . '</h5>';
        echo '    <p class="mb-1">' . htmlspecialchars($vaga['empresa'] ?? 'Empresa não informada') . '</p>';

        echo '    <p class="text-muted mb-2">';
        if (!empty($vaga['localidade'])) {
            echo htmlspecialchars($vaga['localidade']);
        }
        if (!empty($vaga['localidade']) && !empty($vaga['tipo'])) {
            echo ' • ';
        }
        if (!empty($vaga['tipo'])) {
            echo htmlspecialchars($vaga['tipo']);
        }
        echo '</p>';

        echo '    <small>Curso: ' . htmlspecialchars($vaga['curso']) . '</small><br>';

        if (!empty($vaga['bolsa'])) {
            echo '    <small>Bolsa: R$ ' . number_format($vaga['bolsa'], 2, ',', '.') . '</small>';
        }

        echo '    <div class="d-grid gap-2 mt-3">';
        echo '      <a href="detalhes_vaga.php?id=' . $vaga['id'] . '" class="btn btn-primary">';
        echo '        <i class="bi bi-eye-fill me-1"></i> Visualizar Vaga';
        echo '      </a>';

        // Botão de candidatura
            echo '    <div class="d-grid gap-2 mt-3">';
            echo '      <button class="btn btn-primary" onclick="abrirDetalhes(' . $vaga['id'] . ')">';
            echo '        <i class="bi bi-eye-fill"></i> Visualizar Vaga';
            echo '      </button>';
            echo '    </div>';

        echo '    </div>';
        echo '  </div>';
        echo '</div>';
    }
} else {
    echo '<div class="alert alert-info text-center mx-auto my-auto " style="max-width: 600px;">
                <i class="bi bi-search"></i> 
                <strong>Ops!</strong>
              Nenhuma vaga encontrada.
            </div>';
}

$stmt->close();
$conn->close();
?>
