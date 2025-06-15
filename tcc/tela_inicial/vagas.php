<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Vagas de Estágio</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/estilo_tela_vagas.css" rel="stylesheet"> <!-- Arquivo CSS externo -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="body-dark">

<div class="container my-4">
  <h2 class="mb-4">Encontre a Vaga Ideal</h2>

  <!-- Formulário de busca -->
  <form action="vagas.php" method="get">
    <div class="input-group mb-4">
      <span class="input-group-text bg-dark border-light text-white">
        <i class="bi bi-search"></i>
      </span>
      <input 
        name="busca" 
        type="text" 
        id="buscaVaga" 
        class="form-control input-dark" 
        placeholder="Buscar por título, empresa, cidade, estado ou modalidade..."
        value="<?= htmlspecialchars($_GET['busca'] ?? '') ?>"
      >
      <button class="btn btn-primary" type="submit">Buscar</button>
      <a href="VagasDisponiveis.php" class="btn btn-secondary">Limpar</a>
    </div>

    <div class="row">
      <!-- Sidebar filtros -->
      <div class="col-md-3">
        <div class="sidebar-dark p-3 bg-dark text-white rounded">
          <h5>Filtros</h5>

          <!-- Curso -->
          <div class="mb-3">
            <label class="form-label">Curso</label>
            <select name="curso" class="form-select input-dark">
              <option value="">Todos</option>
              <option <?= ($_GET['curso'] ?? '') == 'Administração' ? 'selected' : '' ?>>Administração</option>
              <option <?= ($_GET['curso'] ?? '') == 'Engenharia' ? 'selected' : '' ?>>Engenharia</option>
              <option <?= ($_GET['curso'] ?? '') == 'Direito' ? 'selected' : '' ?>>Direito</option>
              <option <?= ($_GET['curso'] ?? '') == 'TI' ? 'selected' : '' ?>>TI</option>
              <option <?= ($_GET['curso'] ?? '') == 'Marketing' ? 'selected' : '' ?>>Marketing</option>
            </select>
          </div>

          <!-- Localidade -->
          <div class="mb-3">
            <label class="form-label">Localidade</label>
            <select name="localidade" class="form-select input-dark">
              <option value="">Todas</option>
              <option <?= ($_GET['localidade'] ?? '') == 'São Paulo' ? 'selected' : '' ?>>São Paulo</option>
              <option <?= ($_GET['localidade'] ?? '') == 'Rio de Janeiro' ? 'selected' : '' ?>>Rio de Janeiro</option>
              <option <?= ($_GET['localidade'] ?? '') == 'Belo Horizonte' ? 'selected' : '' ?>>Belo Horizonte</option>
              <option <?= ($_GET['localidade'] ?? '') == 'Curitiba' ? 'selected' : '' ?>>Curitiba</option>
            </select>
          </div>

          <!-- Modalidade -->
          <div class="mb-3">
            <label class="form-label">Modalidade</label>
            <select name="tipo" class="form-select input-dark">
              <option value="">Todas</option>
              <option <?= ($_GET['tipo'] ?? '') == 'Remoto' ? 'selected' : '' ?>>Remoto</option>
              <option <?= ($_GET['tipo'] ?? '') == 'Presencial' ? 'selected' : '' ?>>Presencial</option>
              <option <?= ($_GET['tipo'] ?? '') == 'Híbrido' ? 'selected' : '' ?>>Híbrido</option>
            </select>
          </div>
           <!-- Botão pesquisar -->
            <div class="mb-3">
              <button type="submit" class="btn btn-primary w">Pesquisar</button>
            </div>        
        </div>
      </div>
    </form>

      <!-- Conteúdo (Listagem de Vagas) -->
      <div class="col-md-9">
        <div class="conteudo-vagas">
          <?php include '../php/listarVagasPublicadas.php'; ?>
        </div>
      </div>
    </div>

  



     

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function abrirDetalhes(id) {
    fetch('buscarDetalhesVaga.php?id=' + id)
        .then(response => response.text())
        .then(data => {
            document.getElementById('conteudoDetalhes').innerHTML = data;
            let modal = new bootstrap.Modal(document.getElementById('modalDetalhes'));
            modal.show();
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao carregar os detalhes.');
        });
  }
</script>

</body>
</html>
