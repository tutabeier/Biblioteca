<?php

require_once 'app/model/LivroModel.php';
require_once 'app/view/View.php';

class LivrosController {

    var $mdl;
    var $vw;

    /*
     * Método construtor
     */

    public function __construct() {
        $this->mdl = new LivroModel;
        $this->vw = new View();
    }

    /*
     * Método index
     * Método que será chamado caso nenhum outro método seja passado como
     * parâmetro no index.
     * Por padrão ele lista os livros do banco de dados.
     */

    public function index() {
        if ($_SESSION['privilegio'] == 'Administrador') {
            $this->vw->adm();
            $lista = $this->mdl->listaLivros();
            $this->vw->listaLivro($lista);
        } else {
            $this->vw->normal();
            $lista = $this->mdl->listaLivros();
            $this->vw->listaLivro($lista);
        }
        $this->vw->footer();
    }

    /*
     * Método novo
     * Método para adicionar um novo livro se o usuario logado for um
     * administrador.
     */

    public function novo() {
        if ($_SESSION['privilegio'] == 'Administrador') {
            if (isset($_POST['titulo']) && isset($_POST['autor'])) {
                $titulo = $_POST['titulo'];
                $autor = $_POST['autor'];
                $ano = $_POST['ano'];
                $editora = $_POST['editora'];

                $this->mdl->setTitulo($titulo);
                $this->mdl->setAutor($autor);
                $this->mdl->setAno($ano);
                $this->mdl->setEditora($editora);

                $this->mdl->salvaLivro();
                // Gambiarra que evita que o usuário possa continuar dando F5 e
                // ir adicionando dados no BD
                header('Location: http://localhost/biblioteca/livro/');
            } else {
                $this->vw->adm();
                $this->vw->formNovoLivro();
            }
        } else {
            $this->vw->normal();
            $lista = $this->mdl->listaLivros();
            $this->vw->listaLivro($lista);
        }
        $this->vw->footer();
    }

    /*
     * Método edita
     * Chama o formulário para edição de um livro se o usuario logado for um
     * administrador.
     */

    public function edita($id) {
        if ($_SESSION['privilegio'] == 'Administrador') {
            if (isset($_POST['titulo']) && isset($_POST['autor'])) {
                $titulo = $_POST['titulo'];
                $autor = $_POST['autor'];
                $ano = $_POST['ano'];
                $editora = $_POST['editora'];
                $id = $_POST['id'];

                $this->mdl->setId($id);
                $this->mdl->setTitulo($titulo);
                $this->mdl->setAutor($autor);
                $this->mdl->setAno($ano);
                $this->mdl->setEditora($editora);
                $this->mdl->updateLivro();
                // Gambiarra que evita que o usuário possa continuar dando F5 e
                // ir adicionando dados no BD
                header('Location: http://localhost/biblioteca/livro/');
            } else {
                if ($id != NULL) {
                    $this->mdl->setId($id);
                    $lista = $this->mdl->buscaLivro();
                    $this->vw->adm();
                    $this->vw->editaLivro($lista);
                    $this->vw->footer();
                } else {
                    $this->index();
                }
            }
        } else {
            $this->vw->normal();
            $lista = $this->mdl->listaLivros();
            $this->vw->listaLivro($lista);
        }
        $this->vw->footer();
    }

    /*
     * Método apagar
     * Deleta livro se o usuario logado for um administrador.
     */

    public function apagar($id) {
        $this->mdl->setId($id);
        $this->mdl->apagaLivro();
        header('Location: http://localhost/biblioteca/livro/');
    }

}