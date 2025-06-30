<?php
require_once 'db.php';

$sql = "SELECT id, titulo, descricao, caminho_arquivo, data_envio FROM relatorios ORDER BY data_envio DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($relatorio = $result->fetch_assoc()) {
        $id = $relatorio['id'];
        $titulo = htmlspecialchars($relatorio['titulo']);
        $descricao = htmlspecialchars($relatorio['descricao']);
        $caminho = htmlspecialchars(str_replace('../', '', $relatorio['caminho_arquivo'])); // remove "../" se necessário
        $data = htmlspecialchars($relatorio['data_envio']);

        echo "
        <tr>
            <td>$titulo</td>
            <td>$descricao</td>
            <td>$data</td>
            <td>
                <a href='$caminho' target='_blank' class='btn btn-outline-light btn-sm me-1'>Visualizar</a>
                <a href='$caminho' download class='btn btn-outline-success btn-sm me-1'>Gerar PDF</a>
                <form action='php/excluir_relatorio.php' method='POST' style='display:inline;' onsubmit=\"return confirm('Tem certeza que deseja excluir este relatório?');\">
                    <input type='hidden' name='id' value='$id'>
                    <input type='hidden' name='arquivo' value='$caminho'>
                    <button type='submit' class='btn btn-outline-danger btn-sm'>Excluir</button>
                </form>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='4'>Nenhum relatório enviado ainda.</td></tr>";
}
?>
