<?php
session_start();
include 'db.php';

if (!isset($_SESSION['id_usuario'])) {
    echo '<div class="alert alert-warning">Faça login para visualizar os detalhes.</div>';
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    echo '<div class="alert alert-danger">Vaga inválida.</div>';
    exit;
}

$sql = "SELECT * FROM vagas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $vaga = $result->fetch_assoc();
} else {
    echo '<div class="alert alert-danger">Vaga não encontrada.</div>';
    exit;
}

$stmt->close();
$conn->close();
?>

<h3><?php echo htmlspecialchars($vaga['titulo']); ?></h3>
<p><strong>Empresa:</strong> <?php echo htmlspecialchars($vaga['empresa'] ?? 'Não informada'); ?></p>
<p><strong>Localidade:</strong> <?php echo htmlspecialchars($vaga['localidade']); ?></p>
<p><strong>Tipo:</strong> <?php echo htmlspecialchars($vaga['tipo']); ?></p>
<p><strong>Curso:</strong> <?php echo htmlspecialchars($vaga['curso']); ?></p>

<?php if (!empty($vaga['bolsa'])): ?>
    <p><strong>Bolsa:</strong> R$ <?php echo number_format($vaga['bolsa'], 2, ',', '.'); ?></p>
<?php endif; ?>

<?php if (!empty($vaga['descricao'])): ?>
    <p><strong>Descrição:</strong><br><?php echo nl2br(htmlspecialchars($vaga['descricao'])); ?></p>
<?php endif; ?>

<?php if (!empty($vaga['requisitos'])): ?>
    <p><strong>Requisitos:</strong><br><?php echo nl2br(htmlspecialchars($vaga['requisitos'])); ?></p>
<?php endif; ?>

<form action="candidatar.php" method="post">
    <input type="hidden" name="vaga_id" value="<?php echo $vaga['id']; ?>">
    <button type="submit" class="btn btn-success mt-3">
        <i class="bi bi-send-fill me-1"></i> Candidatar-se
    </button>
</form>
