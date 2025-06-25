<?php
function obterDadosDashboard($conn, $id, $campo_id) {
    $dados = [];

    // Estágios cadastrados
    $sql1 = "SELECT COUNT(*) AS total FROM estagios WHERE $campo_id = ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param('i', $id);
    $stmt1->execute();
    $res1 = $stmt1->get_result();
    $dados['estagios_cadastrados'] = $res1->fetch_assoc()['total'] ?? 0;
    $stmt1->close();

    // Estágios pendentes
    $sql2 = "SELECT COUNT(*) AS total FROM estagios WHERE status = 'pendente' AND $campo_id = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param('i', $id);
    $stmt2->execute();
    $res2 = $stmt2->get_result();
    $dados['estagios_pendentes'] = $res2->fetch_assoc()['total'] ?? 0;
    $stmt2->close();

    // Vagas criadas
    $sql3 = "SELECT COUNT(*) AS total FROM vagas WHERE $campo_id = ?";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->bind_param('i', $id);
    $stmt3->execute();
    $res3 = $stmt3->get_result();
    $dados['vagas_criadas'] = $res3->fetch_assoc()['total'] ?? 0;
    $stmt3->close();

    // Relatórios aguardando
    $sql4 = "SELECT COUNT(*) AS total FROM relatorios WHERE status = 'pendente' AND $campo_id = ?";
    $stmt4 = $conn->prepare($sql4);
    $stmt4->bind_param('i', $id);
    $stmt4->execute();
    $res4 = $stmt4->get_result();
    $dados['relatorios_aguardando'] = $res4->fetch_assoc()['total'] ?? 0;
    $stmt4->close();

    // Documentos pendentes
    $sql5 = "SELECT COUNT(*) AS total FROM documentos WHERE status = 'pendente' AND $campo_id = ?";
    $stmt5 = $conn->prepare($sql5);
    $stmt5->bind_param('i', $id);
    $stmt5->execute();
    $res5 = $stmt5->get_result();
    $dados['documentos_pendentes'] = $res5->fetch_assoc()['total'] ?? 0;
    $stmt5->close();

    return $dados;
}
?>
