<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once 'db.php'; // Arquivo de conexão

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if (empty($email) || empty($senha)) {
        $_SESSION['erro'] = "Por favor, preencha todos os campos.";
        header("Location: ../tela_login/index.php");
        exit();
    }

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        $_SESSION['erro'] = "Erro no servidor. Tente novamente mais tarde.";
        header("Location: ../tela_login/index.php");
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['id_usuario'] = $usuario['id'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

            if ($usuario['tipo_usuario'] === 'instituicao') {
                // Busca o id da instituição associada a este usuário
                $sqlInst = "SELECT id FROM instituicao WHERE usuario = ?";
                $stmtInst = $conn->prepare($sqlInst);
                if ($stmtInst) {
                    $stmtInst->bind_param("i", $usuario['id']);
                    $stmtInst->execute();
                    $resultInst = $stmtInst->get_result();
                    if ($resultInst->num_rows === 1) {
                        $inst = $resultInst->fetch_assoc();
                        $_SESSION['id_instituicao'] = $inst['id'];
                    } else {
                        // Se não encontrar instituição, seta null ou trate o erro conforme precisar
                        $_SESSION['id_instituicao'] = null;
                    }
                    $stmtInst->close();
                } else {
                    // Erro ao preparar consulta
                    $_SESSION['erro'] = "Erro ao buscar dados da instituição.";
                    header("Location: ../tela_login/index.php");
                    exit();
                }
            }

            // Redireciona conforme o tipo do usuário
            switch ($usuario['tipo_usuario']) {
                case 'aluno':
                    header("Location: ../perfil/aluno.php");
                    break;
                case 'empresa':
                    header("Location: ../perfil/empresa.php");
                    break;
                case 'instituicao':
                    header("Location: ../perfil/instituicao.php");
                    break;
                default:
                    $_SESSION['erro'] = "Tipo de usuário desconhecido.";
                    header("Location: ../tela_login/index.php");
                    break;
            }
            exit();
        } else {
            $_SESSION['erro'] = "Senha incorreta.";
            header("Location: ../tela_login/index.php");
            exit();
        }
    } else {
        $_SESSION['erro'] = "Usuário não encontrado.";
        header("Location: ../tela_login/index.php");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    $_SESSION['erro'] = "Acesso inválido.";
    header("Location: ../tela_login/index.php");
    exit();
}
