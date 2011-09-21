<?php
while ($usuario = mysql_fetch_array($lista)) {
    ?>
    <form action="" method="post">
        <input type="text" name="nome" value="<?= $usuario['nome'] ?>" />
        <br/>
        <input type="text" name="login" value="<?= $usuario['login'] ?>" />
        <br/>
        <input type="text" name="email" value="<?= $usuario['email'] ?>" />
        <br/>
        <select type="text" name="privilegio">
            <option value="Administrador" <?= ($usuario['privilegio'] == 'Administrador') ? "selected" : ''; ?>>Administrador</option>
            <option value="Normal" <?= ($usuario['privilegio'] == 'Normal') ? "selected" : ''; ?> >Normal</option>
        </select>
        <br/>
        <input type="hidden" name="id" value="<?= $usuario['idusuarios'] ?>" />
        <input type="submit" value="Atualizar"/>
    </form>
    <?php
}
?>