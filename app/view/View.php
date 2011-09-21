<?php

class View {
    /*
     * Views dos livros
     */

    public function formNovoLivro() {
        require_once 'base/header.html';
        require_once 'html/formNovoLivro.html';
        require_once 'base/footer.html';
    }

    public function listaLivro($lista) {
        require_once 'base/header.html';
        require_once 'php/listaLivro.php';
        require_once 'base/footer.html';
    }

    public function editaLivro($lista) {
        require_once 'base/header.html';
        require_once 'php/editaLivro.php';
        require_once 'base/footer.html';
    }

    /*
     * Views dos usuários
     */

    public function formNovoUsuario() {
        require_once 'base/header.html';
        require_once 'html/formNovoUsuario.html';
        require_once 'base/footer.html';
    }

    public function listaUsuario($lista) {
        require_once 'base/header.html';
        require_once 'php/listaUsuario.php';
        require_once 'base/footer.html';
    }

    public function editaUsuario($lista) {
        require_once 'base/header.html';
        require_once 'php/editaUsuario.php';
        require_once 'base/footer.html';
    }

}
