<?php
// Simulação de envio para assinatura digital
$arquivo = 'contratos/documentos/contrato_' . $_GET['id'] . '.pdf';

// Verifica se o arquivo existe
if (!file_exists($arquivo)) {
    die("Contrato não encontrado.");
}

// Aqui entra o envio real via cURL ou SDK da plataforma
// Exemplo de estrutura para chamada da API (Gov.br exige token OAuth + multipart)

echo "Contrato enviado com sucesso para assinatura digital (simulado).";
// Aqui você armazenaria o status da assinatura (ex: em uma tabela `assinaturas`)
