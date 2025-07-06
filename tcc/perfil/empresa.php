<?php
session_start();

include_once '../php/dashboard.php';
include_once '../php/db.php';

$id_empresa = $_SESSION['id_usuario'];
$dados = obterDadosDashboard($conn, $id_empresa, 'empresa_id');

// Verifica se está logado e se é empresa
if(!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] != 'empresa'){
    header('Location: ../tela_inicia/index.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Menu Empresa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="../css/estilo.css" rel="stylesheet" /> <!-- CSS externo -->
  <script src="../script/script.js" defer></script>
</head>
<body>

  <div class="d-flex">
 
    <!-- Sidebar da empresa -->
    <nav class="col-md-3 col-lg-2 bg-dark text-white sidebar collapse d-md-block" 
    id="sidebarMenu" 
    style="min-height: 100vh;">
      <div class="p-3">
        <h4 class="text-center">Área da Empresa</h4>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link text-white" href="#" onclick="showSection('sec-empresa-painel')">
              <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#" onclick="showSection('sec-empresa-estagios')">
             <i class="bi bi-people-fill me-2"></i> Estagiários
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#" onclick="showSection('sec-empresa-relatorios')">
              <i class="bi bi-bar-chart-line-fill me-2"></i> Relatórios
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#" onclick="showSection('sec-empresa-vagas')">
              <i class="bi bi-megaphone-fill me-2"></i> Vagas
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#" onclick="showSection('sec-empresa-documentos')">
              <i class="bi bi-file-earmark-text-fill me-2"></i> Documentos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#" onclick="showSection('sec-empresa-mensagens')">
              <i class="bi bi-envelope-fill me-2"></i> Mensagens
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#" onclick="showSection('sec-empresa-configuracoes')">
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
         <!-- Toggler (para telas pequenas) -->
          <button class="btn btn-dark d-md-none m-2" 
          type="button" data-bs-toggle="collapse" 
          data-bs-target="#sidebarMenu">
            <i class="bi bi-list"></i> Menu
          </button>

    <!-- Conteúdo principal -->
    <main class="flex-grow-1 p-4">
         <!-- Seção de Dashboard -->
    <div id="sec-empresa-painel" class="content-section" style="display: block;">
         <div class="w-100 bg-dark text-white py-3 px-4">
    <h2><i class="bi bi-speedometer2 me-2"></i>Dashboard</h2>
    </div>
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


      <!-- Seção de Estágios -->
        <div id="sec-empresa-estagios" class="content-section" style="display: none;">
      <div class="w-100 bg-dark text-white py-3 px-4">
     <h2><i class="bi bi-briefcase-fill me-2"></i>Estágios</h2>
    </div>

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
        <!-- Seção de Relatórios -->
         <div id="sec-empresa-relatorios" class="content-section" style="display: none;">
            
          <div class="tab-content bg-dark p-4 mx-4 my-4 rounded border border-secondary text-white">
             <h2><i class="bi bi-file-earmark-bar-graph-fill me-2"></i>Relatórios</h2>
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
    
        <!-- Seção de Vagas -->
      <div id="sec-empresa-vagas" class="content-section" style="display: none;">
            <div class="w-100 bg-dark text-white py-3 px-4">  
      <h3 class="mb-4"><i class="bi bi-megaphone-fill me-2"></i>Vagas</h3>
      </div>   
      <div class="mb-2 mt-2">
        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalCriarVaga">Criar Nova Vaga</button>
         </div> 
          
          <!-- Cards de Totais -->
     <div class="row">
    <div class="col-md-6">
        <div class="card bg-dark text-white">
            <div class="card-body">
                <h5 class="card-title">Total de Vagas</h5>
                <p class="card-text fs-2">
                    <?php include_once '../php/cardTotalVagas.php'; ?>
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card bg-dark text-white">
            <div class="card-body">
                <h5 class="card-title">Vagas Pendentes</h5>
                <p class="card-text fs-2">
                    <?php include_once '../php/cardVagasPendentes.php'; ?>
                </p>
            </div>
        </div>
    </div>
</div>


      <!-- Tabela de Vagas -->
      <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">Vaga</th>
            <th scope="col">Empresa</th>
            <th scope="col">Curso</th>
            <th scope="col">Tipo</th>
            <th scope="col">Status</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
       <tbody>
        <?php include_once '../php/tabelaVagas.php'; ?>
    </tbody>

      </table>

      <!-- Modal de Criar Nova Vaga -->
      <div class="modal fade" id="modalCriarVaga" tabindex="-1" aria-labelledby="modalCriarVagaLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content bg-dark text-white">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCriarVagaLabel">Criar Nova Vaga</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
              <form action="../php/cadastrarVagas.php" method="POST">
                <div class="mb-3">
                    <label for="inputTitulo" class="form-label">Título da Vaga</label>
                    <input type="text" class="form-control" id="inputTitulo" name="titulo" required>
                </div>

                <div class="mb-3">
                    <label for="inputCurso" class="form-label">Curso</label>
                    <input type="text" class="form-control" id="inputCurso" name="curso" required>
                </div>

                <div class="mb-3">
                    <label for="inputTipo" class="form-label">Tipo</label>
                    <select class="form-control" id="inputTurno" name="tipo" required>
                        <option value="">Selecione</option>
                        <option value="Presencial">Presencial</option>
                        <option value="Remoto">Remoto</option>
                        <option value="Hibrido">Hibrido</option>
                    </select>  
                </div>             
         

                <div class="mb-3">
                    <label for="inputTurno" class="form-label">Turno</label>
                    <select class="form-control" id="inputTurno" name="turno" required>
                    <option value="">Selecione</option>
                    <option value="Manhã">Manhã</option>
                    <option value="Tarde">Tarde</option>
                    <option value="Noite">Noite</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="inputDescricao" class="form-label">Descrição</label>
                    <textarea class="form-control" id="inputDescricao" name="descricao" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="inputRequisitos" class="form-label">Requisitos</label>
                    <textarea class="form-control" id="inputRequisitos" name="requisitos" rows="3" required></textarea>
                </div>

                <!-- Status pode ser fixo no PHP como "ativa", então não precisa ser preenchido no formulário. -->

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Criar Vaga</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
              </form>

            </div>
        </div>
      </div>


      <!-- Modal de Edição de Vaga -->
      <div class="modal fade" id="modalVaga" tabindex="-1" aria-labelledby="modalVagaLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content bg-dark text-white">
            <div class="modal-header">
              <h5 class="modal-title" id="modalVagaLabel">Editar Vaga</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
             <form action="editarVagas.php" method="POST">
                  <div class="mb-3">
                    <label for="inputTitulo" class="form-label">Vaga</label>
                    <input type="text" class="form-control" id="inputTitulo" name="titulo" value="<?= htmlspecialchars($vaga['titulo']) ?>">
                  </div>
                  <div class="mb-3">
                    <label for="inputDescricao" class="form-label">Descrição</label>
                    <textarea class="form-control" id="inputDescricao" rows="3" name="descricao"><?= htmlspecialchars($vaga['descricao']) ?></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="inputRequisitos" class="form-label">Requisitos</label>
                    <textarea class="form-control" id="inputRequisitos" rows="3" name="requisitos"><?= htmlspecialchars($vaga['requisitos']) ?></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="inputCurso" class="form-label">Curso</label>
                    <input type="text" class="form-control" id="inputCurso" name="curso" value="<?= htmlspecialchars($vaga['curso']) ?>">
                  </div>
                  <div class="mb-3">
                    <label for="inputTurno" class="form-label">Turno</label>
                    <input type="text" class="form-control" id="inputTurno" name="turno" value="<?= htmlspecialchars($vaga['turno']) ?>">
                  </div>
                  <div class="mb-3">
                    <label for="inputTipo" class="form-label">Tipo</label>
                    <input type="text" class="form-control" id="inputTipo" name="tipo" value="<?= htmlspecialchars($vaga['tipo']) ?>">
                  </div>
                  <div class="mb-3">
                    <label for="inputStatus" class="form-label">Status</label>
                    <input type="text" class="form-control" id="inputStatus" name="status" value="<?= htmlspecialchars($vaga['status']) ?>">
                  </div>
                  <button type="submit" class="btn btn-primary">Salvar</button>
              </form>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
              <button type="button" class="btn btn-primary">Salvar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal de Visualização de Candidatos -->
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
                    <th scope="col">Nome</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody id="listaCandidatos">
                  <!-- Candidatos Dinâmicos -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal de Confirmação de Exclusão -->
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
     </div>  

      <!-- Seção de Documentos -->
      <div id="sec-empresa-documentos" class="content-section" style="display: none;">
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
          <td>Contrato de Estágio</td>
          <td>Contrato</td>
          <td>30/06/2025</td>
          <td>
            <!-- Botão de Preencher Contrato -->
            <button type="button" class="btn btn-outline-light btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#contratoModal">
              Preencher
            </button>
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
  <!-- Modal Preencher Contrato -->
<div class="modal fade" id="contratoModal" tabindex="-1" aria-labelledby="contratoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable"> <!-- scrollável -->
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="contratoModalLabel">Preencher Contrato</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <form id="formContrato" action="../php/gerar_contrato.php" method="POST" target="_blank">>
          <!-- campos do contrato abaixo -->
          
          <h6 class="mt-3">Dados do Estagiário</h6>
          <div class="mb-2">
            <label>Nome do Aluno</label>
            <input type="text" name="nome_aluno" class="form-control" required>
          </div>
          <div class="mb-2">
            <label>Data de Nascimento</label>
            <input type="date" name="data_nascimento" class="form-control" required>
          </div>
          <div class="mb-2">
            <label>CPF</label>
            <input type="text" name="cpf" class="form-control" required>
          </div>
          <div class="mb-2">
            <label>Email</label>
            <input type="email" name="email_aluno" class="form-control">
          </div>
          <div class="mb-2">
            <label>Telefone</label>
            <input type="text" name="telefone_aluno" class="form-control">
          </div>

          <h6 class="mt-4">Dados da Empresa</h6>
          <div class="mb-2">
            <label>Nome da Empresa</label>
            <input type="text" name="nome_empresa" class="form-control" required>
          </div>
          <div class="mb-2">
            <label>CNPJ</label>
            <input type="text" name="cnpj_empresa" class="form-control" required>
          </div>
          <div class="mb-2">
            <label>Endereço</label>
            <input type="text" name="endereco_empresa" class="form-control" required>
          </div>
          <div class="mb-2">
            <label>Telefone</label>
            <input type="text" name="telefone_empresa" class="form-control">
          </div>
          <div class="mb-2">
            <label>Responsável</label>
            <input type="text" name="responsavel_empresa" class="form-control" required>
          </div>

          <h6 class="mt-4">Informações do Contrato</h6>
          <div class="mb-2">
            <label>Início</label>
            <input type="date" name="inicio" class="form-control" required>
          </div>
          <div class="mb-2">
            <label>Término</label>
            <input type="date" name="termino" class="form-control" required>
          </div>
          <div class="mb-2">
            <label>Carga Horária Semanal</label>
            <input type="number" name="carga_horaria" class="form-control" required>
          </div>
          <div class="mb-2">
            <label>Valor da Bolsa</label>
            <input type="number" step="0.01" name="valor_bolsa" class="form-control" required>
          </div>

          <h6 class="mt-4">Dados da Instituição (Opcional)</h6>
          <div class="mb-2">
            <label>Nome da Instituição</label>
            <input type="text" name="nome_instituicao" class="form-control">
          </div>
          <div class="mb-2">
            <label>CNPJ</label>
            <input type="text" name="cnpj_instituicao" class="form-control">
          </div>
          <div class="mb-2">
            <label>Endereço</label>
            <input type="text" name="endereco_instituicao" class="form-control">
          </div>
          <div class="mb-2">
            <label>Telefone</label>
            <input type="text" name="telefone_instituicao" class="form-control">
          </div>
          <div class="mb-2">
            <label>Email</label>
            <input type="email" name="email_instituicao" class="form-control">
          </div>

          <div class="text-end mt-4">
            <button type="submit" class="btn btn-success">Gerar Contrato</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
      </div> 

      <!-- Seção de Mensagens -->
          <div id="sec-empresa-mensagens" class="content-section" style="display: none;">
          <div class="container mt-4">

            <!-- Conteúdo das abas -->
            <div class="tab-content bg-dark p-3 rounded-bottom border border-secondary" style="min-height: 400px;">
              <h3 class="mb-4 text-white">
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

                <!-- Lista de mensagens - inicialmente vazia -->
                <div class="list-group" id="listaMensagens" role="list" aria-live="polite" aria-relevant="additions"></div>
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
                    <div id="anexoHelp" class="form-text text-white-50">
                      Tipos permitidos: pdf, jpg, png, docx. Máx: 5MB.
                    </div>
                  </div>
                  <button type="submit" class="btn btn-success">Enviar</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Seção de Configurações da Empresa -->
      <div id="sec-empresa-configuracoes" class="content-section" style="display: none;">
        <div class="container mt-4">
 


  <!-- Abas -->
 

  <!-- Conteúdo das abas -->
  <div class="tab-content bg-dark p-4 mx-4 my-4 rounded border border-secondary text-white">
             <h3 class="mb-4">
  <i class="bi bi-gear me-2"></i>Configurações da Empresa
</h3> 
    <ul class="nav nav-pills mb-3 bg-dark p-2 rounded" id="configEmpresaTab" role="tablist">
    <li class="nav-item"><a class="nav-link active text-white" data-bs-toggle="pill" href="#dadosEmpresa">Dados da Empresa</a></li>
    <li class="nav-item"><a class="nav-link text-white" data-bs-toggle="pill" href="#responsaveis">Responsáveis</a></li>
    <li class="nav-item"><a class="nav-link text-white" data-bs-toggle="pill" href="#documentacao">Documentação</a></li>
    <li class="nav-item"><a class="nav-link text-white" data-bs-toggle="pill" href="#regrasVagas">Regras de Publicação</a></li>
    <li class="nav-item"><a class="nav-link text-white" data-bs-toggle="pill" href="#comunicacaoEmpresa">Notificações</a></li>
    <li class="nav-item"><a class="nav-link text-white" data-bs-toggle="pill" href="#segurancaEmpresa">Segurança</a></li>
  </ul>
    <!-- Aba Dados da Empresa -->
    <div class="tab-pane fade show active" id="dadosEmpresa">
      <div class="row">
        <div class="col-md-6">
          <label class="mx-1 my-1">Nome da Empresa</label>
          <input type="text" class="form-control bg-light text-dark" placeholder="Ex: Tech Solutions Ltda.">
        </div>
        <div class="col-md-6">
          <label class="mx-1 my-1">CNPJ</label>
          <input type="text" class="form-control bg-light text-dark" placeholder="00.000.000/0000-00">
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label class="mx-1 my-1">Email Corporativo</label>
          <input type="email" class="form-control bg-light text-dark" placeholder="contato@empresa.com.br">
        </div>
        <div class="col-md-6">
          <label class="mx-1 my-1">Telefone de Contato</label>
          <input type="text" class="form-control bg-light text-dark" placeholder="(00) 0000-0000">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <label class="mx-1 my-1">Endereço Completo</label>
          <input type="text" class="form-control bg-light text-dark" placeholder="Rua, nº, cidade, estado">
        </div>
      </div>
    </div>

    <!-- Aba Responsáveis -->
    <div class="tab-pane fade" id="responsaveis">
      <label class="mx-1 my-1">Nome do Responsável Principal</label>
      <input type="text" class="form-control bg-light text-dark" placeholder="Responsável legal ou RH">

      <label class="mx-1 my-1">Email do Responsável</label>
      <input type="email" class="form-control bg-light text-dark" placeholder="responsavel@empresa.com">

      <label class="mx-1 my-1">Cargo/Função</label>
      <input type="text" class="form-control bg-light text-dark" placeholder="RH, Gerente, Diretor etc.">
    </div>

    <!-- Aba Documentação -->
    <div class="tab-pane fade" id="documentacao">
      <label class="mx-1 my-1">Documentos obrigatórios</label>
      <select class="form-select bg-light text-dark" multiple>
        <option selected>Contrato Social</option>
        <option selected>Comprovante de CNPJ</option>
        <option>Alvará de Funcionamento</option>
        <option>Outros documentos legais</option>
      </select>

      <label class="mx-1 my-1">Observações</label>
      <textarea class="form-control bg-light text-dark" rows="3" placeholder="Instruções adicionais sobre documentos..."></textarea>
    </div>

    <!-- Aba Regras de Publicação -->
    <div class="tab-pane fade" id="regrasVagas">
      <label class="mx-1 my-1">Tipo de moderação para publicação de vagas</label>
      <select class="form-select bg-light text-dark">
        <option>Aprovação manual pela instituição</option>
        <option>Publicação automática</option>
      </select>

      <label class="mx-1 my-1">Status padrão das vagas</label>
      <select class="form-select bg-light text-dark">
        <option>Aberta</option>
        <option>Fechada</option>
      </select>

      <label class="mx-1 my-1">Permitir edição/exclusão após publicação?</label>
      <select class="form-select bg-light text-dark">
        <option>Sim</option>
        <option>Não</option>
      </select>
    </div>

    <!-- Aba Notificações -->
    <div class="tab-pane fade" id="comunicacaoEmpresa">
      <label class="mx-1 my-1">Deseja receber notificações por e-mail?</label>
      <div>
        <label><input type="checkbox" checked> Candidaturas recebidas</label>
      </div>
      <div>
        <label><input type="checkbox"> Atualização de status da vaga</label>
      </div>
      <div>
        <label><input type="checkbox"> Mensagens da instituição</label>
      </div>

      <label class="mx-1 my-1">Email alternativo para notificações</label>
      <input type="email" class="form-control bg-light text-dark" placeholder="notificacoes@empresa.com">
    </div>

    <!-- Aba Segurança -->
    <div class="tab-pane fade" id="segurancaEmpresa">
      <label class="mx-1 my-1">Troca obrigatória de senha a cada (dias)</label>
      <input type="number" class="form-control bg-light text-dark" placeholder="90">

      <label class="mx-1 my-1">Autenticação em dois fatores (2FA)</label>
      <select class="form-select bg-light text-dark">
        <option>Obrigatória</option>
        <option>Opcional</option>
        <option>Desativada</option>
      </select>

      <label class="mx-1 my-1">Histórico de acesso</label>
      <select class="form-select bg-light text-dark">
        <option>Ativado</option>
        <option>Desativado</option>
      </select>
    </div>
      <div class="text-end mx-4">
  <button class="btn btn-success px-4 mt-3">
    <i class="bi bi-save me-2"></i>Salvar Configurações
  </button>
</div>

  </div>
</div>

      </div>

    </main>
  </div>
  </div>
  

  <!-- Bootstrap e scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../script/script.js"></script> <!-- JS externo -->
   <script src="../script/tabelaEstagiarios.js"></script> <!-- JS externo -->
   <script src="../script/mensagens.js"></script> <!-- JS externo -->
  </body>
</html>
