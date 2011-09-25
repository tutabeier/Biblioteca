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
     * Método login
     * Responsável por efetuar o login do usuário, setar sessions ou mostrar
     * as mensagens de erro.
     */

    public function login() {
        // Se POST['login'] ou POST['senha'] não estiverem setados ou em branco
        // retorna à tela de login
        if (!isset($_POST['login']) || !isset($_POST['senha'])
                || $_POST['login'] == NULL || $_POST['login'] == NULL) {
            $this->vw->formLogin();
        } else {
            // Se vier algo por post, verifica se o usuário e senha existem
            // no banco de dados. Se existirem, seta a session e redireciona.
            $login = $_POST['login'];
            $senha = $_POST['senha'];

            $this->mdl->setLogin($login);
            $this->mdl->setSenha($senha);
            $usuario = $this->mdl->logaUsuario();

            switch ($usuario['privilegio']) {
                case 'Administrador':
                    $_SESSION['privilegio'] = 'Administrador';
                    header('Location: http://localhost/biblioteca/livro/');
                    break;
                case 'Normal':
                    $_SESSION['privilegio'] = 'Normal';
                    header('Location: http://localhost/biblioteca/livro/');
                    break;
                default:
                    echo 'Nao foi possível logar. Verifique seu login e senha e tente novamente.';
                    break;
            }
        }
    }

    /*
     * Método index
     * Método que será chamado caso nenhum outro método seja passado como
     * parâmetro no index.
     * Por padrão ele lista os usuarios do banco de dados. (trabalhando nisso)
     */

    public function index() {
        $this->vw->adm();
        $lista = $this->mdl->listaUsuarios();
        $this->vw->listaUsuario($lista);
        $this->vw->footer();
    }

    /*
     * Método lista.
     * Lista os usuarios.
     * Método disponível apenas para adm.
     */

    public function listar() {
        $this->vw->adm();
        $lista = $this->mdl->listaUsuarios();
        $this->vw->listaUsuario($lista);
    }

    /*
     * Método novo
     * Método para adicionar um novo usuario ao bd.
     * Método disponível apenas para adm.
     */

    public function novo() {
        // Verifica o privilegio do usuário.
        if ($_SESSION['privilegio'] == 'Administrador') {
            // Se o post existir, procede com a inclusão.
            if (isset($_POST['nome']) && isset($_POST['login']) &&
                    isset($_POST['senha']) && isset($_POST['privilegio']) && isset($_POST['email'])) {
                // Seta nome, privilegio, login, senha e email e salva no bd.
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
                header('Location: http://localhost/biblioteca/usuario/');
            } else {
                // Se o post não existir, renderiza o form de inclusão.
                $this->vw->adm();
                $this->vw->formNovoUsuario();
                $this->vw->footer();
            }
        } else {
            // Caso o usuário não seja adm, mostra mensagem de erro.
            $this->vw->erro();
        }
        $this->vw->footer();
    }

    /*
     * Método edita
     * Chama o formulário para edição de um livro se o usuario logado for um
     * administrador.
     */

    public function edita($id) {
        // Verifica se o usuário é adm.
        if ($_SESSION['privilegio'] == 'Administrador') {
            // Se o post existir, procede com a inclusão.
            if (isset($_POST['nome']) && isset($_POST['login'])
                    && isset($_POST['privilegio']) && isset($_POST['email'])) {
                // Seta id, nome, privilegio, email e login e procede com o update
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
                header('Location: http://localhost/biblioteca/usuario/');
            } else {
                // Se o post não existir, mas existir um id sendo passado,
                // puxa os dados do BD e renderiza o form de update.
                if ($id != NULL) {
                    $this->mdl->setId($id);
                    $usuario = $this->mdl->buscaUsuario();
                    $this->vw->adm();
                    $this->vw->editaUsuario($usuario['idusuarios'], $usuario['nome'], $usuario['login'], $usuario['privilegio'], $usuario['email']);
                    $this->vw->footer();
                } else {
                    // Caso contrário apenas chama o index.
                    $this->vw->adm();
                    $this->index();
                    $this->vw->footer();
                }
            }
        } else {
            // Se o usuário não for adm, dá mensagem de erro.
            $this->vw->erro();
        }
        $this->vw->footer();
    }

    /*
     * Método apagar
     * Deleta livro se o usuario logado for um administrador.
     */

    public function apagar($id) {
        // Seta id e apaga usuário
        $this->mdl->setId($id);
        $this->mdl->apagaUsuario();
        header('Location: http://localhost/biblioteca/usuario/');
    }

    public function logoff() {
        // Faz o logoff
        unset($_SESSION['privilegio']);
        session_destroy();
        header('Location: http://localhost/biblioteca');
    }

}