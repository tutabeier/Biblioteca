    <form action="" method="post">
        <input type="text" name="nome" value="<?= $nome ?>" />
        <br/>
        <input type="text" name="login" value="<?= $login ?>" />
        <br/>
        <input type="text" name="email" value="<?= $email ?>" />
        <br/>
        <select type="text" name="privilegio">
            <option value="Administrador" <?= ($privilegio == 'Administrador') ? "selected" : ''; ?>>Administrador</option>
            <option value="Normal" <?= ($privilegio == 'Normal') ? "selected" : ''; ?> >Normal</option>
        </select>
        <br/>
        <input type="hidden" name="id" value="<?= $id ?>" />
        <input type="submit" value="Atualizar"/>
    </form>