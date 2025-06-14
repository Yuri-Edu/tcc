<?php
session_start();
include 'db.php'; // conexão MySQLi: $conn

// Verifica se o usuário está logado e pega o ID
if (!isset($_SESSION['id'])) {
    echo "Usuário não autenticado.";
    exit;
}
$usuario_id = $_SESSION['id'];

// Prepared statement para buscar mensagens do usuário
$sql = "SELECT m.id, m.assunto, m.corpo, m.data_envio, u.email AS remetente_email
        FROM mensagens m
        JOIN usuarios u ON u.id = m.remetente_id
        WHERE m.destinatario_id = ?
        ORDER BY m.data_envio DESC";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        // Botão da lista de mensagens
        echo "<button class='list-group-item bg-dark text-white mensagem' data-id='" . $row['id'] . "' data-bs-toggle='modal' data-bs-target='#modalMensagem" . $row['id'] . "'>";
        echo "<strong>📧 Assunto:</strong> " . htmlspecialchars($row['assunto']) . "<br>";
        echo "<small>De: " . htmlspecialchars($row['remetente_email']) . " | " . date('d/m/Y', strtotime($row['data_envio'])) . "</small>";
        echo "</button>";

        // Modal da mensagem
        echo "
        <div class='modal fade' id='modalMensagem" . $row['id'] . "' tabindex='-1' aria-labelledby='modalMensagem" . $row['id'] . "Label' aria-hidden='true'>
            <div class='modal-dialog modal-lg modal-dialog-scrollable'>
                <div class='modal-content bg-dark text-white'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='modalMensagem" . $row['id'] . "Label'>Assunto: " . htmlspecialchars($row['assunto']) . "</h5>
                        <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal'></button>
                    </div>
                    <div class='modal-body'>
                        <p><strong>Remetente:</strong> " . htmlspecialchars($row['remetente_email']) . "</p>
                        <p><strong>Data:</strong> " . date('d/m/Y H:i', strtotime($row['data_envio'])) . "</p>
                        <hr>
                        <p>" . nl2br(htmlspecialchars($row['corpo'])) . "</p>";

        // Busca anexos para essa mensagem (prepared statement)
        $sqlAnexo = "SELECT nome_arquivo, caminho_arquivo FROM anexos_mensagem WHERE mensagem_id = ?";
        if ($stmtAnexo = $conn->prepare($sqlAnexo)) {
            $stmtAnexo->bind_param("i", $row['id']);
            $stmtAnexo->execute();
            $resultAnexo = $stmtAnexo->get_result();

            if ($resultAnexo->num_rows > 0) {
                while ($anexo = $resultAnexo->fetch_assoc()) {
                    echo "<hr><p><strong>Anexo:</strong> <a class='link-success' href='" . htmlspecialchars($anexo['caminho_arquivo']) . "' download>" . htmlspecialchars($anexo['nome_arquivo']) . "</a></p>";
                }
            }
            $stmtAnexo->close();
        }

        echo "
                    </div>
                </div>
            </div>
        </div>";
    }

    $stmt->close();
} else {
    echo "Erro na consulta: " . $conn->error;
}

?>
