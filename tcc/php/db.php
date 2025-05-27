<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "conect";

// Conexão
$conn = new mysqli($servidor, $usuario, $senha, $banco);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
