<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $arquivo = $_POST['arquivo'] ?? '';

    if ($id && $arquivo) {
        // Deleta do banco
        $stmt = $conn->prepare("DELETE FROM relatorios WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Deleta arquivo do servidor
            if (file_exists($arquivo)) {
                unlink($arquivo);
            }
            header("Location: ../area-empresa.php?excluido=ok");
            exit;
        } else {
            echo "Erro ao excluir: " . $stmt->error;
        }
    } else {
        echo "Dados inválidos.";
    }

    $conn->close();
}
?>
