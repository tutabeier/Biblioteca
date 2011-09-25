<?php

class LivroModel {

    var $id;
    var $titulo;
    var $autor;
    var $ano;
    var $editora;
    var $db = array('host' => 'localhost',
        'adm' => 'root',
        'senha' => '',
        'banco' => 'biblioteca'
    );

    public function __construct() {
        
    }

    /*
     * GETTERS E SETTERS
     */

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function getAno() {
        return $this->ano;
    }

    public function setAno($ano) {
        $this->ano = $ano;
    }

    public function getEditora() {
        return $this->editora;
    }

    public function setEditora($editora) {
        $this->editora = $editora;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    /*
     * Método que salva um livro no Banco de Dados
     */

    public function salvaLivro() {
        $titulo = $this->getTitulo();
        $autor = $this->getAutor();
        $ano = $this->getAno();
        $editora = $this->getEditora();

        $sql = "INSERT INTO livros (titulo, autor, ano, editora) VALUES ('$titulo', '$autor', $ano, '$editora')";
        $conn = mysql_connect($this->db['host'], $this->db['adm'], $this->db['senha']) or die(mysql_error());
        mysql_select_db($this->db['banco']);
        $status = mysql_query($sql, $conn);
        return $status;
    }

    /*
     * Método que lista os livros do Banco de Dados
     */

    public function listaLivros() {
        $sql = "SELECT * FROM livros";
        $conn = mysql_connect($this->db['host'], $this->db['adm'], $this->db['senha']) or die(mysql_error());
        mysql_select_db($this->db['banco']);
        $status = mysql_query($sql, $conn);
        return $status;
    }

    /*
     * Método que busca os dados de UM livro
     */

    public function buscaLivro() {
        $id = $this->getId();
        $sql = "SELECT * FROM livros WHERE idlivros=$id";
        $conn = mysql_connect($this->db['host'], $this->db['adm'], $this->db['senha']) or die(mysql_error());
        mysql_select_db($this->db['banco']);
        $status = mysql_query($sql, $conn);
        return $status;
    }

    public function updateLivro() {
        $id = $this->getId();
        $titulo = $this->getTitulo();
        $autor = $this->getAutor();
        $ano = $this->getAno();
        $editora = $this->getEditora();

        $sql = "UPDATE  livros SET  titulo = '$titulo', autor = '$autor', ano='$ano', editora='$editora' WHERE  idlivros =$id";
        $conn = mysql_connect($this->db['host'], $this->db['adm'], $this->db['senha']) or die(mysql_error());
        mysql_select_db($this->db['banco']);
        $status = mysql_query($sql, $conn);
        return $status;
    }

    public function apagaLivro() {
        $id = $this->getId();
        $sql = "DELETE FROM livros WHERE idlivros=$id";
        $conn = mysql_connect($this->db['host'], $this->db['adm'], $this->db['senha']) or die(mysql_error());
        mysql_select_db($this->db['banco']);
        $status = mysql_query($sql, $conn);
        return $status;
    }

}