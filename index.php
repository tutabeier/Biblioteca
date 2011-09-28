<?php

session_start('privilegio');
/*
 * Chama os controllers.
 */
require_once 'app/controller/LivrosController.php';
require_once 'app/controller/UsuariosController.php';

/*
 * Verifica se o Get foi definido pela URL
 */
if (isset($_GET['controller']) && $_GET['controller'] != NULL) {
    $controller = $_GET['controller'];
} else {
    $controller = '';
}

if (isset($_GET['metodo']) && $_GET['metodo'] != NULL) {
    $metodo = $_GET['metodo'];
} else {
    $metodo = '';
}

if (isset($_GET['id']) && $_GET['id'] != NULL) {
    $id = $_GET['id'];
}

if (isset($_SESSION['privilegio'])) {
    $privilegio = $_SESSION['privilegio'];
} else {
    $privilegio = '';
}

/*
 * Executa o método do controller passado pela URL.
 * Caso nada seja passado, imprime a página index.
 */
if ($privilegio == 'Administrador') {
    switch ($controller) {
        case 'livro':
            $livro = new LivrosController();
            switch ($metodo) {
                case 'novo':
                    $livro->novo();
                    break;
                case 'edita':
                    $livro->edita($id);
                    break;
                case 'apagar':
                    $livro->apagar($id);
                    break;
                default:
                    $livro->index();
                    break;
            }
            break;
        case 'usuario':
            $usuario = new UsuariosController;
            switch ($metodo) {
                case 'novo':
                    $usuario->novo();
                    break;
                case 'edita':
                    $usuario->edita($id);
                    break;
                case 'apagar':
                    $usuario->apagar($id);
                    break;
                case 'logoff':
                    $usuario->logoff();
                    break;
                default:
                    $usuario->index();
                    break;
            }
            break;
        default:
            $usuario = new UsuariosController;
            $usuario->index();
            break;
    }
}

if ($privilegio == 'Normal') {
    switch ($controller) {
        case 'livro':
        default:
            $livro = new LivrosController();
            $livro->index();
            break;
        case 'usuario':
            $usuario = new UsuariosController;
            $usuario->logoff();
            break;
    }
}

if ($privilegio == '') {
    $usuario = new UsuariosController;
    $usuario->login();
}
