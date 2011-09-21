<?php

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

/*
 * Executa o método do controller passado pela URL.
 * Caso nada seja passado, imprime a página index.
 */
switch ($controller) {
    case 'livro':
        switch ($metodo) {
            case 'novo':
                $livro = new LivrosController();
                $livro->novo();
                break;
            case 'edita':
                $livro = new LivrosController();
                $livro->edita($id);
                break;
            case 'apagar':
                $livro = new LivrosController;
                $livro->apagar($id);
                break;
            default:
                $livro = new LivrosController();
                $livro->index();
                break;
        }
        break;
    case 'usuario':
        switch ($metodo) {
            case 'novo':
                $usuario = new UsuariosController;
                $usuario->novo();
                break;
            case 'edita':
                $usuario = new UsuariosController;
                $usuario->edita($id);
                break;
            case 'apagar':
                $usuario = new UsuariosController;
                $usuario->apagar($id);
                break;
            default:
                $usuario = new UsuariosController;
                $usuario->index();
                break;
        }
        break;
    default:
        echo 'Controller nao encontrado.';
        break;
}