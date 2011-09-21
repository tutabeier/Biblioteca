<table border="1">
    <tr>
        <th>Titulo</th>
        <th>Autor</th>
        <th>Ano</th>
        <th>Editora</th>
        <th colspan="2">Opções</th>
    </tr>
    <?php
    while ($livro = mysql_fetch_array($lista)) {
        echo '<tr>';
        echo '<td>' . $livro['titulo'] . '</td>';
        echo '<td>' . $livro['autor'] . '</td>';
        echo '<td>' . $livro['ano'] . '</td>';
        echo '<td>' . $livro['editora'] . '</td>';
        echo '<td><a href="http://localhost/biblioteca/livro/edita/' . $livro['idlivros'] . '">Editar</a></td>';
        echo '<td><a href="http://localhost/biblioteca/livro/apagar/' . $livro['idlivros'] . '">Apagar</a></td>';
        echo '</tr>';
    }
    ?>
</table>