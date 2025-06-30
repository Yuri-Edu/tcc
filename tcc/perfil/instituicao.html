<?php
session_start();
include_once '../php/db.php';
include_once '../php/dashboard.php';
include_once '../php/uploadRelatorio.php';

// Verifica se está logado como instituição
if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] !== 'instituicao') {
    header('Location: ../tela_login/index.php');
    exit();
}

$id_usuario     = $_SESSION['id_usuario'];     // ID da conta logada (login)
$id_instituicao = $_SESSION['id_instituicao']; // ID da instituição na tabela `instituicoes`
$email          = $_SESSION['email'];

// Dados do dashboard (usa o ID real da instituição)
$dados = obterDadosDashboard($conn, $id_instituicao, 'instituicao_id');

// Busca mensagens (ainda podem vir pelo ID do usuário da conta logada)
$sql = "SELECT * FROM mensagens WHERE destinatario_id = ? ORDER BY data_envio DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario); // Aqui, continua usando id_usuario se as mensagens são por login
$stmt->execute();
$result = $stmt->get_result();

// Armazena as mensagens em um array
$mensagens = [];
while ($row = $result->fetch_assoc()) {
    $mensagens[] = $row;
}

$stmt->close();


if (isset($_GET['upload']) && $_GET['upload'] === 'sucesso') {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Relatório enviado com sucesso!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>';
} elseif (isset($_GET['excluido']) && $_GET['excluido'] === 'ok') {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Relatório excluído com sucesso!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>';
} elseif (isset($_GET['erro'])) {
    $msgErro = htmlspecialchars($_GET['erro']);
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Erro: $msgErro
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>
    </div>";
}
?>




<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Perfil Instituição</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="../css/estilo.css" rel="stylesheet" /> <!-- CSS externo aqui -->
  <script src="../script/script.js"></script>
</head>
<body>

  <div class="d-flex">
    <!-- Botão toggle do menu (visível em telas pequenas) -->
   <button class="btn btn-dark d-md-none mb-3" type="button"
  data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
  aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
  <i class="bi bi-list"></i>
</button>


  <!-- Sidebar -->
      <nav class="collapse d-md-block bg-dark text-white p-3" id="sidebarMenu">
              <div class="p-3">
                <h4 class="justify-content-center">Área da Instituição</h4>
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a class="nav-link text-white" href="#" onclick="showSection('sec-dashboard')">
                      <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="#" onclick="showSection('sec-alunos')">
                      <i class="bi bi-people-fill me-2"></i> Alunos
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="#" onclick="showSection('sec-estagios')">
                      <i class="bi bi-briefcase-fill me-2"></i> Estágios
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="#" onclick="showSection('sec-relatorios')">
                      <i class="bi bi-file-earmark-bar-graph-fill me-2"></i> Relatórios
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="#" onclick="showSection('sec-vagas')">
                      <i class="bi bi-megaphone-fill me-2"></i> Vagas
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="#" onclick="showSection('sec-usuarios')">
                      <i class="bi bi-person-gear me-2"></i> Usuários
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="#" onclick="showSection('sec-documentos')">
                      <i class="bi bi-file-earmark-text-fill me-2"></i> Documentos
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="#" onclick="showSection('sec-mensagens')">
                      <i class="bi bi-chat-dots-fill me-2"></i> Mensagens
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="#" onclick="showSection('sec-configuracoes')">
                      <i class="bi bi-gear-fill me-2"></i> Configurações
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="../tela_login/index.php">
                      <i class="bi bi-box-arrow-right me-2"></i> Sair
                    </a>
                  </li>
                </ul>
              </div>
      </nav>

  <!-- Conteúdo principal -->
      <main class="flex-grow-1 p-4"> <!-- style="overflow-x: hidden; overflow-y: auto; height: 100vh;"-->
        <!-- Conteúdo das seções -->
        <!-- DASHBOARD -->
<div id="sec-dashboard" class="content-section" style="display: block;">
      <h2><i class="bi bi-speedometer2 me-2"></i>Dashboard</h2>
    <div class="row gx-2 gy-2">
        <!-- Estágios Pendentes -->
        <div class="col-md-6 d-flex justify-content-start">
            <a href="estagios.html" class="card bg-dark text-white border-light rounded-4" style="width: 75%;">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-clock-history me-2"></i>Estágios Pendentes</h5>
                     <p class="card-text display-6"><?php echo $dados['estagios_pendentes']; ?></p>
                </div>
            </a>
        </div>

        <!-- Relatórios Aguardando -->
        <div class="col-md-6 d-flex justify-content-start">
            <a href="relatorios.html" class="card bg-dark text-white shadow-sm border-light rounded-4" style="width: 75%;">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-file-earmark-text me-2"></i>Relatórios Aguardando</h5>
                    <p class="card-text display-6"><?php echo $dados['relatorios_aguardando']; ?></p>
                </div>
            </a>
        </div>

        <!-- Estágios Cadastrados -->
        <div class="col-md-6 d-flex justify-content-start">
            <a href="alunos.html" class="card bg-dark text-white shadow-sm border-light rounded-4" style="width: 75%;">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-people-fill me-2"></i>Estágios Cadastrados</h5>
                     <p class="card-text display-6"><?php echo $dados['estagios_cadastrados']; ?></p>
                </div>
            </a>
        </div>

        <!-- Vagas Criadas -->
        <div class="col-md-6 d-flex justify-content-start">
            <a href="vagas.html" class="card bg-dark text-white shadow-sm border-light rounded-4" style="width: 75%;">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-megaphone-fill me-2"></i>Vagas Criadas</h5>
                    <p class="card-text display-6"><?php echo $dados['vagas_criadas']; ?></p>
                </div>
            </a>
        </div>

        <!-- Documentos Pendentes -->
        <div class="col-md-6 d-flex justify-content-start">
            <a href="documentos.html" class="card bg-dark text-white shadow-sm border-light rounded-4" style="width: 70%;">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-file-earmark-excel me-2"></i>Documentos Pendentes</h5>
                    <p class="card-text display-6"><?php echo $dados['documentos_pendentes']; ?></p>
                </div>
            </a>
        </div>
    </div>
