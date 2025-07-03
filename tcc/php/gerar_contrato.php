<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;
include 'db.php';

setlocale(LC_TIME, 'pt_BR.UTF-8');

// Lista de campos esperados
$campos = [
    'nome_empresa', 'cnpj', 'endereco', 'telefone_empresa', 'responsavel',
    'nome_aluno', 'data_nascimento', 'cpf', 'email_aluno', 'telefone_aluno',
    'nome_instituicao', 'cnpj_instituicao', 'endereco_instituicao', 'telefone_instituicao', 'email_instituicao',
    'inicio', 'termino', 'carga_horaria', 'valor_bolsa'
];

// Inicializa os dados com null
$dados = array_fill_keys($campos, null);

// Verifica conexão com o banco
if (!$conn) {
    die("Erro na conexão com o banco de dados.");
}

// 1. Busca via banco de dados
if (isset($_GET['id']) && (int)$_GET['id'] > 0) {
    $candidatura_id = (int)$_GET['id'];

    $sql = "SELECT contratos.inicio, contratos.termino, contratos.carga_horaria, contratos.valor_bolsa,
                   alunos.nome AS nome_aluno, alunos.data_nascimento, alunos.cpf, alunos.email AS email_aluno, alunos.telefone AS telefone_aluno,
                   empresa.nome AS nome_empresa, empresa.cnpj, empresa.endereco, empresa.email AS email_empresa, empresa.telefone AS telefone_empresa, empresa.responsavel,
                   instituicoes.nome AS nome_instituicao, instituicoes.cnpj AS cnpj_instituicao, instituicoes.endereco AS endereco_instituicao,
                   instituicoes.telefone AS telefone_instituicao, instituicoes.email AS email_instituicao
            FROM contratos
            INNER JOIN candidaturas ON contratos.candidatura_id = candidaturas.id
            INNER JOIN alunos ON candidaturas.aluno_id = alunos.id
            INNER JOIN empresa ON candidaturas.vaga_id = empresa.id
            INNER JOIN instituicoes ON candidaturas.instituicao_id = instituicoes.id
            WHERE contratos.candidatura_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $candidatura_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $dados_banco = $result->fetch_assoc();

    if ($dados_banco) {
        foreach ($dados_banco as $chave => $valor) {
            $dados[$chave] = $valor; // mesmo que não esteja nos $campos
        }
    }
}

// 2. Preenche com POST se algum campo ainda estiver vazio
foreach ($campos as $campo) {
    if ((!isset($dados[$campo]) || $dados[$campo] === null || $dados[$campo] === '') && isset($_POST[$campo])) {
        $dados[$campo] = $_POST[$campo];
    }
}

// 3. Preenche com padrões se ainda estiverem vazios (instituição e estágio)
$dados['nome_instituicao']       = $dados['nome_instituicao'] ?? 'FAETEC';
$dados['cnpj_instituicao']       = $dados['cnpj_instituicao'] ?? '42.498.168/0001-90';
$dados['endereco_instituicao']   = $dados['endereco_instituicao'] ?? 'Rua Clarimundo de Melo, 847 - Quintino - RJ';
$dados['telefone_instituicao']   = $dados['telefone_instituicao'] ?? '(21) 2333-6633';
$dados['email_instituicao']      = $dados['email_instituicao'] ?? 'divest@faetec.rj.gov.br';
$dados['inicio']                 = $dados['inicio'] ?: date('Y-m-d');
$dados['termino']                = $dados['termino'] ?: date('Y-m-d', strtotime('+6 months'));
$dados['carga_horaria']          = $dados['carga_horaria'] ?: '30';
$dados['valor_bolsa']            = $dados['valor_bolsa'] ?: '0.00';

// 4. Imagens em base64 com verificação de existência
$logo_estado = file_exists('../img/logo_estado.png') ? base64_encode(file_get_contents('../img/logo_estado.png')) : '';
$logo_faetec = file_exists('../img/logo_faetec.png') ? base64_encode(file_get_contents('../img/logo_faetec.png')) : '';
$logo_estado_rodape = file_exists('../img/logo_estado_rodape.png') ? base64_encode(file_get_contents('../img/logo_estado_rodape.png')) : '';

// A partir daqui, continue com o ob_start() e geração do HTML/PDF normalmente
ob_start();
// ... (seu HTML continua aqui)

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 11px; margin: 20px; }
    .logo-faetec { width: 80px; }
    .header-imgs { display: flex; justify-content: space-between; align-items: center; }
    .bloco { margin: 15px 0; text-align: justify; }
    .assinaturas { margin-top: 40px; display: flex; justify-content: space-around; font-size: 10px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 10px; }
    th, td { border: 1px solid black; padding: 5px; text-align: center; }
    .assinatura { text-align: center; margin-top: 60px; }
     @page {
    margin: 120px 40px 100px 40px;
  }

  header {
    position: fixed;
    top: -100px;
    left: 0;
    right: 0;
    text-align: center;
  }

  footer {
    position: fixed;
    bottom: -80px;
    left: 0;
    right: 0;
    text-align: center;
    font-size: 10px;
  }

  .footer-logos img {
    height: 40px;
    margin: 0 10px;
  }
  </style>
</head>
<body>

<header>
  <img src="data:image/png;base64,<?= $logo_estado ?>" width="60"><br>
  <strong>
    Governo do Estado do Rio de Janeiro<br>
    Secretaria de Estado de Ciência, Tecnologia e Inovação<br>
    Fundação de Apoio à Escola Técnica
  </strong>
