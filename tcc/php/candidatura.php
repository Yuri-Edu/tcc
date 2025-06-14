<?php
session_start();
include 'db.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
    Swal.fire({
        icon: 'warning',
        title: 'Atenção!',
        text: 'Você precisa estar logado para se candidatar.',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = 'login.php';
    });
    </script>";
    exit;
}

$aluno_id = $_SESSION['id_usuario']; // ID do aluno vindo da sessão
$vaga_id = isset($_POST['vaga_id']) ? intval($_POST['vaga_id']) : 0;

// Verificar se os dados são válidos
if ($vaga_id > 0 && $aluno_id > 0) {

    // Verificar se já existe uma candidatura
    $sql = "SELECT * FROM candidaturas WHERE aluno_id = ? AND vaga_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $aluno_id, $vaga_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Já existe candidatura
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        Swal.fire({
            icon: 'info',
            title: 'Atenção!',
            text: 'Você já se candidatou para essa vaga.',
            confirmButtonText: 'OK'
        }).then(() => {
            history.back();
        });
        </script>";
        exit;
    } else {
        // Inserir nova candidatura
        $sql = "INSERT INTO candidaturas (aluno_id, vaga_id, data_candidatura, status) VALUES (?, ?, NOW(), 'Pendente')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $aluno_id, $vaga_id);

        if ($stmt->execute()) {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            Swal.fire({
                icon: 'success',
                title: 'Candidatura realizada!',
                text: 'Você se candidatou com sucesso.',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'pagina_vagas.php'; // Redireciona após sucesso
            });
            </script>";
            exit;
        } else {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Ocorreu um erro ao se candidatar.',
                confirmButtonText: 'OK'
            }).then(() => {
                history.back();
            });
            </script>";
            exit;
        }
    }
} else {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Dados inválidos!',
        text: 'Não foi possível processar sua candidatura.',
        confirmButtonText: 'OK'
    }).then(() => {
        history.back();
    });
    </script>";
    exit;
}
?>
