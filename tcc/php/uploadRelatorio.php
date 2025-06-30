<?php
include_once 'db.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => 'Erro desconhecido.'];

    $nome = trim($_POST['relatorioName'] ?? '');
    $categoria = trim($_POST['relatorioCategory'] ?? '');
    $dataUpload = date("Y-m-d");

    if (isset($_FILES['relatorioFile']) && $_FILES['relatorioFile']['error'] === 0) {
        $arquivo = $_FILES['relatorioFile'];

        $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
        if ($extensao !== 'pdf') {
            $response['message'] = "Apenas arquivos PDF são permitidos.";
            echo json_encode($response);
            exit;
        }

        // Verifica MIME
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $arquivo['tmp_name']);
        finfo_close($finfo);
        if ($mime !== 'application/pdf') {
            $response['message'] = "Arquivo não é PDF válido.";
            echo json_encode($response);
            exit;
        }

        $pastaDestino = __DIR__ . '/../relatorios/';
        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0755, true);
        }

        $nomeUnico = uniqid('relatorio_', true) . '.pdf';
        $caminhoFisico = $pastaDestino . $nomeUnico;
        $caminhoParaBanco = 'relatorios/' . $nomeUnico; // caminho relativo para uso na aplicação

        if (move_uploaded_file($arquivo['tmp_name'], $caminhoFisico)) {
            $sql = "INSERT INTO relatorios (titulo, descricao, data_envio, caminho_arquivo, status)
                    VALUES (?, ?, ?, ?, 'ativo')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $nome, $categoria, $dataUpload, $caminhoParaBanco);

            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = "Relatório enviado com sucesso.";
            } else {
                $response['message'] = "Erro ao salvar no banco: " . $stmt->error;
            }
        } else {
            $response['message'] = "Erro ao mover o arquivo.";
        }
    } else {
        $response['message'] = "Nenhum arquivo enviado ou erro no upload.";
    }

    $conn->close();
    echo json_encode($response);
    exit;
}
