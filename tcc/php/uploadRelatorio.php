<?php
include_once 'db.php'; // conexão com o banco

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['relatorioName'];
    $categoria = $_POST['relatorioCategory'];
    $dataUpload = date("Y-m-d");

    // Verifica se o arquivo foi enviado
    if (isset($_FILES['relatorioFile']) && $_FILES['relatorioFile']['error'] === 0) {
        $arquivo = $_FILES['relatorioFile'];
        $nomeArquivo = basename($arquivo['name']);
        $caminhoDestino = '../relatorios/' . $nomeArquivo;

        // Cria a pasta uploads se não existir
        if (!is_dir('../uploads')) {
            mkdir('../uploads', 0755, true);
        }

        // Move o arquivo
        if (move_uploaded_file($arquivo['tmp_name'], $caminhoDestino)) {
            // Insere os dados no banco
            $sql = "INSERT INTO relatorios (nome, categoria, data_upload, caminho_arquivo) 
                    VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $nome, $categoria, $dataUpload, $caminhoDestino);

            if ($stmt->execute()) {
                header("Location: ../area-empresa.php?upload=sucesso");
                exit();
            } else {
                echo "Erro ao salvar no banco: " . $stmt->error;
            }
        } else {
            echo "Erro ao mover o arquivo.";
        }
    } else {
        echo "Nenhum arquivo enviado ou erro no upload.";
    }

    $conn->close();
}
?>
