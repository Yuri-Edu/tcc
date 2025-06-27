
<?php
include_once 'db.php';


$id_empresa = $_SESSION['id_usuario'];

$sql = "SELECT * FROM estagios WHERE empresa_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_empresa);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['empresa']) . "</td>";
        echo "<td>" . htmlspecialchars($row['curso']) . "</td>";
        echo "<td>" . htmlspecialchars($row['duracao']) . "</td>";
        echo "<td>" . htmlspecialchars($row['periodo']) . "</td>";
        echo "<td>" . date('d/m/Y', strtotime($row['inicio'])) . "</td>";
        echo "<td>" . date('d/m/Y', strtotime($row['termino'])) . "</td>";
        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nome_estagiario']) . "</td>";
        echo "<td>
                <button class='btn btn-outline-light btn-sm'><i class='bi bi-pencil'></i></button>
                <button class='btn btn-outline-light btn-sm'><i class='bi bi-trash'></i></button>
                <button class='btn btn-outline-light btn-sm'><i class='bi bi-paperclip'></i></button>
                <button class='btn btn-outline-light btn-sm'><i class='bi bi-check-circle'></i></button>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='9' class='text-center'>Nenhum estágio encontrado</td></tr>";
}

$stmt->close();

?>