</div>

        <!-- seção alunos -->
      <div id="sec-alunos" class="content-section" style="display: none;">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h2><i class="bi bi-people-fill me-2"></i>Alunos</h2>
          <button class="btn btn-success rounded-pill" onclick="abrirCadastroAluno()">
            <i class="bi bi-person-plus-fill me-1"></i> Novo Aluno
          </button>
        </div>

        <!-- Filtros -->
        <div class="row mb-4">
          <div class="col-md-4">
            <label for="filtroCurso" class="form-label">Curso</label>
            <select id="filtroCurso" class="form-select bg-dark text-white border-light">
              <option value="" selected>Todos</option>
              <option>Técnico em Administração</option>
              <option>Técnico em Informática</option>
              <option>Técnico em Edificações</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="filtroPeriodo" class="form-label">Período</label>
            <select id="filtroPeriodo" class="form-select bg-dark text-white border-light">
              <option value="" selected>Todos</option>
              <option>1º</option>
              <option>2º</option>
              <option>3º</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="filtroTurno" class="form-label">Turno</label>
            <select id="filtroTurno" class="form-select bg-dark text-white border-light">
              <option value="" selected>Todos</option>
              <option>Manhã</option>
              <option>Tarde</option>
              <option>Noite</option>
            </select>
          </div>
        </div>

        <!-- Tabela de Alunos -->
        <div class="table-responsive rounded-3 border border-light">
          <table class="table table-dark table-hover table-bordered align-middle mb-0">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Matrícula</th>
                <th>Curso</th>
                <th>Período</th>
                <th>Turno</th>
                <th>Email</th>
                <th class="text-center">Ações</th>
              </tr>
            </thead>
            <tbody id="tabelaAlunos">
           
              <!-- Adicione mais alunos aqui ou via backend/JS -->
            </tbody>
          </table>
        </div>

        <!-- Modal Cadastro de Aluno -->
           <!-- Modal Cadastro de Aluno -->
          <div class="modal fade" id="modalCadastroAluno" tabindex="-1" aria-labelledby="modalCadastroAlunoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content bg-dark text-white border-light rounded-4">
                <div class="modal-header border-bottom border-light">
                  <h5 class="modal-title" id="modalCadastroAlunoLabel">Cadastro de Novo Aluno</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                  <form id="formAluno" novalidate>
                    <div class="row g-3">
                      <div class="col-md-6">
                        <label for="nome" class="form-label">Nome completo</label>
                        <input type="text" class="form-control bg-dark text-white border-light" id="nome" name="nome" required>
                        <div class="invalid-feedback">Por favor, insira o nome completo.</div>
                      </div>
                      <div class="col-md-3">
                        <label for="matricula" class="form-label">Matrícula</label>
                        <input type="text" class="form-control bg-dark text-white border-light" id="matricula" name="matricula" required>
                        <div class="invalid-feedback">Informe a matrícula do aluno.</div>
                      </div>
                      <div class="col-md-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control bg-dark text-white border-light" id="email" name="email" required>
                        <div class="invalid-feedback">Informe um e-mail válido.</div>
                      </div>
                      <div class="col-md-4">
                        <label for="curso" class="form-label">Curso</label>
                        <select class="form-select bg-dark text-white border-light" id="curso" name="curso" required>
                          <option value="" disabled selected>Selecione</option>
                          <option>Técnico em Administração</option>
                          <option>Técnico em Informática</option>
                          <option>Técnico em Edificações</option>
                        </select>
                        <div class="invalid-feedback">Selecione um curso.</div>
                      </div>
                      <div class="col-md-4">
                        <label for="periodo" class="form-label">Período</label>
                        <select class="form-select bg-dark text-white border-light" id="periodo" name="periodo" required>
                          <option value="" disabled selected>Selecione</option>
                          <option>1º</option>
                          <option>2º</option>
                          <option>3º</option>
                        </select>
                        <div class="invalid-feedback">Selecione um período.</div>
                      </div>
                      <div class="col-md-4">
                        <label for="turno" class="form-label">Turno</label>
                        <select class="form-select bg-dark text-white border-light" id="turno" name="turno" required>
                          <option value="" disabled selected>Selecione</option>
                          <option>Manhã</option>
                          <option>Tarde</option>
                          <option>Noite</option>
                        </select>
                        <div class="invalid-feedback">Selecione um turno.</div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer border-top border-light">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-success" form="formAluno">Salvar</button>
                </div>
              </div>
            </div>
          </div>

      </div>

        <!-- seção estágios -->
     <div id="sec-estagios" class="content-section" style="display: none;">
  <h2><i class="bi bi-briefcase-fill me-2"></i>Estágios</h2>

  <div class="container my-4">
    <!-- Botão e Filtro -->
    <div class="d-flex justify-content-between align-items-center mb-3">
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCriarEstagio">
        <i class="bi bi-plus-circle me-2"></i> Criar Estágio
      </button>
      <div style="width: 200px;">
        <label for="filtroStatus" class="form-label text-white">Status</label>
        <select id="filtroStatus" class="form-select bg-dark text-white border-secondary" onchange="carregarEstagios()">
          <option value="">Todos</option>
          <option value="em curso">Em Curso</option>
          <option value="concluído">Concluído</option>
          <option value="aprovado">Aprovado</option>
          <option value="encerrado">Encerrado</option>
          <option value="pendente">Pendente</option>
        </select>
      </div>
    </div>

    <!-- Cards -->
    <div class="row mb-3">
      <div class="col-md-4">
        <div class="card text-white bg-dark">
          <div class="card-body">
            <h5 class="card-title">Total de Estágios</h5>
            <p id="totalEstagios" class="card-text">
              <?php include '../php/cardTotalEstagiarios.php'; ?>
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-white bg-dark">
          <div class="card-body">
            <h5 class="card-title">Aprovados</h5>
            <p id="totalAprovados" class="card-text">
              <?php include '../php/cardContratados.php'; ?>
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-white bg-dark">
          <div class="card-body">
            <h5 class="card-title">Pendentes</h5>
            <p id="totalPendentes" class="card-text">
              <?php include '../php/cardEstagiosPendentes.php'; ?>
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Tabela -->
    <table id="tabelaEstagios" class="table table-dark table-bordered">
      <thead>
        <tr>
          <th>Empresa</th>
          <th>Curso</th>
          <th>Carga Horária</th>
          <th>Período</th>
          <th>Início</th>
          <th>Término</th>
          <th>Status</th>
          <th>Estagiário</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <!-- Preenchido via JavaScript -->
      </tbody>
    </table>
  </div>

  <!-- Modal Criar Estágio -->
  <div class="modal fade" id="modalCriarEstagio" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content bg-dark text-white">
        <div class="modal-header">
          <h5 class="modal-title">Criar Estágio</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="formCriarEstagio">
            <div class="mb-3">
              <label class="form-label">Empresa</label>
              <input type="text" class="form-control" id="empresa" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Curso</label>
              <input type="text" class="form-control" id="curso" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Carga Horária</label>
              <input type="text" class="form-control" id="carga" placeholder="Em horas" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Período</label>
              <select class="form-select" id="periodo" required>
                <option value="Manhã">Manhã</option>
                <option value="Tarde">Tarde</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Início</label>
              <input type="date" class="form-control" id="inicio" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Término</label>
              <input type="date" class="form-control" id="termino" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Status</label>
              <select class="form-select" id="status" required>
                <option value="pendente">Pendente</option>
                <option value="aprovado">Aprovado</option>
                <option value="concluído">Concluído</option>
                <option value="encerrado">Encerrado</option>
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-light" form="formCriarEstagio">Criar Estágio</button>
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Editar Estágio -->
  <div class="modal fade" id="modalEditarEstagio" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content bg-dark text-white">
        <div class="modal-header">
          <h5 class="modal-title">Editar Estágio</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="formEditarEstagio">
            <div class="mb-3">
              <label class="form-label">Empresa</label>
              <input type="text" class="form-control" id="editEmpresa" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Curso</label>
              <input type="text" class="form-control" id="editCurso" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Carga Horária</label>
              <input type="text" class="form-control" id="editCarga" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Período</label>
              <select class="form-select" id="editPeriodo" required>
                <option value="Manhã">Manhã</option>
                <option value="Tarde">Tarde</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Início</label>
              <input type="date" class="form-control" id="editInicio" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Término</label>
              <input type="date" class="form-control" id="editTermino" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Status</label>
              <select class="form-select" id="editStatus" required>
                <option value="pendente">Pendente</option>
                <option value="aprovado">Aprovado</option>
                <option value="concluído">Concluído</option>
                <option value="encerrado">Encerrado</option>
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-light" form="formEditarEstagio">Salvar</button>
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
    </div>

        <!-- seção relatórios -->
        <div id="sec-relatorios" class="content-section" style="display: none;">
          <h2><i class="bi bi-file-earmark-bar-graph-fill me-2"></i>Relatórios</h2>
          <div class="tab-content bg-dark p-4 mx-4 my-4 rounded border border-secondary text-white">

      <!-- Aba Relatórios -->

        <div class="tab-pane fade show active" id="relatorios">
          <div class="d-flex justify-content-between mb-3">
            <!-- Filtros -->
            <div>
              <input type="text" class="form-control bg-light text-dark mb-2" placeholder="Buscar relatório...">
              <select class="form-select bg-light text-dark" aria-label="Filtrar por categoria">
                <option selected>Filtrar por categoria</option>
                <option value="ativos">Estagiários Ativos</option>
                <option value="pendentes">Pendentes</option>
                <option value="curso">Por Curso</option>
                <option value="periodo">Por Período</option>
                <option value="empresa">Por Empresa</option>
                <option value="termino">Com Término Próximo</option>
                <option value="documentos">Pendência de Documentos</option>
                <option value="faltas">Faltas / Avaliações</option>
                <option value="geral">Relatório Geral</option>
              </select>
            </div>

            <!-- Botão de Upload -->
            <div>
              <button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#uploadRelatorioModal">
                + Novo Relatório
              </button>
            </div>
          </div>

 
        <!-- Tabela de Relatórios Padrões -->
        <table class="table table-dark table-bordered">
          <thead>
            <tr>
              <th scope="col">Relatório</th>
              <th scope="col">Descrição</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Estagiários Ativos</td>
              <td>Lista de todos os estagiários em atividade</td>
              <td><button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalRelatorio1">Preencher</button></td>
            </tr>
            <tr>
              <td>Estágios Pendentes de Aprovação</td>
              <td>Estágios que aguardam análise ou assinatura</td>
              <td><button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalRelatorio2">Preencher</button></td>
            </tr>
            <tr>
              <td>Estágios por Status</td>
              <td>Quantidade por status (Em curso, Concluído, etc)</td>
              <td><button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalRelatorio3">Preencher</button></td>
            </tr>
            <tr>
              <td>Estágios por Curso</td>
              <td>Distribuição dos estágios por curso</td>
              <td><button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalRelatorio4">Preencher</button></td>
            </tr>
            <tr>
              <td>Estágios por Período</td>
              <td>Turnos dos estágios (Manhã/Tarde/Noite)</td>
              <td><button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalRelatorio5">Preencher</button></td>
            </tr>
            <tr>
              <td>Estágios a Encerrar</td>
              <td>Estágios com término nos próximos 30 dias</td>
              <td><button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalRelatorio6">Preencher</button></td>
            </tr>
            <tr>
              <td>Estagiários por Empresa</td>
              <td>Estagiários agrupados por empresa</td>
              <td><button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalRelatorio7">Preencher</button></td>
            </tr>
            <tr>
              <td>Documentos Pendentes</td>
              <td>Estagiários que não entregaram documentos</td>
              <td><button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalRelatorio8">Preencher</button></td>
            </tr>
            <tr>
              <td>Faltas ou Avaliações</td>
              <td>Relatório de presença ou avaliações</td>
              <td><button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalRelatorio9">Preencher</button></td>
            </tr>
            <tr>
              <td>Geral de Estágios</td>
              <td>Resumo completo com filtros</td>
              <td><button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalRelatorio10">Preencher</button></td>
            </tr>
            <?php include '../php/listar_relatorios_upload.php'; ?>

          </tbody>
        </table>

        <!-- Modais para os 10 relatórios -->
        <div class="modal fade" id="modalRelatorio1" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">
              <div class="modal-header">
                <h5 class="modal-title">Estagiários Ativos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
              </div>
              <form action="../php/salvar_relatorio.php" method="POST">
                <div class="modal-body">
                  <input type="hidden" name="tipo" value="estagiarios_ativos">
                  <div class="mb-3">
                    <label class="form-label">Comentário adicional (opcional)</label>
                    <textarea class="form-control bg-light text-dark" name="comentario" rows="3"></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Modal para Relatório 2: Estágios Pendentes -->
         <div class="modal fade" id="modalRelatorio2" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">
              <div class="modal-header">
                <h5 class="modal-title">Estágios Pendentes de Aprovação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
              </div>
              <form action="../php/salvar_relatorio.php" method="POST">
                <div class="modal-body">
                  <input type="hidden" name="tipo" value="pendentes_aprovacao">
                  <div class="mb-3">
                    <label class="form-label">Comentário adicional (opcional)</label>
                    <textarea name="comentario" rows="3" class="form-control bg-light text-dark"></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Modal para Relatório 3: Estágios por Status -->
          <div class="modal fade" id="modalRelatorio3" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                  <h5 class="modal-title">Estágios por Status</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <form action="../php/salvar_relatorio.php" method="POST">
                  <div class="modal-body">
                    <input type="hidden" name="tipo" value="estagios_por_status">
                    <div class="mb-3">
                      <label class="form-label">Filtrar por Status (opcional)</label>
                      <select class="form-select bg-light text-dark" name="status">
                        <option value="">Todos</option>
                        <option value="Em curso">Em curso</option>
                        <option value="Concluído">Concluído</option>
                        <option value="Aprovado">Aprovado</option>
                        <option value="Encerrado">Encerrado</option>
                        <option value="Pendente">Pendente</option>
                      </select>
                    </div>
                  </div>
        
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Modal para Relatório 4: Estágios por Curso -->
          <div class="modal fade" id="modalRelatorio4" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                  <h5 class="modal-title">Estágios por Curso</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <form action="../php/salvar_relatorio.php" method="POST">
                  <div class="modal-body">
                    <input type="hidden" name="tipo" value="estagios_por_curso">
                    <div class="mb-3">
                      <label class="form-label">Filtrar por Curso (opcional)</label>
                      <select class="form-select bg-light text-dark" name="curso">
                        <option value="">Todos</option>
                        <option value="Administração">Administração</option>
                        <option value="Informática">Informática</option>
                        <option value="Enfermagem">Enfermagem</option>
                        <option value="Engenharia">Engenharia</option>
                        <!-- Adicione outros cursos conforme necessário -->
                      </select>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Comentário adicional (opcional)</label>
                      <textarea class="form-control bg-light text-dark" name="comentario" rows="3"></textarea> 
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        <!-- Modal para Relatório 5: Estágios por Período -->
          <div class="modal fade" id="modalRelatorio5" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                  <h5 class="modal-title">Estágios por Período</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <form action="../php/salvar_relatorio.php" method="POST">
                  <div class="modal-body">
                    <input type="hidden" name="tipo" value="estagios_por_periodo">
                    <div class="mb-3">
                      <label class="form-label">Filtrar por Período (opcional)</label>
                      <select class="form-select bg-light text-dark" name="periodo">
                        <option value="">Todos</option>
                        <option value="Manhã">Manhã</option>
                        <option value="Tarde">Tarde</option>
                        <option value="Noite">Noite</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Comentário adicional (opcional)</label>
                      <textarea class="form-control bg-light text-dark" name="comentario" rows="3"></textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Modal para Relatório 6: Estágios a Encerrar -->
            <div class="modal fade" id="modalRelatorio6" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content bg-dark text-white">
                  <div class="modal-header">
                    <h5 class="modal-title">Estágios a Encerrar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                  </div>
                  <form action="../php/salvar_relatorio.php" method="POST">
                    <div class="modal-body">
                      <input type="hidden" name="tipo" value="estagios_a_encerrar">
                      <div class="mb-3">
                        <label class="form-label">Comentário adicional (opcional)</label>
                        <textarea class="form-control bg-light text-dark" name="comentario" rows="3"></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Modal para Relatório 9: Faltas ou Avaliações -->
                <div class="modal fade" id="modalRelatorio9" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content bg-dark text-white">
                      <div class="modal-header">
                        <h5 class="modal-title">Faltas ou Avaliações</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                      </div>
                      <div class="modal-body">
                        <form action="../php/salvar_relatorio.php" method="POST">
                          <input type="hidden" name="tipo" value="faltas_avaliacoes">

                          <!-- Calendário de Faltas -->
                          <h6 class="text-white">Data(s) de Falta</h6>
                          <div class="mb-3">
                            <input type="date" name="faltas[]" class="form-control bg-light text-dark mb-2">
                            <input type="date" name="faltas[]" class="form-control bg-light text-dark mb-2">
                            <input type="date" name="faltas[]" class="form-control bg-light text-dark mb-2">
                          </div>

                          <!-- Avaliação -->
                          <h6 class="text-white mt-4">Formulário de Avaliação</h6>
                          <div class="mb-3">
                            <label class="form-label">Desempenho</label>
                            <select name="avaliacao_desempenho" class="form-select bg-light text-dark">
                              <option value="Excelente">Excelente</option>
                              <option value="Bom">Bom</option>
                              <option value="Regular">Regular</option>
                              <option value="Insatisfatório">Insatisfatório</option>
                            </select>
                          </div>

                          <div class="mb-3">
                            <label class="form-label">Assiduidade</label>
                            <select name="avaliacao_assiduidade" class="form-select bg-light text-dark">
                              <option value="Ótima">Ótima</option>
                              <option value="Boa">Boa</option>
                              <option value="Razoável">Razoável</option>
                              <option value="Ruim">Ruim</option>
                            </select>
                          </div>

                          <div class="mb-3">
                            <label class="form-label">Comentário adicional (opcional)</label>
                            <textarea name="comentario" rows="3" class="form-control bg-light text-dark"></textarea>
                          </div>

                          <div class="modal-footer d-flex justify-content-between">
                            <button type="submit" name="gerar_relatorio" class="btn btn-success">Gerar Relatório de Avaliação</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal para Relatório 10: Geral de Estágios -->
                    <div class="modal fade" id="modalRelatorio10" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content bg-dark text-white">
                          <div class="modal-header">
                            <h5 class="modal-title">Relatório Geral de Estágios</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                          </div>
                          <form action="../php/salvar_relatorio.php" method="POST">
                            <div class="modal-body">
                              <input type="hidden" name="tipo" value="geral_estagios">

                              <!-- Filtro por Curso -->
                              <div class="mb-3">
                                <label class="form-label">Curso</label>
                                <select name="curso" class="form-select bg-light text-dark">
                                  <option value="">Todos</option>
                                  <option value="Administração">Administração</option>
                                  <option value="Informática">Informática</option>
                                  <option value="Enfermagem">Enfermagem</option>
                                  <option value="Engenharia">Engenharia</option>
                                  <!-- Adicione outros cursos conforme necessário -->
                                </select>
                              </div>

                              <!-- Filtro por Período -->
                              <div class="mb-3">
                                <label class="form-label">Período</label>
                                <select name="periodo" class="form-select bg-light text-dark">
                                  <option value="">Todos</option>
                                  <option value="Manhã">Manhã</option>
                                  <option value="Tarde">Tarde</option>
                                  <option value="Noite">Noite</option>
                                </select>
                              </div>

                              <!-- Filtro por Status -->
                              <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select bg-light text-dark">
                                  <option value="">Todos</option>
                                  <option value="Em curso">Em curso</option>
                                  <option value="Concluído">Concluído</option>
                                  <option value="Aprovado">Aprovado</option>
                                  <option value="Encerrado">Encerrado</option>
                                  <option value="Pendente">Pendente</option>
                                </select>
                              </div>

                              <div class="mb-3">
                                <label class="form-label">Comentário adicional (opcional)</label>
                                <textarea name="comentario" rows="3" class="form-control bg-light text-dark"></textarea>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
        </div>
        <!-- Modal de Upload de Relatório -->
      <div class="modal fade" id="uploadRelatorioModal" tabindex="-1" aria-labelledby="uploadRelatorioModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadRelatorioModalLabel">Upload de Relatório</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <form id="formUploadRelatorio" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="relatorioName" class="form-label">Nome do Relatório</label>
            <input type="text" class="form-control bg-light text-dark" id="relatorioName" name="relatorioName" required>
          </div>

          <div class="mb-3">
            <label for="relatorioCategory" class="form-label">Categoria</label>
            <select class="form-select bg-light text-dark" id="relatorioCategory" name="relatorioCategory" required>
              <option selected disabled>Escolha a categoria</option>
              <option value="Relatório Financeiro">Relatório Financeiro</option>
              <option value="Relatório de Vagas">Relatório de Vagas</option>
              <option value="Relatório de Estágios">Relatório de Estágios</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="relatorioFile" class="form-label">Arquivo</label>
            <input type="file" class="form-control bg-light text-dark" id="relatorioFile" name="relatorioFile" required accept="application/pdf">
          </div>

          <!-- Feedback e Spinner -->
          <div class="mt-3">
            <div id="spinnerUpload" class="spinner-border text-primary d-none" role="status">
              <span class="visually-hidden">Carregando...</span>
            </div>
            <div id="mensagemUpload" class="mt-2"></div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar Relatório</button>
          </div>
        </form>
      </div>
    </div>
  </div>
      </div>

