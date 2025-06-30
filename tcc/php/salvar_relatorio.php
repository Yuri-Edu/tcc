<?php
require_once 'db.php';
require_once '../vendor/autoload.php'; // Dompdf
use Dompdf\Dompdf;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Função para escapar strings
function esc($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// Dados recebidos do formulário
$tipo = $_POST['tipo'] ?? '';
$comentario = esc($_POST['comentario'] ?? '');
$data_hoje = date('d/m/Y');

// Definições
$titulo = "";
$html = "";
$gerarTabela = true;

// Lógica para cada tipo de relatório
switch ($tipo) {
    case 'estagiarios_ativos':
        $titulo = "Relatório de Estagiários Ativos";
        $sql = "SELECT a.nome AS Nome, a.curso AS Curso, e.nome AS Empresa, es.status AS Status
                FROM estagios es
                JOIN alunos a ON es.aluno_id = a.id
                JOIN empresa e ON es.empresa_id = e.id
                WHERE es.status = 'Ativo'";
        break;

    case 'pendentes_aprovacao':
        $titulo = "Estágios Pendentes de Aprovação";
        $sql = "SELECT a.nome AS Nome, e.nome AS Empresa, es.status AS Status, es.inicio AS Início
                FROM estagios es
                JOIN alunos a ON es.aluno_id = a.id
                JOIN empresa e ON es.empresa_id = e.id
                WHERE es.status = 'Pendente'";
        break;

    case 'estagios_por_status':
        $titulo = "Relatório de Estágios por Status";
        $status = $conn->real_escape_string($_POST['status'] ?? '');
        $sql = "SELECT status AS Status, COUNT(*) AS Quantidade FROM estagios";
        if (!empty($status)) {
            $sql .= " WHERE status = '$status'";
        }
        $sql .= " GROUP BY status";
        break;

    case 'estagios_por_curso':
        $titulo = "Relatório de Estágios por Curso";
        $curso = $conn->real_escape_string($_POST['curso'] ?? '');
        $sql = "SELECT curso AS Curso, COUNT(*) AS Total FROM estagios";
        if (!empty($curso)) {
            $sql .= " WHERE curso = '$curso'";
        }
        $sql .= " GROUP BY curso";
        break;

    case 'estagios_por_periodo':
        $titulo = "Relatório de Estágios por Período";
        $periodo = $conn->real_escape_string($_POST['periodo'] ?? '');
        $sql = "SELECT periodo AS Período, COUNT(*) AS Total FROM estagios";
        if (!empty($periodo)) {
            $sql .= " WHERE periodo = '$periodo'";
        }
        $sql .= " GROUP BY periodo";
        break;

    case 'estagios_a_encerrar':
        $titulo = "Estágios a Encerrar em até 30 dias";
        $sql = "SELECT a.nome AS Nome, es.termino AS Término, e.nome AS Empresa
                FROM estagios es
                JOIN alunos a ON es.aluno_id = a.id
                JOIN empresa e ON es.empresa_id = e.id
                WHERE es.termino <= CURDATE() + INTERVAL 30 DAY
                  AND es.status = 'Em curso'";
        break;

    case 'faltas_avaliacoes':
        $titulo = "Relatório de Faltas e Avaliações";
        $faltas = $_POST['faltas'] ?? [];
        $avaliacao_desempenho = esc($_POST['avaliacao_desempenho'] ?? '');
        $avaliacao_assiduidade = esc($_POST['avaliacao_assiduidade'] ?? '');

        // Monta HTML direto sem tabela
        $html .= "<h2>$titulo</h2>
        <p><strong>Gerado em:</strong> $data_hoje</p>";
        if ($comentario) {
            $html .= "<p><strong>Comentário:</strong> $comentario</p>";
        }
        $html .= "<h3>Faltas</h3><ul>";
        foreach ($faltas as $f) {
            if (!empty($f)) $html .= "<li>" . esc($f) . "</li>";
        }
        $html .= "</ul>
        <h3>Avaliações</h3>
        <p><strong>Desempenho:</strong> $avaliacao_desempenho</p>
        <p><strong>Assiduidade:</strong> $avaliacao_assiduidade</p>";
        $gerarTabela = false;
        break;

    case 'geral_estagios':
        $titulo = "Relatório Geral de Estágios";
        $curso = $conn->real_escape_string($_POST['curso'] ?? '');
        $periodo = $conn->real_escape_string($_POST['periodo'] ?? '');
        $status = $conn->real_escape_string($_POST['status'] ?? '');

        $sql = "SELECT a.nome AS Nome, a.curso AS Curso, es.periodo AS Período, es.status AS Status, e.nome AS Empresa
                FROM estagios es
                JOIN alunos a ON es.aluno_id = a.id
                JOIN empresa e ON es.empresa_id = e.id
                WHERE 1=1";
        if ($curso) $sql .= " AND a.curso = '$curso'";
        if ($periodo) $sql .= " AND es.periodo = '$periodo'";
        if ($status) $sql .= " AND es.status = '$status'";
        break;

    default:
        die("Tipo de relatório inválido.");
}

// Monta HTML com tabela se necessário
if ($gerarTabela) {
    $result = $conn->query($sql);
    if (!$result) {
        die("Erro: " . $conn->error);
    }

    $html .= "
    <style>
        body { font-family: Arial; font-size: 12px; color: #000; }
        h2 { margin-bottom: 0; }
        .date { font-size: 10px; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #eee; }
    </style>
    <h2>$titulo</h2>
    <p class='date'>Gerado em: $data_hoje</p>";

    if ($comentario) {
        $html .= "<p><strong>Comentário:</strong> $comentario</p>";
    }

    $html .= "<table><thead><tr>";
    foreach ($result->fetch_fields() as $field) {
        $html .= "<th>" . esc($field->name) . "</th>";
    }
    $html .= "</tr></thead><tbody>";

    while ($row = $result->fetch_assoc()) {
        $html .= "<tr>";
        foreach ($row as $valor) {
            $html .= "<td>" . esc($valor) . "</td>";
        }
        $html .= "</tr>";
    }

    $html .= "</tbody></table>";
}

// Gerar PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Nome do arquivo
$nome_arquivo = "relatorio_{$tipo}_" . date('Ymd_His') . ".pdf";
$caminho = "../relatorios/$nome_arquivo";

// Salva no servidor
file_put_contents($caminho, $dompdf->output());

// Exibe no navegador
$dompdf->stream($nome_arquivo, ["Attachment" => false]); // true para forçar download
exit;
