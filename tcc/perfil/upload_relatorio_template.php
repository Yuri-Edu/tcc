<?php
require_once '../php/db.php';
require_once '../vendor/autoload.php'; // Dompdf
include_once '../php/uploadRelatorio.php'; // Função para exibir alertas
// Exemplo simples para mostrar alertas via $_GET
function exibirAlerta() {
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        if ($status === 'sucesso') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Relatório enviado com sucesso!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>';
        } elseif ($status === 'erro') {
            $msg = isset($_GET['msg']) ? htmlspecialchars($_GET['msg']) : 'Erro desconhecido.';
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Erro: ' . $msg . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Upload de Relatório</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #121212;
      color: #eee;
      padding: 2rem;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }
    .form-control,
    .form-select {
      background-color: #222;
      color: #eee;
      border-color: #444;
    }
    .form-control::placeholder {
      color: #bbb;
    }
    .form-control:focus,
    .form-select:focus {
      background-color: #333;
      color: #fff;
      border-color: #0d6efd;
      box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 0.25);
    }
    #spinnerUpload {
      vertical-align: middle;
    }
  </style>
</head>
<body>

  <div class="container" style="max-width: 480px;">
    <h1 class="mb-4">Enviar Novo Relatório</h1>

    <?php exibirAlerta(); ?>

    <form id="formUploadRelatorio" action="../php/uploadRelatorio.php" method="POST" enctype="multipart/form-data" novalidate>
      <div class="mb-3">
        <label for="relatorioName" class="form-label">Nome do Relatório</label>
        <input type="text" class="form-control" id="relatorioName" name="relatorioName" placeholder="Ex: Relatório Financeiro Julho" required />
        <div class="invalid-feedback">
          Por favor, informe o nome do relatório.
        </div>
      </div>

      <div class="mb-3">
        <label for="relatorioCategory" class="form-label">Categoria</label>
        <select class="form-select" id="relatorioCategory" name="relatorioCategory" required>
          <option value="" selected disabled>Escolha a categoria</option>
          <option value="Relatório Financeiro">Relatório Financeiro</option>
          <option value="Relatório de Vagas">Relatório de Vagas</option>
          <option value="Relatório de Estágios">Relatório de Estágios</option>
        </select>
        <div class="invalid-feedback">
          Selecione uma categoria válida.
        </div>
      </div>

      <div class="mb-3">
        <label for="relatorioFile" class="form-label">Arquivo (PDF, máximo 5MB)</label>
        <input
          type="file"
          class="form-control"
          id="relatorioFile"
          name="relatorioFile"
          accept="application/pdf"
          required
        />
        <div class="invalid-feedback">
          Por favor, envie um arquivo PDF válido.
        </div>
      </div>

      <div class="mb-3">
        <button type="submit" class="btn btn-primary" id="btnSubmit">
          Salvar Relatório
        </button>
        <div
          id="spinnerUpload"
          class="spinner-border text-primary d-none"
          role="status"
          style="margin-left: 10px;"
        >
          <span class="visually-hidden">Carregando...</span>
        </div>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    (() => {
      const form = document.getElementById('formUploadRelatorio');
      const fileInput = document.getElementById('relatorioFile');
      const btnSubmit = document.getElementById('btnSubmit');
      const spinner = document.getElementById('spinnerUpload');

      // Bootstrap validation styles (show feedback)
      form.addEventListener('submit', (e) => {
        if (!form.checkValidity()) {
          e.preventDefault();
          e.stopPropagation();
          form.classList.add('was-validated');
          return;
        }

        // Validar arquivo manualmente
        const file = fileInput.files[0];
        if (!file) {
          e.preventDefault();
          e.stopPropagation();
          alert('Selecione um arquivo PDF.');
          return;
        }
        if (file.type !== 'application/pdf') {
          e.preventDefault();
          e.stopPropagation();
          alert('Apenas arquivos PDF são permitidos.');
          return;
        }
        const maxSize = 5 * 1024 * 1024; // 5MB
        if (file.size > maxSize) {
          e.preventDefault();
          e.stopPropagation();
          alert('O arquivo deve ter no máximo 5MB.');
          return;
        }

        // Tudo certo, mostrar spinner e desabilitar botão
        spinner.classList.remove('d-none');
        btnSubmit.disabled = true;
      });
    })();
  </script>
</body>
</html>
