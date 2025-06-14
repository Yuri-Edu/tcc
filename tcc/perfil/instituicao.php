<?php
session_start();

// Verifica se está logado e se é aluno
if(!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] != 'instituicao'){
    header('Location: ../tela_inicia/index.php');
    exit();
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
 
</head>
<body>

  <div class="d-flex">
  <!-- Sidebar -->
      <nav class="col-md-3 col-lg-2 d-md-block bg-dark text-white sidebar collapse" id="sidebarMenu">
        <div class="p-3">
          <h4 class="justify-content-center">Área da Instituição</h4>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link text-white" href="#" onclick="mostrarSecao('sec-dashboard', event)">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#" onclick="mostrarSecao('sec-alunos', event)">
                <i class="bi bi-people-fill me-2"></i> Alunos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#" onclick="mostrarSecao('sec-estagios', event)">
                <i class="bi bi-briefcase-fill me-2"></i> Estágios
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#" onclick="mostrarSecao('sec-relatorios', event)">
                <i class="bi bi-file-earmark-bar-graph-fill me-2"></i> Relatórios
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#" onclick="mostrarSecao('sec-vagas', event)">
                <i class="bi bi-megaphone-fill me-2"></i> Vagas
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#" onclick="mostrarSecao('sec-usuarios', event)">
                <i class="bi bi-person-gear me-2"></i> Usuários
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#" onclick="mostrarSecao('sec-documentos', event)">
                <i class="bi bi-file-earmark-text-fill me-2"></i> Documentos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#" onclick="mostrarSecao('sec-mensagens', event)">
                <i class="bi bi-chat-dots-fill me-2"></i> Mensagens
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#" onclick="mostrarSecao('sec-configuracoes', event)">
                <i class="bi bi-gear-fill me-2"></i> Configurações
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="../tela_login/index.html">
                <i class="bi bi-box-arrow-right me-2"></i> Sair
              </a>
            </li>
          </ul>
        </div>
      </nav>

  <!-- Conteúdo principal -->
      <main class="flex-grow-1 p-4"> <!-- style="overflow-x: hidden; overflow-y: auto; height: 100vh;"-->
        <!-- Conteúdo das seções -->
        <div id="sec-dashboard" class="secao-ocultavel" style="display: block;">
          <h2><i class="bi bi-speedometer2 me-2"></i>Dashboard</h2>
          <div class="row gx-2 gy-2">
            <!-- Cards -->
           <div class="col-md-6 d-flex justify-content-start">
              <a href="estagios.html" class="card bg-dark text-white border-light rounded-4" style="width: 75%;">
                <div class="card-body">
                  <h5 class="card-title"><i class="bi bi-clock-history me-2"></i>Estágios Pendentes</h5>
                  <p class="card-text display-6"><?php echo $estagios_pendentes; ?></p>
                </div>
              </a>
            </div>
            <div class="col-md-6 d-flex justify-content-start">
              <a href="relatorios.html" class="card bg-dark text-white shadow-sm border-light rounded-4" style="width: 75%;">
                <div class="card-body">
                  <h5 class="card-title"><i class="bi bi-file-earmark-text me-2"></i>Relatórios Aguardando</h5>
                  <p class="card-text display-6"><?php echo $relatorio_pendentes; ?></p>
                </div>
              </a>
            </div>
            <div class="col-md-6 d-flex justify-content-start">
              <a href="alunos.html" class="card bg-dark text-white shadow-sm border-light rounded-4" style="width: 75%;">
                <div class="card-body">
                  <h5 class="card-title"><i class="bi bi-people-fill me-2"></i>Estagios Cadastrados</h5>
                  <p class="card-text display-6"><?php echo $estagios_cadastrados; ?> </p>
                </div>
              </a>
            </div>
            <div class="col-md-6 d-flex justify-content-start">
              <a href="vagas.html" class="card bg-dark text-white shadow-sm border-light rounded-4" style="width: 75%;">
                <div class="card-body">
                  <h5 class="card-title"><i class="bi bi-megaphone-fill me-2"></i>Vagas Criadas</h5>
                  <p class="card-text display-6"><?php echo $vagas_criadas; ?></p>
                </div>
              </a>
            </div>
            <div class="col-md-6 d-flex justify-content-start">
              <a href="documentos.html" class="card bg-dark text-white shadow-sm border-light rounded-4" style="width: 70%;">
                <div class="card-body">
                  <h5 class="card-title"><i class="bi bi-file-earmark-excel me-2"></i>Documentos Pendentes</h5>
                  <p class="card-text display-6"><?php echo $documentos_penentes; ?></p>
                </div>
              </a>
            </div>
          </div>
        </div>


        <!-- seção alunos -->
        <div id="sec-alunos" class="secao-ocultavel" style="display: none;">
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
                <option value="">Todos</option>
                <option>Técnico Administração</option>
                <option>Técnico de Informática</option>
                <option>Técnico de Edificações</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="filtroPeriodo" class="form-label">Período</label>
              <select id="filtroPeriodo" class="form-select bg-dark text-white border-light">
                <option value="">Todos</option>
                <option>1º</option>
                <option>2º</option>
                <option>3º</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="filtroTurno" class="form-label">Turno</label>
              <select id="filtroTurno" class="form-select bg-dark text-white border-light">
                <option value="">Todos</option>
                <option>Manhã</option>
                <option>Tarde</option>
                <option>Noite</option>
              </select>
            </div>
          </div>
        
          <!-- Tabela de alunos -->
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
                <!-- Os alunos serão inseridos aqui pelo JavaScript ou via html -->
                <tr>
                  <td>Yuri Eduardo</td>
                  <td>202301</td>
                  <td>Tecnico de Informatica</td>
                  <td>3º</td>
                  <td>Noite</td>
                  <td>yuri@email.com</td>
                  <td>
                    <button class="btn btn-sm btn-outline-light me-1"><i class="bi bi-eye-fill"></i></button>
                    <button class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil-fill"></i></button>
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Vinicios Moraes</td>
                  <td>202302</td>
                  <td>Tecnico de Informatica</td>
                  <td>3º</td>
                  <td>Noite</td>
                  <td>vinicios@email.com</td>
                  <td>
                    <button class="btn btn-sm btn-outline-light me-1"><i class="bi bi-eye-fill"></i></button>
                    <button class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil-fill"></i></button>
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Silvio Santos</td>
                  <td>202303</td>
                  <td>Técnico de Informatica</td>
                  <td>3º</td>
                  <td>Noite</td>
                  <td>silvio@email.com</td>
                  <td>
                    <button class="btn btn-sm btn-outline-light me-1"><i class="bi bi-eye-fill"></i></button>
                    <button class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil-fill"></i></button>
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Lazaro Ramos</td>
                  <td>202304</td>
                  <td>Técnico de Informática</td>
                  <td>3º</td>
                  <td>Noite</td>
                  <td>lazaro@email.com</td>
                  <td>
                    <button class="btn btn-sm btn-outline-light me-1"><i class="bi bi-eye-fill"></i></button>
                    <button class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil-fill"></i></button>
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

            <!-- Modal de Cadastro de Aluno -->
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
                        <input type="text" class="form-control bg-dark text-white border-light" id="nome" required>
                        <div class="invalid-feedback">Por favor, insira o nome completo.</div>
                      </div>
                      <div class="col-md-3">
                        <label for="matricula" class="form-label">Matrícula</label>
                        <input type="text" class="form-control bg-dark text-white border-light" id="matricula" required>
                        <div class="invalid-feedback">Informe a matrícula do aluno.</div>
                      </div>
                      <div class="col-md-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control bg-dark text-white border-light" id="email" required>
                        <div class="invalid-feedback">Informe um e-mail válido.</div>
                      </div>
                      <div class="col-md-4">
                        <label for="curso" class="form-label">Curso</label>
                        <select class="form-select bg-dark text-white border-light" id="curso" required>
                          <option value="" disabled selected>Selecione</option>
                          <option>Administração</option>
                          <option>Direito</option>
                          <option>Engenharia</option>
                          <option>Análise de Sistemas</option>
                        </select>
                        <div class="invalid-feedback">Selecione um curso.</div>
                      </div>
                      <div class="col-md-4">
                        <label for="periodo" class="form-label">Período</label>
                        <select class="form-select bg-dark text-white border-light" id="periodo" required>
                          <option value="" disabled selected>Selecione</option>
                          <option>1º</option>
                          <option>2º</option>
                          <option>3º</option>
                          <option>4º</option>
                          <option>5º</option>
                          <option>6º</option>
                          <option>7º</option>
                          <option>8º</option>
                        </select>
                        <div class="invalid-feedback">Selecione um período.</div>
                      </div>
                      <div class="col-md-4">
                        <label for="turno" class="form-label">Turno</label>
                        <select class="form-select bg-dark text-white border-light" id="turno" required>
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
        <div id="sec-estagios" class="secao-ocultavel" style="display: none;">
            <h2><i class="bi bi-briefcase-fill me-2"></i>Estágios</h2>
          <!-- Filtros e Botões -->
              <div class="container my-4">
                  
                  <!-- Botão Criar Estágio -->
                      <!-- Linha de Botão + Filtro Status -->
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <!-- Botão Criar Estágio à esquerda -->
                    <div>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCriarEstagio">
                            <i class="bi bi-plus-circle me-2"></i> Criar Estágio
                        </button>
                    </div>

                    <!-- Filtro Status à direita -->
                    <div style="width: 200px;"> <!-- controla a largura -->
                        <label for="filtroStatus" class="form-label">Status</label>
                        <select id="filtroStatus" class="form-select bg-dark text-white border-secondary">
                            <option value="">Todos</option>
                            <option value="Em Curso">Em Curso</option>
                            <option value="Concluído">Concluído</option>
                            <option value="Aprovado">Aprovado</option>
                            <option value="Encerrado">Encerrado</option>
                            <option value="Pendentes">Pendentes</option>
                        </select>
                    </div>
                  </div>


                  <!-- Card de Totais -->
                  <div class="row mb-3">
                      <div class="col-md-4">
                          <div class="card text-white bg-dark">
                              <div class="card-body">
                                  <h5 class="card-title">Total de Estágios</h5>
                                  <p id="totalEstagios" class="card-text">10</p>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="card text-white bg-dark">
                              <div class="card-body">
                                  <h5 class="card-title">Aprovados</h5>
                                  <p id="totalAprovados" class="card-text">3</p>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="card text-white bg-dark">
                              <div class="card-body">
                                  <h5 class="card-title">Pendentes</h5>
                                  <p id="totalPendentes" class="card-text">7</p>
                              </div>
                          </div>
                      </div>
                  </div>

                  <!-- Tabela de Estágios -->
                  <table id="tabelaEstagios" class="table table-dark table-bordered">
                      <thead>
                          <tr>
                              <th>Empresa</th>
                              <th>Curso</th>
                              <th>Duração</th>
                              <th>Período</th>
                              <th>Início</th>
                              <th>Término</th>
                              <th>Status</th>
                              <th>Estagiário</th>
                              <th>Ações</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>Sig2000</td>
                              <td>Engenharia</td>
                              <td>1 ano</td>
                              <td>Manhã</td>
                              <td>01/08/2024</td>
                              <td>01/08/2025</td>
                              <td>Pendentes</td>
                              <td> Yuri Eduardo</td>
                              <td>
                                <button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarEstagio">
                                  <i class="bi bi-pencil"></i>
                                </button>
                                
                                <button class="btn btn-outline-light btn-sm">
                                  <i class="bi bi-trash"></i>
                                </button>
                                
                                <button class="btn btn-outline-light btn-sm">
                                  <i class="bi bi-paperclip"></i>
                                </button>
                                
                                <button class="btn btn-outline-light btn-sm">
                                  <i class="bi bi-check-circle"></i>
                                </button>    </td>
                          </tr>
                      </tbody>
                  </table>
              </div>
            <!-- Modal Criar Estágio -->
            <div class="modal fade" id="modalCriarEstagio" tabindex="-1" aria-labelledby="modalCriarEstagioLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="modalCriarEstagioLabel">Criar Estágio</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body bg-dark text-white">
                          <form id="formCriarEstagio">
                              <div class="mb-3">
                                  <label for="empresa" class="form-label">Empresa</label>
                                  <input type="text" class="form-control" id="empresa" required>
                              </div>
                              <div class="mb-3">
                                  <label for="curso" class="form-label">Curso</label>
                                  <input type="text" class="form-control" id="curso" required>
                              </div>
                              <div class="mb-3">
                                  <label for="duracao" class="form-label">Duração</label>
                                  <input type="text" class="form-control" id="duracao" placeholder="Em meses" required>
                              </div>
                              <div class="mb-3">
                                  <label for="periodo" class="form-label">Período</label>
                                  <select class="form-select" id="periodo" required>
                                      <option value="Manhã">Manhã</option>
                                      <option value="Tarde">Tarde</option>
                                  </select>
                              </div>
                              <div class="mb-3">
                                  <label for="inicio" class="form-label">Início</label>
                                  <input type="date" class="form-control" id="inicio" required>
                              </div>
                              <div class="mb-3">
                                  <label for="termino" class="form-label">Término</label>
                                  <input type="date" class="form-control" id="termino" required>
                              </div>
                              <div class="mb-3">
                                  <label for="status" class="form-label">Status</label>
                                  <select class="form-select" id="status" required>
                                      <option value="Pendentes">Pendentes</option>
                                      <option value="Aprovado">Aprovado</option>
                                      <option value="Concluído">Concluído</option>
                                      <option value="Encerrado">Encerrado</option>
                                  </select>
                              </div>
                          </form>
                      </div>
                      <div class="modal-footer bg-dark text-white">
                          <button type="button" class="btn btn-outline-light " id="btnCriarEstagio">Criar Estágio</button>
                          <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancelar</button>
                      </div>
                  </div>
              </div>
            </div>

            <!-- Modal Criar Estágio -->
            <div class="modal fade" id="modalCriarEstagio" tabindex="-1" aria-labelledby="modalCriarEstagioLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCriarEstagioLabel">Criar Estágio</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formCriarEstagio">
                                <div class="mb-3">
                                    <label for="empresa" class="form-label">Empresa</label>
                                    <input type="text" class="form-control" id="empresa" required>
                                </div>
                                <div class="mb-3">
                                    <label for="curso" class="form-label">Curso</label>
                                    <input type="text" class="form-control" id="curso" required>
                                </div>
                                <div class="mb-3">
                                    <label for="carga" class="form-label">Carga Horária</label>
                                    <input type="text" class="form-control" id="carga" required>
                                </div>
                                <div class="mb-3">
                                    <label for="periodo" class="form-label">Período</label>
                                    <select class="form-select" id="periodo" required>
                                        <option value="Manhã">Manhã</option>
                                        <option value="Tarde">Tarde</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="inicio" class="form-label">Início</label>
                                    <input type="date" class="form-control" id="inicio" required>
                                </div>
                                <div class="mb-3">
                                    <label for="termino" class="form-label">Término</label>
                                    <input type="date" class="form-control" id="termino" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" required>
                                        <option value="Pendentes">Pendentes</option>
                                        <option value="Aprovado">Aprovado</option>
                                        <option value="Concluído">Concluído</option>
                                        <option value="Encerrado">Encerrado</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" id="btnCriarEstagio">Criar Estágio</button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Editar Estágio -->
            <div class="modal fade" id="modalEditarEstagio" tabindex="-1" aria-labelledby="modalEditarEstagioLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditarEstagioLabel">Editar Estágio</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formEditarEstagio">
                                <div class="mb-3">
                                    <label for="editEmpresa" class="form-label">Empresa</label>
                                    <input type="text" class="form-control" id="editEmpresa" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editCurso" class="form-label">Curso</label>
                                    <input type="text" class="form-control" id="editCurso" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editCarga" class="form-label">Carga Horária</label>
                                    <input type="text" class="form-control" id="editCarga" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editPeriodo" class="form-label">Período</label>
                                    <select class="form-select" id="editPeriodo" required>
                                        <option value="Manhã">Manhã</option>
                                        <option value="Tarde">Tarde</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="editInicio" class="form-label">Início</label>
                                    <input type="date" class="form-control" id="editInicio" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editTermino" class="form-label">Término</label>
                                    <input type="date" class="form-control" id="editTermino" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editStatus" class="form-label">Status</label>
                                    <select class="form-select" id="editStatus" required>
                                        <option value="Pendentes">Pendentes</option>
                                        <option value="Aprovado">Aprovado</option>
                                        <option value="Concluído">Concluído</option>
                                        <option value="Encerrado">Encerrado</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" id="btnSalvarEdicaoEstagio">Salvar</button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div> 
        </div>   
        <!-- seção relatórios -->
        <div id="sec-relatorios" class="secao-ocultavel" style="display: none;">
          <h2><i class="bi bi-file-earmark-bar-graph-fill me-2"></i>Relatórios</h2>
          <div class="tab-content bg-dark p-4 mx-4 my-4 rounded border border-secondary text-white">

      <!-- Aba Relatórios -->
         <div id="sec-empresa-relatorios" class="secao-ocultavel" style="display: none;">
         <h3 class="mb-4">
          <i class="bi bi-bar-chart-line-fill me-2"></i>Relatórios
        </h3>

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

          <!-- Tabela de Relatórios -->
          <!-- Tabela de Relatórios Padrão -->
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
              <form action="php/salvar_relatorio.php" method="POST">
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
      <form action="php/salvar_relatorio.php" method="POST">
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
                <form action="php/salvar_relatorio.php" method="POST">
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
                <form action="php/salvar_relatorio.php" method="POST">
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
                <form action="php/salvar_relatorio.php" method="POST">
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
                  <form action="php/salvar_relatorio.php" method="POST">
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
                        <form action="php/salvar_relatorio.php" method="POST">
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
                          <form action="php/salvar_relatorio.php" method="POST">
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
              <form action="../php/uploadRelatorio.php" method="POST" enctype="multipart/form-data">
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
            <input type="file" class="form-control bg-light text-dark" id="relatorioFile" name="relatorioFile" required>
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
          </div>

      </div>
        <!-- seção vagas -->
         <div id="sec-empresa-vagas" class="secao-ocultavel" style="display: none;">
        <h3 class="mb-4"><i class="bi bi-megaphone-fill me-2"></i>Vagas</h3>
         <div class="mb-4">
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
        <!-- seção usuários -->
        <div id="sec-usuarios" class="secao-ocultavel" style="display: none;">
           <h2> <i class="bi bi-person-gear me-2"></i>Usuário</h2>
          <div class="container mt-4">
            <!-- Seção de Usuários -->
            <div id="secaoUsuarios" class="bg-dark text-white p-3 rounded">
              <div class="container-fluid text-white mt-4">
                <div class="d-flex mb-3">
                  <button class="btn btn-dark me-2 active" id="btnUsuarios" onclick="toggleSection('usuarios')">Usuários</button>
                  <button class="btn btn-dark" id="btnPerfis" onclick="toggleSection('perfis')">Perfis</button>
                </div>

                <!-- Seção Usuários -->
                <div id="usuariosSection">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>Lista de Usuários</h5>
                    <div>
                      <button class="btn btn-success me-2">Novo Usuário</button>
                      <button class="btn btn-primary me-2">Modificar Dados</button>
                      <button class="btn btn-danger">Apagar Usuário</button>
                    </div>
                  </div>
                  <table class="table table-dark table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>Nome do Usuário</th>
                        <th>Nome Completo</th>
                        <th>Perfil</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Yuri</td>
                        <td>yuri@gmail.com</td>
                        <td>Adm</td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <!-- Seção Perfis -->
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
            </div>

            <!-- Conteúdo de perfil -->
            <div id="secaoPerfis" style="display: none;">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Gerenciar Perfil</h5>
                <button id="btnPerfil" class="btn btn-success btn-sm">
                  <i class="bi bi-plus-circle"></i> Criar Novo Perfil
                </button>
              </div>
              <div class="table-responsive">
                <table class="table table-dark table-striped table-bordered align-middle">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th class="text-center">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Adm</td>
                      <td class="text-center">
                        <button class="btn btn-outline-light btn-sm me-1">
                          <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-outline-light btn-sm">
                          <i class="bi bi-trash"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Modal Novo Usuário -->
            <div class="modal fade" id="novoUsuarioModal" tabindex="-1" aria-labelledby="novoUsuarioModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content bg-dark text-white" data-bs-theme="dark">
                  <div class="modal-header">
                    <h5 class="modal-title" id="novoUsuarioModalLabel">Criar Novo Usuário</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                  </div>
                  <div class="modal-body">
                    <form>
                      <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control bg-secondary text-white" id="nome" placeholder="Digite o nome">
                      </div>
                      <div class="mb-3">
                        <label for="usuario" class="form-label">Usuário</label>
                        <input type="text" class="form-control bg-secondary text-white" id="usuario" placeholder="Digite o usuário">
                      </div>
                      <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control bg-secondary text-white" id="senha" placeholder="Digite a senha">
                      </div>
                      <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control bg-secondary text-white" id="email" placeholder="Digite o email">
                      </div>
                      <div class="mb-3">
                        <label for="perfil" class="form-label">Perfil</label>
                        <select class="form-select bg-secondary text-white" id="perfil">
                          <option>Administrador</option>
                          <option>Editor</option>
                          <option>Leitor</option>
                        </select>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                  </div>
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
          </div>
        </div>
          
        <!-- seção mensagens -->
          <!-- Seção de Mensagens -->
           <?php
            session_start();
            include 'backend/listar_mensagens.php'; 
            // listar_mensagens.php deve definir $mensagens = array com mensagens do usuário logado

            // Exemplo de listar_mensagens.php (simplificado):
            // $usuario_id = $_SESSION['id'] ?? 1;
            // $stmt = $conn->prepare("SELECT m.id, u.email AS remetente, m.assunto, m.data_envio, m.mensagem FROM mensagens m JOIN usuarios u ON m.remetente_id = u.id WHERE m.destinatario_id = ? ORDER BY m.data_envio DESC");
            // $stmt->bind_param("i", $usuario_id);
            // $stmt->execute();
            // $result = $stmt->get_result();
            // $mensagens = $result->fetch_all(MYSQLI_ASSOC);
            ?>
      <div class="container mt-4">
        <h3 class="mb-4">
          <i class="bi bi-chat-left-text-fill me-2"></i>Mensagens
        </h3>
        <button class="btn btn-dark mb-3" onclick="toggleSection('sec-empresa-mensagens')">Gerenciar Mensagens</button>
      </div>

      <div id="sec-empresa-mensagens" class="secao-ocultavel" style="display: none;">
        <div class="container mt-4">

          <!-- Conteúdo das abas -->
          <div class="tab-content bg-dark p-3 rounded-bottom border border-secondary" style="min-height: 400px;">
            <h3 class="mb-4 text-white">
              <i class="bi bi-envelope-fill me-2"></i>Mensagens
            </h3>

            <!-- Abas -->
            <ul class="nav nav-tabs mb-4" id="mensagemTab" role="tablist">
              <li class="nav-item bg-light text-dark" role="presentation">
                <button class="nav-link active" id="entrada-tab" data-bs-toggle="tab" data-bs-target="#entrada" type="button" role="tab" aria-controls="entrada" aria-selected="true">Caixa de Entrada</button>
              </li>
              <li class="nav-item bg-light text-dark ms-2" role="presentation">
                <button class="nav-link" id="nova-tab" data-bs-toggle="tab" data-bs-target="#nova" type="button" role="tab" aria-controls="nova" aria-selected="false">Nova Mensagem</button>
              </li>
            </ul>

            <!-- Caixa de Entrada -->
            <div class="tab-pane fade show active" id="entrada" role="tabpanel" aria-labelledby="entrada-tab">
              <div class="d-flex mb-3 gap-2">
                <input type="text" class="form-control bg-light text-dark" placeholder="Buscar por assunto, remetente..." id="buscaMensagem">
                <select class="form-select bg-light text-dark" id="filtroRemetente" style="max-width: 200px;">
                  <option value="todos">Todos</option>
                  <option value="aluno">Alunos</option>
                  <option value="empresa">Empresas</option>
                </select>
              </div>

              <!-- Lista de mensagens -->
              <div class="list-group" id="listaMensagens">
                <?php foreach ($mensagens as $msg): ?>
                  <button type="button" class="list-group-item list-group-item-action bg-dark text-white border-bottom" data-bs-toggle="modal" data-bs-target="#modalMensagem<?= $msg['id'] ?>">
                    <strong>📧 <?= htmlspecialchars($msg['assunto']) ?></strong><br>
                    <small>De: <?= htmlspecialchars($msg['remetente']) ?> | <?= date('d/m/Y H:i', strtotime($msg['data_envio'])) ?></small>
                  </button>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Nova Mensagem -->
            <div class="tab-pane fade text-white" id="nova" role="tabpanel" aria-labelledby="nova-tab">
              <form method="POST" action="backend/enviar_mensagem.php" enctype="multipart/form-data" novalidate>
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
                    required>
                </div>
                <div class="mb-3">
                  <label for="destinatario" class="form-label">Destinatário</label>
                  <input 
                    type="email" 
                    name="destinatario" 
                    class="form-control bg-light text-dark" 
                    id="destinatario" 
                    placeholder="E-mail do destinatário"
                    required>
                </div>
                <div class="mb-3">
                  <label for="assunto" class="form-label">Assunto</label>
                  <input 
                    type="text" 
                    name="assunto" 
                    class="form-control bg-light text-dark" 
                    id="assunto" 
                    placeholder="Assunto da mensagem"
                    required>
                </div>
                <div class="mb-3">
                  <label for="mensagem" class="form-label">Mensagem</label>
                  <textarea 
                    name="mensagem" 
                    class="form-control bg-light text-dark" 
                    id="mensagem" 
                    rows="5" 
                    placeholder="Escreva sua mensagem aqui..."
                    required></textarea>
                </div>
                <div class="mb-3">
                  <label for="anexo" class="form-label">Anexo</label>
                  <input type="file" name="anexo" id="anexo" class="form-control bg-light text-dark">
                </div>
                <button type="submit" class="btn btn-success">Enviar</button>
              </form>
            </div>
          </div>
        </div>

        <!-- MODAIS MENSAGENS -->
        <?php foreach ($mensagens as $mensagem): ?>
          <div class="modal fade" id="modalMensagem<?= $mensagem['id'] ?>" tabindex="-1" aria-labelledby="modalMensagem<?= $mensagem['id'] ?>Label" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
              <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalMensagem<?= $mensagem['id'] ?>Label">
                    Assunto: <?= htmlspecialchars($mensagem['assunto']) ?>
                  </h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                  <p><strong>Remetente:</strong> <?= htmlspecialchars($mensagem['remetente']) ?></p>
                  <p><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($mensagem['data_envio'])) ?></p>
                  <hr>
                  <p><?= nl2br(htmlspecialchars($mensagem['mensagem'])) ?></p>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-outline-success" data-bs-toggle="collapse" data-bs-target="#resposta<?= $mensagem['id'] ?>" aria-expanded="false" aria-controls="resposta<?= $mensagem['id'] ?>">
                    Responder
                  </button>
                </div>
                <div class="collapse p-3" id="resposta<?= $mensagem['id'] ?>">
                  <form action="backend/responder_mensagem.php" method="POST" novalidate>
                    <input type="hidden" name="mensagem_id" value="<?= $mensagem['id'] ?>">
                    <input type="hidden" name="remetente" value="<?= htmlspecialchars($_SESSION['email'] ?? 'empresa@email.com') ?>">
                    <textarea name="resposta" class="form-control bg-light text-dark mb-2" rows="4" placeholder="Digite sua resposta..." required></textarea>
                    <button type="submit" class="btn btn-success">Enviar Resposta</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      
        <!-- seção documentos -->
        <div id="sec-documentos" class="secao-ocultavel" style="display: none;">
          <h2><i class="bi bi-file-earmark-text-fill me-2"></i>Documento</h2> 
          <div class="tab-content bg-dark p-4 mx-4 my-4 rounded border border-secondary text-white">

      <!-- Aba Documentos -->
      <div class="tab-pane fade show active" id="documentos">
        <div class="d-flex justify-content-between mb-3">
          <!-- Filtros -->
          <div>
            <input type="text" class="form-control bg-light text-dark mb-2" placeholder="Buscar documentos...">
            <select class="form-select bg-light text-dark" aria-label="Filtrar por categoria">
              <option selected>Filtrar por categoria</option>
              <option value="1">Categoria 1</option>
              <option value="2">Categoria 2</option>
              <option value="3">Categoria 3</option>
            </select>
          </div>

          <!-- Botão de Upload -->
          <div>
            <button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal">+ Novo Documento</button>
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
                <button class="btn btn-outline-light btn-sm">Visualizar</button>
                <button class="btn btn-outline-light btn-sm">Excluir</button>
              </td>
            </tr>
            <tr>
              <td>Documento Exemplo 2.pdf</td>
              <td>Categoria 2</td>
              <td>02/05/2025</td>
              <td>
                <button class="btn btn-outline-light btn-sm">Visualizar</button>
                <button class="btn btn-outline-light btn-sm">Excluir</button>
              </td>
            </tr>
            <!-- Mais documentos podem ser listados aqui -->
          </tbody>
        </table>
      </div>

             </div>

            <!-- Modal de Upload de Documento -->
            <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content bg-dark text-white">
                  <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload de Documento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                  </div>
                  <div class="modal-body">
                    <form>
                      <div class="mb-3">
                        <label for="documentName" class="form-label">Nome do Documento</label>
                        <input type="text" class="form-control bg-light text-dark" id="documentName" placeholder="Nome do Documento">
                      </div>
                      <div class="mb-3">
                        <label for="documentCategory" class="form-label">Categoria</label>
                        <select class="form-select bg-light text-dark" id="documentCategory">
                          <option selected>Escolha a categoria</option>
                          <option value="1">Categoria 1</option>
                          <option value="2">Categoria 2</option>
                          <option value="3">Categoria 3</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="documentFile" class="form-label">Arquivo</label>
                        <input type="file" class="form-control bg-light text-dark" id="documentFile">
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary">Salvar Documento</button>
                  </div>
                </div>
              </div>
            </div>

        </div>
        <!-- seção configurações -->
        <div id="sec-configuracoes" class="secao-ocultavel" style="display: none;">
          <div class="container mt-4">
            <h3 class="mb-4"> <i class="bi bi-gear-fill me-2"></i> Configurações</h3>

          

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
        </div>
      </main>
  </div>
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../script/script.js"></script> <!-- JS externo aqui -->
</body>
</html>
