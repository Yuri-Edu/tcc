<?php
$servidor = "sql200.infinityfree.com";  // Host (está no painel do InfinityFree)
$usuario = "if0_39123017";              // Seu nome de usuário MySQL (está no painel)
$senha = "0Y4h9ThoEpaXWRL";              // Sua senha MySQL (a que você cadastrou)
$banco = "if0_39123017_conect";       // Nome do banco que você criou

// Conectar
$conn = mysqli_connect($servidor, $usuario, $senha, $banco);

// Verificar conexão
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

//echo "Conexão realizada com sucesso!";
?>