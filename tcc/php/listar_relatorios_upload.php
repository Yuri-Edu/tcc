<?php
require_once 'db.php';

$sql = "SELECT id, nome, categoria, caminho_arquivo FROM relatorios ORDER BY data_upload DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($relatorio = $result->fetch_assoc()) {
        $id = $relatorio['id'];
        $nome = htmlspecialchars($relatorio['nome']);
        $categoria = htmlspecialchars($relatorio['descricao']);
        $caminho = htmlspecialchars($relatorio['caminho_arquivo']);

        echo "
        <tr>
            <td>$nome</td>
            <td>$categoria</td>
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
    echo "<tr><td colspan='3'>Nenhum relatório enviado via upload ainda.</td></tr>";
}
?>
