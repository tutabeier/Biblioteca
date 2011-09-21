<?php
while ($livro = mysql_fetch_array($lista)) {
    ?>
    <form action="" method="post">
        <input type="text" name="titulo" value="<?= $livro['titulo'] ?>" />
        <br/>
        <input type="text" name="autor" value="<?= $livro['autor'] ?>" />
        <br/>
        <input type="text" name="ano" value="<?= $livro['ano'] ?>" />
        <br/>
        <input type="text" name="editora" value="<?= $livro['editora'] ?>" />
        <br/>
        <input type="hidden" name="id" value="<?= $livro['idlivros'] ?>" />
        <input type="submit" value="Atualizar"/>
    </form>
    <?php
}
?>