<!-- JS -->
  <script>
document.getElementById("formUploadRelatorio").addEventListener("submit", function (e) {
  e.preventDefault();

  const form = e.target;
  const formData = new FormData(form);
  const spinner = document.getElementById("spinnerUpload");
  const mensagem = document.getElementById("mensagemUpload");

  spinner.classList.remove("d-none");
  mensagem.innerHTML = "";

  fetch("../php/uploadRelatorio.php", {  // caminho corrigido aqui
    method: "POST",
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    spinner.classList.add("d-none");
    if (data.success) {
      mensagem.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
      form.reset();
    } else {
      mensagem.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
    }
  })
  .catch(error => {
    spinner.classList.add("d-none");
    mensagem.innerHTML = `<div class="alert alert-danger">Erro inesperado. Tente novamente.</div>`;
    console.error(error);
  });
});

</script>





          </div>
        </div>
      <!-- Fim da Aba Relatórios -->
        <!-- seção vagas -->
            <div id="sec-vagas" class="content-section" style="display: none;">
                    <h3 class="mb-4"><i class="bi bi-megaphone-fill me-2"></i>Vagas</h3>

                        <!-- Botão Nova Vaga -->
                        <div class="mb-4">
                          <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalCriarVaga">Criar Nova Vaga</button>
                        </div>

                      <!-- Cards Totais -->
                      <div class="row mb-4">
                        <div class="col-md-6">
                          <div class="card bg-dark text-white">
                            <div class="card-body">
                              <h5 class="card-title">Total de Vagas</h5>
                              <p class="card-text fs-2"><?php include_once '../php/cardTotalVagas.php'; ?></p>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="card bg-dark text-white">
                            <div class="card-body">
                              <h5 class="card-title">Vagas Pendentes</h5>
                              <p class="card-text fs-2"><?php include_once '../php/cardVagasPendentes.php'; ?></p>
                            </div>
                          </div>
                        </div>
                      </div>

                    <!-- Tabela de Vagas -->
                    <table class="table table-dark table-bordered">
                      <thead>
                        <tr>
                          <th>Vaga</th>
                          <th>Empresa</th>
                          <th>Curso</th>
                          <th>Tipo</th>
                          <th>Status</th>
                          <th>Ações</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php include_once '../php/tabelaVagas.php'; ?>
                      </tbody>
                    </table>

                    <!-- Modal Criar Vaga -->
                    <div class="modal fade" id="modalCriarVaga" tabindex="-1" aria-labelledby="modalCriarVagaLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content bg-dark text-white">
                          <div class="modal-header">
                            <h5 class="modal-title" id="modalCriarVagaLabel">Criar Nova Vaga</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                          </div>
                          <form action="../php/cadastrarVagas.php" method="POST">
                            <div class="modal-body">
                              <div class="mb-3">
                                <label class="form-label">Título da Vaga</label>
                                <input type="text" class="form-control" name="titulo" required>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Curso</label>
                                <input type="text" class="form-control" name="curso" required>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Tipo</label>
                                <select class="form-select" name="tipo" required>
                                  <option value="">Selecione</option>
                                  <option value="Presencial">Presencial</option>
                                  <option value="Remoto">Remoto</option>
                                  <option value="Híbrido">Híbrido</option>
                                </select>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Turno</label>
                                <select class="form-select" name="turno" required>
                                  <option value="">Selecione</option>
                                  <option value="Manhã">Manhã</option>
                                  <option value="Tarde">Tarde</option>
                                  <option value="Noite">Noite</option>
                                </select>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Descrição</label>
                                <textarea class="form-control" name="descricao" rows="3" required></textarea>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Requisitos</label>
                                <textarea class="form-control" name="requisitos" rows="3" required></textarea>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Criar Vaga</button>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                  <!-- Modal Editar Vaga -->
                  <div class="modal fade" id="modalEditarVaga" tabindex="-1" aria-labelledby="modalEditarVagaLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalEditarVagaLabel">Editar Vaga</h5>
                          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <form action="../php/editarVagas.php" method="POST">
                          <div class="modal-body">
                            <input type="hidden" id="editarId" name="id">

                            <div class="mb-3">
                              <label class="form-label">Título da Vaga</label>
                              <input type="text" class="form-control" id="editarTitulo" name="titulo" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Curso</label>
                              <input type="text" class="form-control" id="editarCurso" name="curso" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Tipo</label>
                              <input type="text" class="form-control" id="editarTipo" name="tipo" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Turno</label>
                              <input type="text" class="form-control" id="editarTurno" name="turno" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Descrição</label>
                              <textarea class="form-control" id="editarDescricao" name="descricao" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Requisitos</label>
                              <textarea class="form-control" id="editarRequisitos" name="requisitos" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Status</label>
                              <input type="text" class="form-control" id="editarStatus" name="status" required>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                <!-- Modal Candidatos -->
                <div class="modal fade" id="modalCandidatos" tabindex="-1" aria-labelledby="modalCandidatosLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content bg-dark text-white">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalCandidatosLabel">Candidatos</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                      </div>
                      <div class="modal-body">
                        <table class="table table-dark">
                          <thead>
                            <tr>
                              <th>Nome</th>
                              <th>Curso</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody id="listaCandidatos">
                            <!-- Candidatos carregados dinamicamente -->
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Modal Confirmar Exclusão -->
                <div class="modal fade" id="modalConfirmarExclusao" tabindex="-1" aria-labelledby="modalConfirmarExclusaoLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content bg-dark text-white">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalConfirmarExclusaoLabel">Confirmar Exclusão</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                      </div>
                      <div class="modal-body">
                        Tem certeza que deseja excluir esta vaga?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirmarExclusao">Excluir</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          <!-- #sec-vagas -->  

        <!-- seção usuários -->
          <div id="sec-usuarios" class="content-section" style="display: none;">
            <h2><i class="bi bi-person-gear me-2"></i>Usuário</h2>
            <div class="container mt-4">

              <!-- Abas Usuários e Perfis -->
              <div class="bg-dark text-white p-3 rounded">
                <div class="d-flex mb-3">
                  <button class="btn btn-dark me-2 active" id="btnUsuarios" onclick="toggleSection('usuarios')">Usuários</button>
                  <button class="btn btn-dark" id="btnPerfis" onclick="toggleSection('perfis')">Perfis</button>
                </div>

                <!-- Aba Usuários -->
                <div id="usuariosSection">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>Lista de Usuários</h5>
                    <div>
                      <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#novoUsuarioModal">Novo Usuário</button>
                      <button class="btn btn-primary me-2">Modificar Dados</button>
                      <button class="btn btn-danger">Apagar Usuário</button>
                    </div>
                  </div>
                  <table class="table table-dark table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>Nome do Usuário</th>
                        <th>Email</th>
                        <th>Perfil</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Yuri</td>
                        <td>yuri@gmail.com</td>
                        <td>Administrador</td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <!-- Aba Perfis -->
                <div id="perfisSection" style="display: none;">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>Lista de Perfis</h5>
                    <div>
                      <button class="btn btn-success me-2">Novo Perfil</button>
                      <button class="btn btn-primary me-2">Modificar Dados</button>
                      <button class="btn btn-secondary me-2" onclick="abrirPermissoesPerfil('APOIADOR')">Permissões</button>
                      <button class="btn btn-danger">Apagar Perfil</button>
                    </div>
                  </div>
                  <table class="table table-dark table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>Nome do Perfil</th>
                        <th>Descrição</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>APOIADOR</td>
                        <td>Perfil de apoio operacional</td>
                      </tr>
                      <tr>
                        <td>ASSISTENTE 2</td>
                        <td>Suporte nível 2</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <!-- Modal Novo Usuário -->
              <div class="modal fade" id="novoUsuarioModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content bg-dark text-white">
                    <form action="salvar_usuario.php" method="POST" id="formNovoUsuario" novalidate>
                      <div class="modal-header">
                        <h5 class="modal-title">Criar Novo Usuário</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <div class="mb-3">
                          <label class="form-label">Nome</label>
                          <input type="text" name="nome" class="form-control bg-secondary text-white" placeholder="Digite o nome" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Usuário</label>
                          <input type="text" name="usuario" class="form-control bg-secondary text-white" placeholder="Digite o usuário" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Senha</label>
                          <input type="password" name="senha" class="form-control bg-secondary text-white" placeholder="Digite a senha" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Email</label>
                          <input type="email" name="email" class="form-control bg-secondary text-white" placeholder="Digite o email" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Perfil</label>
                          <select name="perfil" class="form-select bg-secondary text-white" required>
                            <option value="">Selecione um perfil</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Editor">Editor</option>
                            <option value="Leitor">Leitor</option>
                          </select>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <!-- Modal de Permissões -->
              <div class="modal fade" id="modalPermissoes" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                      <h5 class="modal-title">Permissões do Perfil: <span id="nomePerfilModal"></span></h5>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <form id="formPermissoes" class="form-check"></form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-light" onclick="salvarPermissoes()">Salvar</button>
                    </div>
                  </div>
                </div>
              </div>

            </div> <!-- .container -->
          </div>
         <!-- #sec-usuarios -->

         <!-- Seção de Documentos -->
           <div id="sec-documentos" class="content-section" style="display: none;">
  <div class="tab-content bg-dark p-4 mx-4 my-4 rounded border border-secondary text-white">
    <h3 class="mb-4">
      <i class="bi bi-file-earmark-text-fill me-2"></i>Documentos
    </h3> 

    <div class="d-flex justify-content-between mb-3 flex-wrap">
      <!-- Filtros -->
      <div class="me-2">
        <input type="text" class="form-control bg-light text-dark mb-2" placeholder="Buscar documentos...">
        <select class="form-select bg-light text-dark">
          <option selected>Filtrar por categoria</option>
          <option value="1">Categoria 1</option>
          <option value="2">Categoria 2</option>
          <option value="3">Categoria 3</option>
        </select>
      </div>

      <!-- Botão de Upload -->
      <div>
        <button type="button" class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal">
          + Novo Documento
        </button>
      </div>
    </div>

    <!-- Tabela de Documentos -->
    <table class="table table-dark table-bordered">
      <thead>
        <tr>
          <th scope="col">Nome do Documento</th>
          <th scope="col">Categoria</th>
          <th scope="col">Data de Upload</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Documento Exemplo 1.pdf</td>
          <td>Categoria 1</td>
          <td>01/05/2025</td>
          <td>
            <button type="button" class="btn btn-outline-light btn-sm">Visualizar</button>
            <button type="button" class="btn btn-outline-light btn-sm">Excluir</button>
          </td>
        </tr>
        <tr>
          <td>Documento Exemplo 2.pdf</td>
          <td>Categoria 2</td>
          <td>02/05/2025</td>
          <td>
            <button type="button" class="btn btn-outline-light btn-sm">Visualizar</button>
            <button type="button" class="btn btn-outline-light btn-sm">Excluir</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Modal de Upload de Documento -->
  <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-dark text-white">
        <div class="modal-header">
          <h5 class="modal-title" id="uploadModalLabel">Upload de Documento</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <form action="upload_documento.php" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="mb-3">
              <label for="documentName" class="form-label">Nome do Documento</label>
              <input type="text" class="form-control bg-light text-dark" id="documentName" name="documentName" required>
            </div>
            <div class="mb-3">
              <label for="documentCategory" class="form-label">Categoria</label>
              <select class="form-select bg-light text-dark" id="documentCategory" name="documentCategory" required>
                <option selected disabled>Escolha a categoria</option>
                <option value="1">Categoria 1</option>
                <option value="2">Categoria 2</option>
                <option value="3">Categoria 3</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="documentFile" class="form-label">Arquivo</label>
              <input type="file" class="form-control bg-light text-dark" id="documentFile" name="documentFile" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar Documento</button>
          </div>
        </form>
      </div>
    </div>
  </div>
           </div>
       <!-- <-- fechamento da div principal -->

          
      <!-- seção mensagens -->
        <div id="sec-mensagens" class="content-section" style="display: none;">
  <div class="container mt-4">
    <div class="tab-content bg-dark p-3 rounded border border-secondary text-white" style="min-height: 400px;">
      <h3 class="mb-4">
        <i class="bi bi-envelope-fill me-2"></i>Mensagens
      </h3>

      <!-- Abas -->
      <ul class="nav nav-tabs mb-4" id="mensagemTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button
            class="nav-link active bg-light text-dark"
            id="entrada-tab"
            data-bs-toggle="tab"
            data-bs-target="#entrada"
            type="button"
            role="tab"
            aria-controls="entrada"
            aria-selected="true"
          >Caixa de Entrada</button>
        </li>
        <li class="nav-item ms-2" role="presentation">
          <button
            class="nav-link bg-light text-dark"
            id="nova-tab"
            data-bs-toggle="tab"
            data-bs-target="#nova"
            type="button"
            role="tab"
            aria-controls="nova"
            aria-selected="false"
          >Nova Mensagem</button>
        </li>
      </ul>

      <div class="tab-content">
        <!-- Caixa de Entrada -->
        <div
          class="tab-pane fade show active"
          id="entrada"
          role="tabpanel"
          aria-labelledby="entrada-tab"
        >
          <div class="d-flex mb-3 gap-2 flex-wrap">
            <input
              type="text"
              class="form-control bg-light text-dark flex-grow-1"
              placeholder="Buscar por assunto, remetente..."
              id="buscaMensagem"
              aria-label="Buscar mensagens"
            >
            <select
              class="form-select bg-light text-dark"
              id="filtroRemetente"
              style="max-width: 200px;"
              aria-label="Filtrar por remetente"
            >
              <option value="todos">Todos</option>
              <option value="aluno">Alunos</option>
              <option value="empresa">Empresas</option>
            </select>
          </div>

          <div class="list-group" id="listaMensagens" role="list" aria-live="polite" aria-relevant="additions">
          </div>
        </div>

        <!-- Nova Mensagem -->
        <div
          class="tab-pane fade text-white"
          id="nova"
          role="tabpanel"
          aria-labelledby="nova-tab"
        >
          <form
            method="POST"
            action="../php/enviar_mensagem_chat.php"
            enctype="multipart/form-data"
            novalidate
          >
            <div class="mb-3">
              <label for="remetente" class="form-label">Seu E-mail</label>
              <input
                type="email"
                name="remetente"
                class="form-control bg-light text-dark"
                id="remetente"
                placeholder="seu@email.com"
                value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>"
                readonly
                required
                aria-readonly="true"
              >
            </div>
            <div class="mb-3">
              <label for="destinatario" class="form-label">Destinatário</label>
              <input
                type="email"
                name="destinatario"
                class="form-control bg-light text-dark"
                id="destinatario"
                placeholder="E-mail do destinatário"
                required
              >
            </div>
            <div class="mb-3">
              <label for="assunto" class="form-label">Assunto</label>
              <input
                type="text"
                name="assunto"
                class="form-control bg-light text-dark"
                id="assunto"
                placeholder="Assunto da mensagem"
                required
              >
            </div>
            <div class="mb-3">
              <label for="mensagem" class="form-label">Mensagem</label>
              <textarea
                name="mensagem"
                class="form-control bg-light text-dark"
                id="mensagem"
                rows="5"
                placeholder="Escreva sua mensagem aqui..."
                required
              ></textarea>
            </div>
            <div class="mb-3">
              <label for="anexo" class="form-label">Anexo</label>
              <input
                type="file"
                name="anexo"
                id="anexo"
                class="form-control bg-light text-dark"
                aria-describedby="anexoHelp"
              >
              <div id="anexoHelp" class="form-text text-secondary">
                Tipos permitidos: pdf, jpg, png, docx. Máx: 5MB.
              </div>
            </div>
            <button type="submit" class="btn btn-success">Enviar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
        </div>
      <!-- fechamento da div principal -->


        <!-- seção configurações -->
        <div id="sec-configuracoes" class="content-section" style="display: none;">
          <div class="container mt-4">
            <h3 class="mb-4"> <i class="bi bi-gear-fill me-2"></i> Configurações</h3>

          </div>

            <!-- Conteúdo das abas -->
              <div class="tab-content bg-dark p-4 mx-4 my-4 rounded border border-secondary text-white">
                  <!-- Abas -->
              <ul class="nav nav-pills mb-3 bg-dark p-2 rounded" id="configTab" role="tablist">
               <li class="nav-item"><a class="nav-link active text-white" data-bs-toggle="pill" href="#dadosInstitucionais">Dados Institucionais</a></li>
                <li class="nav-item"><a class="nav-link text-white" data-bs-toggle="pill" href="#regrasSistema">Regras do Sistema</a></li>
                <li class="nav-item"><a class="nav-link text-white" data-bs-toggle="pill" href="#configAlunos">Configurações dos Alunos</a></li>
                <li class="nav-item"><a class="nav-link text-white" data-bs-toggle="pill" href="#configEmpresas">Configurações das Empresas</a></li>
                <li class="nav-item"><a class="nav-link text-white" data-bs-toggle="pill" href="#gerenciamentoVagas">Gerenciamento de Vagas</a></li>
                <li class="nav-item"><a class="nav-link text-white" data-bs-toggle="pill" href="#notificacoesMensagens">Notificações e Mensagens</a></li>
                <li class="nav-item"><a class="nav-link text-white" data-bs-toggle="pill" href="#perfisPermissoes">Perfis e Permissões</a></li>
                <li class="nav-item"><a class="nav-link text-white" data-bs-toggle="pill" href="#segurancaAcesso">Segurança e Acesso</a></li>
              </ul>
                <!-- Aba Dados Institucionais -->
                <div class="tab-pane fade show active" id="dadosInstitucionais">
                  <div class="row">
                    <div class="col-md-6">
                      <label class="mx-1 my-1">Nome da Instituição</label>
                      <input type="text" class="form-control bg-light text-dark" placeholder="Ex: Faculdade Exemplo">
                    </div>
                    <div class="col-md-6">
                      <label class="mx-1 my-1">CNPJ</label>
                      <input type="text" class="form-control bg-light text-dark" placeholder="00.000.000/0000-00">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label class="mx-1 my-1">Email Oficial</label>
                      <input type="email" class="form-control bg-light text-dark" placeholder="contato@instituicao.com">
                    </div>
                    <div class="col-md-6">
                      <label class="mx-1 my-1">Telefone</label>
                      <input type="text" class="form-control bg-light text-dark" placeholder="(00) 0000-0000">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label class="mx-1 my-1">Endereço</label>
                      <input type="text" class="form-control bg-light text-dark" placeholder="Rua, nº, cidade">
                    </div>
                  </div>
                </div>

                <!-- Aba Regras do Sistema -->
                <div class="tab-pane fade" id="regrasSistema">
                  <label class="mx-1 my-1">Permitir que empresas se cadastrem?</label>
                  <select class="form-select bg-light text-dark">
                    <option>Sim</option>
                    <option>Não</option>
                  </select>

                  <label class="mx-1 my-1">Permitir que alunos vejam todas as vagas ou só as do curso?</label>
                  <select class="form-select bg-light text-dark">
                    <option>Ver todas as vagas</option>
                    <option>Ver apenas vagas do curso</option>
                  </select>

                  <label class="mx-1 my-1">Limite de candidatura por aluno</label>
                  <input type="number" class="form-control bg-light text-dark" placeholder="3">
                </div>

                <!-- Aba Configurações dos Alunos -->
                <div class="tab-pane fade" id="configAlunos">
                  <label class="mx-1 my-1">Campos obrigatórios no currículo do aluno</label>
                  <select class="form-select bg-light text-dark" multiple>
                    <option selected>Informações Pessoais</option>
                    <option selected>Experiência Profissional</option>
                    <option>Certificações</option>
                    <option>Idiomas</option>
                  </select>

                  <label class="mx-1 my-1">Habilitar envio de documentos?</label>
                  <select class="form-select bg-light text-dark">
                    <option>Sim</option>
                    <option>Não</option>
                  </select>
                </div>

                <!-- Aba Configurações das Empresas -->
                <div class="tab-pane fade" id="configEmpresas">
                  <label class="mx-1 my-1">Campos obrigatórios no cadastro da empresa</label>
                  <select class="form-select bg-light text-dark" multiple>
                    <option selected>Nome da Empresa</option>
                    <option selected>CNPJ</option>
                    <option>Área de Atuação</option>
                  </select>

                  <label class="mx-1 my-1">Documentos exigidos para aprovação</label>
                  <input type="text" class="form-control bg-light text-dark" placeholder="Ex: CNPJ, contrato social">
                </div>

                <!-- Aba Gerenciamento de Vagas -->
                <div class="tab-pane fade" id="gerenciamentoVagas">
                  <label class="mx-1 my-1">Regras de aprovação de vagas</label>
                  <select class="form-select bg-light text-dark">
                    <option>Manual</option>
                    <option>Automático</option>
                  </select>

                  <label class="mx-1 my-1">Status padrão das vagas</label>
                  <select class="form-select bg-light text-dark">
                    <option>Aberta</option>
                    <option>Fechada</option>
                  </select>

                  <label class="mx-1 my-1">Permitir que empresas excluam vagas?</label>
                  <select class="form-select bg-light text-dark">
                    <option>Sim</option>
                    <option>Não</option>
                  </select>
                </div>

                <!-- Aba Notificações e Mensagens -->
                <div class="tab-pane fade" id="notificacoesMensagens">
                  <label class="mx-1 my-1">Notificações por e-mail</label>
                  <div>
                    <label><input type="checkbox"> Candidatura de aluno</label>
                  </div>
                  <div>
                    <label><input type="checkbox"> Nova vaga aprovada</label>
                  </div>
                  <div>
                    <label><input type="checkbox"> Nova mensagem recebida</label>
                  </div>

                  <label class="mx-1 my-1">Personalizar e-mails automáticos</label>
                  <textarea class="form-control bg-light text-dark" rows="3" placeholder="Texto do e-mail..."></textarea>
                </div>

                <!-- Aba Perfis e Permissões -->
                <div class="tab-pane fade" id="perfisPermissoes">
                  <label class="mx-1 my-1">Gerenciar Perfis</label>
                  <button class="btn btn-outline-light btn-sm mb-2">+ Novo Perfil</button>

                  <label class="mx-1 my-1">Atribuir permissões por perfil</label>
                  <button class="btn btn-outline-light btn-sm mb-2">Atribuir Permissões</button>
                </div>

                <!-- Aba Segurança e Acesso -->
                <div class="tab-pane fade" id="segurancaAcesso">
                  <label class="mx-1 my-1">Tempo de sessão inativo (minutos)</label>
                  <input type="number" class="form-control bg-light text-dark" placeholder="30">

                  <label class="mx-1 my-1">Troca de senha obrigatória a cada X dias</label>
                  <input type="number" class="form-control bg-light text-dark" placeholder="90">

                  <label class="mx-1 my-1">Registro de acessos (log de usuários)</label>
                  <select class="form-select bg-light text-dark">
                    <option>Ativado</option>
                    <option>Desativado</option>
                  </select>
                </div>

              </div>

        </div>
      </main>
  </div>
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
  <script src="../script/script.js" defer></script> <!-- JS externo aqui -->
  <script src="../script/mensagens.js" defer></script>
</body>
</html>
