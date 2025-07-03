<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/erro_curriculo.log');
error_reporting(E_ALL);


require '../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Lê os dados do JSON enviado via JavaScript (fetch)
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    die("Erro: Nenhum dado recebido.");
}

// Função para evitar warnings e retornar vazio se não existir
function safe($array, $key) {
    return isset($array[$key]) ? $array[$key] : '';
}

// Dados pessoais
$nome = safe($data, 'nome');
$dataNascimento = safe($data, 'dataNascimento');
$idade = safe($data, 'idade');
$email = safe($data, 'email');
$telefone = safe($data, 'telefone');
$cidade = safe($data, 'cidade');
$estado = safe($data, 'estado');
$linkedin = safe($data, 'linkedin');
$portfolio = safe($data, 'portfolio');
$sobreMim = nl2br(safe($data, 'sobreMim'));
$objetivoProfissional = nl2br(safe($data, 'objetivoProfissional'));

// Blocos
$experiencias = $data['experiencias'] ?? [];
$formacoes = $data['formacoes'] ?? [];
$idiomas = $data['idiomas'] ?? [];
$habilidadesTecnicas = $data['habilidadesTecnicas'] ?? [];
$softSkills = safe($data, 'softSkills');
$certificacoes = $data['certificacoes'] ?? [];

// Monta o HTML do currículo
ob_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
    h1, h2 { margin: 10px 0; }
    .secao { margin-bottom: 15px; }
    .titulo-secao { background: #eee; padding: 5px; font-weight: bold; }
    ul { padding-left: 20px; }
  </style>
</head>
<body>

<h1 style="text-align: center;"><?= $nome ?></h1>
<p>
    Idade: <?= $idade ?> | Email: <?= $email ?> | Telefone: <?= $telefone ?><br>
    Cidade: <?= $cidade ?> - <?= $estado ?><br>
    <?php if ($linkedin): ?>LinkedIn: <?= $linkedin ?><br><?php endif; ?>
    <?php if ($portfolio): ?>Portfolio: <?= $portfolio ?><br><?php endif; ?>
</p>

<div class="secao">
    <div class="titulo-secao">Sobre Mim</div>
    <p><?= $sobreMim ?></p>
</div>

<div class="secao">
    <div class="titulo-secao">Objetivo Profissional</div>
    <p><?= $objetivoProfissional ?></p>
</div>

<?php if (!empty($experiencias)): ?>
<div class="secao">
    <div class="titulo-secao">Experiência Profissional</div>
    <?php foreach ($experiencias as $exp): ?>
        <p><strong><?= safe($exp, 'cargo') ?></strong> em <?= safe($exp, 'empresa') ?><br>
        <?= safe($exp, 'inicio') ?> até <?= safe($exp, 'fim') ?: 'Atualmente' ?><br>
        <?= nl2br(safe($exp, 'atividades')) ?>
        </p>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<?php if (!empty($formacoes)): ?>
<div class="secao">
    <div class="titulo-secao">Formação Acadêmica</div>
    <?php foreach ($formacoes as $form): ?>
        <p>
            <strong><?= safe($form, 'curso') ?></strong> (<?= safe($form, 'grau') ?>)<br>
            <?= safe($form, 'instituicao') ?> - <?= safe($form, 'situacao') ?><br>
            <?= safe($form, 'inicio') ?> até <?= safe($form, 'fim') ?>
        </p>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<?php if (!empty($idiomas)): ?>
<div class="secao">
    <div class="titulo-secao">Idiomas</div>
    <ul>
        <?php foreach ($idiomas as $i): ?>
            <li><?= safe($i, 'idioma') ?> - <?= safe($i, 'nivel') ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<?php if (!empty($habilidadesTecnicas)): ?>
<div class="secao">
    <div class="titulo-secao">Habilidades Técnicas</div>
    <ul>
        <?php foreach ($habilidadesTecnicas as $h): ?>
            <li><?= safe($h, 'habilidade') ?> - <?= safe($h, 'nivel') ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<?php if ($softSkills): ?>
<div class="secao">
    <div class="titulo-secao">Habilidades Comportamentais (Soft Skills)</div>
    <p><?= nl2br($softSkills) ?></p>
</div>
<?php endif; ?>

<?php if (!empty($certificacoes)): ?>
<div class="secao">
    <div class="titulo-secao">Certificações</div>
    <ul>
        <?php foreach ($certificacoes as $c): ?>
            <li><?= safe($c, 'nome') ?> - <?= safe($c, 'instituicao') ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

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

$dompdf->stream("curriculo.pdf", ["Attachment" => false]);
exit;

?>
