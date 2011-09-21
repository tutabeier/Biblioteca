<?php

require_once 'app/model/UsuarioModel.php';
require_once 'app/view/View.php';

class UsuariosController {

    var $mdl;
    var $vw;

    /*
     * Método construtor
     */

    public function __construct() {
        $this->mdl = new UsuarioModel;
        $this->vw = new View();
    }

    /*
     * Método index
     * Método que será chamado caso nenhum outro método seja passado como
     * parâmetro no index.
     * Por padrão ele lista os livros do banco de dados.
     */

    public function index() {
        $lista = $this->mdl->listaUsuarios();
        $this->vw->listaUsuario($lista);
    }

    /*
     * Método novo
     * Método para adicionar um novo livro se o usuario logado for um
     * administrador.
     */

    public function novo() {
        if (isset($_POST['nome']) && isset($_POST['login']) &&
                isset($_POST['senha']) && isset($_POST['privilegio']) && isset($_POST['email'])) {
            $nome = $_POST['nome'];
            $privilegio = $_POST['privilegio'];
            $email = $_POST['email'];
            $login = $_POST['login'];
            $senha = $_POST['senha'];

            $this->mdl->setNome($nome);
            $this->mdl->setPrivilegio($privilegio);
            $this->mdl->setLogin($login);
            $this->mdl->setSenha($senha);
            $this->mdl->setEmail($email);
            $this->mdl->salvaUsuario();
            // Gambiarra que evita que o usuário possa continuar dando F5 e
            // ir adicionando dados no BD
            header('Location: http://localhost/biblioteca/usuario/');
        } else {
            $this->vw->formNovoUsuario();
        }
    }

    /*
     * Método edita
     * Chama o formulário para edição de um livro se o usuario logado for um
     * administrador.
     */

    public function edita($id) {
        if (isset($_POST['nome']) && isset($_POST['login'])
                && isset($_POST['privilegio']) && isset($_POST['email'])) {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $privilegio = $_POST['privilegio'];
            $email = $_POST['email'];
            $login = $_POST['login'];

            $this->mdl->setId($id);
            $this->mdl->setNome($nome);
            $this->mdl->setPrivilegio($privilegio);
            $this->mdl->setLogin($login);
            $this->mdl->setEmail($email);
            $this->mdl->updateUsuario();
            // Gambiarra que evita que o usuário possa continuar dando F5 e
            // ir adicionando dados no BD
            header('Location: http://localhost/biblioteca/usuario/');
        } else {
            if ($id != NULL) {
                $this->mdl->setId($id);
                $lista = $this->mdl->buscaUsuario();
                $this->vw->editaUsuario($lista);
            } else {
                $this->index();
            }
        }
    }

    /*
     * Método apagar
     * Deleta livro se o usuario logado for um administrador.
     */

    public function apagar($id) {
        $this->mdl->setId($id);
        $this->mdl->apagaUsuario();
        header('Location: http://localhost/biblioteca/usuario/');
    }

}