</header>

<footer>
  <div class="footer-logos">
    <img src="data:image/png;base64,<?= $logo_faetec ?>"  style="height: 40px;">
    <img src="data:image/png;base64,<?= $logo_estado_rodape ?>">
  </div>
</footer>


<div class="bloco">
  Considerando a LEI nº 11.788 de 25 de setembro de 2008, as partes a seguir nomeadas:
</div>

<div class="bloco">
  <strong>INTERVENIENTE:</strong><br>
  Fundação de Apoio à Escola Técnica – FAETEC/U.E.<br>
  Endereço: <?= $dados['endereco_instituicao'] ?><br>
  CNPJ: <?= $dados['cnpj_instituicao'] ?><br>
  Representada por: Diretor(a) da Unidade de Ensino
</div>

<div class="bloco">
  <strong>ESTAGIÁRIO:</strong><br>
  Nome: <?= $dados['nome_aluno'] ?><br>
  Nascimento: <?= date('d/m/Y', strtotime($dados['data_nascimento'])) ?><br>
  CPF: <?= $dados['cpf'] ?><br>
  Telefone: <?= $dados['telefone_aluno'] ?><br>
  Email: <?= $dados['email_aluno'] ?><br>
</div>

<div class="bloco">
  <strong>CONCEDENTE:</strong><br>
  Empresa: <?= $dados['nome_empresa'] ?><br>
  Endereço: <?= $dados['endereco'] ?><br>
  Telefone: <?= $dados['telefone_empresa'] ?><br>
  CNPJ: <?= $dados['cnpj'] ?><br>
  Representante: <?= $dados['responsavel'] ?><br>
</div>

<div class="bloco">
  <strong>1º</strong> Cabe à CONCEDENTE:<br>
  a) proporcionar ao estagiário treinamento prático, aperfeiçoamento técnico-cultural e de relacionamento humano no período de <?= date('d/m/Y', strtotime($dados['inicio'])) ?> a <?= date('d/m/Y', strtotime($dados['termino'])) ?>;<br>
  b) fornecer declaração de atividades ao final do estágio;<br>
  c) garantir a realização do estágio supervisionado;<br>
  d) garantir ao estagiário o seguro contra acidentes pessoais por meio da Apólice nº 87.1391.555985 da Seguradora Porto Seguro.
</div>

<div class="bloco">
  <strong>2º</strong> Cabe à INTERVENIENTE:<br>
  a) encaminhar o aluno à CONCEDENTE por meio da carta de apresentação;<br>
  b) atestar a frequência do estagiário e notificar em caso de irregularidades;<br>
  c) registrar atividades e avaliações;<br>
  d) designar professor orientador;<br>
  e) acompanhar o estágio e emitir parecer final.
</div>

<div class="bloco">
  <strong>3º</strong> Cabe ao ESTAGIÁRIO:<br>
  a) cumprir o plano de atividades estabelecido;<br>
  b) observar normas da CONCEDENTE;<br>
  c) elaborar relatórios de estágio.
</div>

<div class="bloco">
  <strong>4º</strong> O estágio não cria vínculo empregatício.<br>
  <strong>5º</strong> Atividades: auxiliar na digitalização e organização de documentos.<br>
  <strong>6º</strong> Horário do estágio:
  <table>
    <tr><th>Dia</th><th>Horário</th></tr>
    <tr><td>2ª feira</td><td>10:00 às 17:00</td></tr>
    <tr><td>3ª feira</td><td>10:00 às 17:00</td></tr>
    <tr><td>4ª feira</td><td>10:00 às 17:00</td></tr>
    <tr><td>5ª feira</td><td>10:00 às 17:00</td></tr>
    <tr><td>6ª feira</td><td>10:00 às 17:00</td></tr>
  </table>
</div>

<div class="bloco">
  <strong>7º</strong> Motivos para cessação automática:<br>
  a) abandono do curso ou trancamento de matrícula;<br>
  b) não cumprimento das cláusulas deste termo.
</div>

<div class="bloco">
  <strong>8º</strong> O estágio poderá cessar mediante comunicação escrita.<br>
  <strong>9º</strong> A duração será de no mínimo 1 semestre letivo e máximo de 2 anos.<br>
  <strong>10º</strong> A FAETEC compromete-se a acompanhar o estágio com base nos relatórios emitidos pelas partes.
</div>

<div class="assinatura">
  Rio de Janeiro, <?= strftime('%d de %B de %Y', strtotime(date('Y-m-d'))) ?>
</div>

<div class="assinaturas">
  <div>_______________________________________<br>INTERVENIENTE (Unidade FAETEC)</div>
  <div>_______________________________________<br>CONCEDENTE (Empresa)</div>
  <div>_______________________________________<br>ESTAGIÁRIO</div>
</div>

<div style="margin-top: 30px; font-size: 10px; text-align:center;">
  _______________________________________ <br>
  RESPONSÁVEL (caso o estagiário seja menor de 18 anos)
</div>

<div style="text-align: center; font-size: 9px; margin-top: 40px;">
  DIVISÃO DE ESTÁGIO - DIVEST<br>
  Rua Clarimundo de Melo, 847 – CEP 21311-281 – Quintino – Rio de Janeiro<br>
  (21) 2333-6633 / 2332-4121 | divest@faetec.rj.gov.br
</div>

</body>
</html>

<?php
$html = ob_get_clean();
$options = new Options();
$options->set('defaultFont', 'DejaVu Sans');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("termo_compromisso.pdf", ["Attachment" => false]);
exit;
