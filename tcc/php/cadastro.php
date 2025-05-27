<?php
include_once("db.php");

// Função para criptografar senha
function criptografar($senha) {
    return password_hash($senha, PASSWORD_DEFAULT);
}

// Verificar qual formulário foi enviado
if (isset($_POST['nome-estudante'])) {
    // 🧑‍🎓 Cadastro de Estudante
    $nome = $_POST['nome-estudante'];
    $data_nascimento = $_POST['data_nascimento'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = criptografar($_POST['senha-estudante']);

    // Inserir na tabela usuários
    $sql = "INSERT INTO usuarios (nome, email, senha, tipo_usuario) 
            VALUES ('$nome', '$email', '$senha', 'aluno')";
    if (mysqli_query($conn, $sql)) {
        $id_usuario = mysqli_insert_id($conn);
        // Inserir dados específicos do estudante
        $sql_estudante = "INSERT INTO alunos (id_usuario, data_nascimento, cpf, telefone)
                           VALUES ('$id_usuario', '$data_nascimento', '$cpf', '$telefone')";
        if (mysqli_query($conn, $sql_estudante)) {
            echo "Aluno cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar aluno: " . mysqli_error($conexao);
        }
    } else {
        echo "Erro no cadastro de usuário: " . mysqli_error($conn);
    }

} elseif (isset($_POST['nome-empresa'])) {
    // 🏢 Cadastro de Empresa
    $nome = $_POST['nome-empresa'];
    $cnpj = $_POST['cnpj-empresa'];
    $email = $_POST['email-empresa'];
    $telefone = $_POST['telefone-empresa'];
    $endereco = $_POST['endereco-empresa'];
    $responsavel = $_POST['responsavel'];
    $senha = criptografar($_POST['senha-empresa']);

    $sql = "INSERT INTO usuarios (nome, email, senha, tipo_usuario) 
            VALUES ('$nome', '$email', '$senha', 'empresa')";
    if (mysqli_query($conn, $sql)) {
        $id_usuario = mysqli_insert_id($conn);
        $sql_empresa = "INSERT INTO empresas (id_usuario, cnpj, telefone, endereco, responsavel)
                         VALUES ('$id_usuario', '$cnpj', '$telefone', '$endereco', '$responsavel')";
        if (mysqli_query($conexao, $sql_empresa)) {
            echo "Empresa cadastrada com sucesso!";
        } else {
            echo "Erro ao cadastrar empresa: " . mysqli_error($conn);
        }
    } else {
        echo "Erro no cadastro de usuário: " . mysqli_error($conn);
    }

} elseif (isset($_POST['nome-instituicao'])) {
    // 🏫 Cadastro de Instituição
    $nome = $_POST['nome-instituicao'];
    $cnpj = $_POST['cnpj-admin'];
    $cursos = $_POST['cursos-admin'];
    $telefone = $_POST['telefone-admin'];
    $endereco = $_POST['endereco-admin'];
    $usuario_login = $_POST['usuario-admin'];
    $senha = criptografar($_POST['senha-admin']);

    $sql = "INSERT INTO usuarios (nome, email, senha, tipo_usuario) 
            VALUES ('$nome', '$usuario_login', '$senha', 'instituicao')";
    if (mysqli_query($conn, $sql)) {
        $id_usuario = mysqli_insert_id($conn);
        $sql_instituicao = "INSERT INTO instituicoes (id_usuario, cnpj, cursos, telefone, endereco)
                             VALUES ('$id_usuario', '$cnpj', '$cursos', '$telefone', '$endereco')";
        if (mysqli_query($conexao, $sql_instituicao)) {
            echo "Instituição cadastrada com sucesso!";
        } else {
            echo "Erro ao cadastrar instituição: " . mysqli_error($conn);
        }
    } else {
        echo "Erro no cadastro de usuário: " . mysqli_error($conn);
    }

} else {
    echo "Nenhum formulário recebido!";
}

// Fechar conexão
mysqli_close($conn);
?>
