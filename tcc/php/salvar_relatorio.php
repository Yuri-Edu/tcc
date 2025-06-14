<?php
require_once 'conexao.php';

// DOMPDF
require_once 'vendor/autoload.php'; // se usa Composer
use Dompdf\Dompdf;

$tipo = $_POST['tipo'] ?? '';
$comentario = $_POST['comentario'] ?? '';
$gerar_pdf = true; // Mude para false se quiser exibir HTML na tela

function esc($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// Switch de SQL
switch ($tipo) {
    case 'estagios_por_status':
        $sql = "SELECT status, COUNT(*) as quantidade FROM estagios GROUP BY status";
        $titulo = "Relatório de Estágios por Status";
        break;

    case 'estagios_por_curso':
        $sql = "SELECT curso, COUNT(*) as total FROM estagios GROUP BY curso";
        $titulo = "Relatório de Estágios por Curso";
        break;

    case 'estagios_por_periodo':
        $sql = "SELECT periodo, COUNT(*) as total FROM estagios GROUP BY periodo";
        $titulo = "Relatório de Estágios por Período";
        break;

    default:
        die("Tipo inválido");
}

$result = $conn->query($sql);
if (!$result) {
    die("Erro: " . $conn->error);
}

// Montar HTML do relatório
$html = "
<style>
    body { font-family: Arial; font-size: 12px; color: #000; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    th { background: #eee; }
</style>
<h2>$titulo</h2>";

if (!empty($comentario)) {
    $html .= "<p><strong>Comentário:</strong> " . esc($comentario) . "</p>";
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

// Gera o PDF com Dompdf
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("relatorio_$tipo.pdf", ["Attachment" => false]); // Attachment true = download automático
exit;
