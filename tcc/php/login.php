<?php
session_start();
include('conexao.php');

// Recebe os dados do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];

// Consulta o banco
$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql);

// Verifica se encontrou o email
if($result->num_rows > 0){
    $row = $result->fetch_assoc();

    // Verifica a senha
    if(password_verify($senha, $row['senha'])){
        // Salva dados na sessão
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['perfil'] = $row['perfil'];

        // Redireciona para o perfil correto
        if($row['perfil'] == 'aluno'){
            header('Location: ../aluno/perfil.php');
        } elseif($row['perfil'] == 'empresa'){
            header('Location: ../empresa/perfil.php');
        } elseif($row['perfil'] == 'instituicao'){
            header('Location: ../instituicao/perfil.php');
        } else {
            echo "Perfil não identificado!";
        }
        exit();

    } else {
        echo "Senha incorreta";
    }

} else {
    echo "Email não encontrado";
}

$conn->close();
?>
