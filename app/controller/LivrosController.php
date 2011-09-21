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
        $lista = $this->mdl->listaLivros();
        $this->vw->listaLivro($lista);
    }

    /*
     * Método novo
     * Método para adicionar um novo livro se o usuario logado for um
     * administrador.
     */

    public function novo() {
        if (isset($_POST['titulo']) && isset($_POST['autor'])) {
            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'];

            $this->mdl->setTitulo($titulo);
            $this->mdl->setAutor($autor);
            $this->mdl->salvaLivro();
            // Gambiarra que evita que o usuário possa continuar dando F5 e
            // ir adicionando dados no BD
            header('Location: http://localhost/biblioteca/livro/');
        } else {
            $this->vw->formNovoLivro();
        }
    }

    /*
     * Método edita
     * Chama o formulário para edição de um livro se o usuario logado for um
     * administrador.
     */

    public function edita($id) {
        if (isset($_POST['titulo']) && isset($_POST['autor'])) {
            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'];
            $id = $_POST['id'];
            $this->mdl->setId($id);
            $this->mdl->setTitulo($titulo);
            $this->mdl->setAutor($autor);
            $this->mdl->updateLivro();
            // Gambiarra que evita que o usuário possa continuar dando F5 e
            // ir adicionando dados no BD
            header('Location: http://localhost/biblioteca/livro/');
        } else {
            if ($id != NULL) {
                $this->mdl->setId($id);
                $lista = $this->mdl->buscaLivro();
                $this->vw->editaLivro($lista);
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
        $this->mdl->apagaLivro();
        header('Location: http://localhost/biblioteca/livro/');
    }

}
