<?php
session_start();
include 'db.php'; // conexao mysqli

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mensagem_id = $_POST['mensagem_id'] ?? null;
    $resposta = trim($_POST['resposta'] ?? '');
    $remetente_id = $_SESSION['id'] ?? null; // usuário logado

    if (!$mensagem_id || !$resposta || !$remetente_id) {
        echo "Dados inválidos.";
        exit;
    }

    // Busca remetente original da mensagem para definir destinatário da resposta
    $stmt = $conn->prepare("SELECT remetente_id FROM mensagens WHERE id = ?");
    $stmt->bind_param("i", $mensagem_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $msg_original = $result->fetch_assoc();

    if (!$msg_original) {
        echo "Mensagem original não encontrada.";
        exit;
    }

    $destinatario_id = $msg_original['remetente_id'];

    // Buscar assunto original para prefixar
    $stmtAssunto = $conn->prepare("SELECT assunto FROM mensagens WHERE id = ?");
    $stmtAssunto->bind_param("i", $mensagem_id);
    $stmtAssunto->execute();
    $resAssunto = $stmtAssunto->get_result();
    $assunto = "RE: ";
    if ($resAssunto->num_rows > 0) {
        $rowAssunto = $resAssunto->fetch_assoc();
        $assunto .= $rowAssunto['assunto'];
    } else {
        $assunto .= "Sem assunto";
    }

    // Insere resposta
    $stmtInsert = $conn->prepare("INSERT INTO mensagens (remetente_id, destinatario_id, assunto, corpo, data_envio) VALUES (?, ?, ?, ?, NOW())");
    $stmtInsert->bind_param("iiss", $remetente_id, $destinatario_id, $assunto, $resposta);
    $stmtInsert->execute();

    if ($stmtInsert->affected_rows > 0) {
        // Atualizar status respondida na mensagem original
        $stmtUpdate = $conn->prepare("UPDATE mensagens SET respondida = 1 WHERE id = ?");
        $stmtUpdate->bind_param("i", $mensagem_id);
        $stmtUpdate->execute();

        header("Location: ../interface.php?secao=mensagens&status=resposta_enviada");
        exit;
    } else {
        echo "Erro ao enviar resposta.";
        exit;
    }
} else {
    echo "Acesso inválido.";
    exit;
}
