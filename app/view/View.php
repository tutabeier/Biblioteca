<?php

//session_start("privilegio");

class View {
    /*
     * Headers
     */
    
    public function adm() {
        require_once 'base/header_adm.html';
    }
    
    public function normal() {
        require_once 'base/header_normal.html';
    }
    
    public function footer() {
        require_once 'base/footer.html';
    }
        
    /*
     * Views dos livros
     */

    public function formNovoLivro() {
        require_once 'html/formNovoLivro.html';
    }

    public function listaLivro($lista) {
        require_once 'php/listaLivro.php';
    }

    public function editaLivro($lista) {
        require_once 'php/editaLivro.php';
    }

    /*
     * Views dos usuários
     */

    public function formNovoUsuario() {
        require_once 'html/formNovoUsuario.html';
        require_once 'base/footer.html';
    }

    public function listaUsuario($lista) {
        require_once 'php/listaUsuario.php';
    }

    public function editaUsuario($id, $nome, $login, $privilegio, $email) {
        require_once 'php/editaUsuario.php';
    }

    public function formLogin() {
        require_once 'html/formLogin.html';
    }

    public function test($lista) {
        while ($usuario = mysql_fetch_array($lista)) {
            echo $usuario['privilegio'];
        }
    }
    
    public function home() {
        
    }
    
    public function erro() {
        echo 'erro!';
    }

}
