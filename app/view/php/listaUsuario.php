<table border="1">
    <tr>
        <th>Nome</th>
        <th>Login</th>
        <th>Privilegio</th>
        <th>Email</th>
        <th colspan="2">Opções</th>
    </tr>
    <?php
    while ($usuario = mysql_fetch_array($lista)) {
        echo '<tr>';
        echo '<td>' . $usuario['nome'] . '</td>';
        echo '<td>' . $usuario['login'] . '</td>';
        echo '<td>' . $usuario['privilegio'] . '</td>';
        echo '<td>' . $usuario['email'] . '</td>';
        echo '<td><a href="http://localhost/biblioteca/usuario/edita/' . $usuario['idusuarios'] . '">Editar</a></td>';
        echo '<td><a href="http://localhost/biblioteca/usuario/apagar/' . $usuario['idusuarios'] . '">Apagar</a></td>';
        echo '</tr>';
    }
    ?>
</table>