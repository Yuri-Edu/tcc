<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'db.php';

if ($conn) {
    echo "Conexão funcionando!";
} else {
    echo "Erro na conexão.";
}
?>
