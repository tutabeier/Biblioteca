<?php

class UsuarioModel {

    var $id;
    var $nome;
    var $login;
    var $privilegio;
    var $email;
    var $senha;
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

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getPrivilegio() {
        return $this->privilegio;
    }

    public function setPrivilegio($privilegio) {
        $this->privilegio = $privilegio;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    /*
     * Método que salva um livro no Banco de Dados
     */

    public function salvaUsuario() {
        $nome = $this->getNome();
        $login = $this->getLogin();
        $senha = $this->getSenha();
        $privilegio = $this->getPrivilegio();
        $email = $this->getEmail();
        $sql = "INSERT INTO usuarios (nome, login, privilegio, email, senha) VALUES ('$nome', '$login', '$privilegio', '$email', '$senha')";
        $conn = mysql_connect($this->db['host'], $this->db['adm'], $this->db['senha']) or die(mysql_error());
        mysql_select_db($this->db['banco']);
        $status = mysql_query($sql, $conn);
        return $status;
    }

    /*
     * Método que lista os livros do Banco de Dados
     */

    public function listaUsuarios() {
        $sql = "SELECT * FROM usuarios";
        $conn = mysql_connect($this->db['host'], $this->db['adm'], $this->db['senha']) or die(mysql_error());
        mysql_select_db($this->db['banco']);
        $status = mysql_query($sql, $conn);
        return $status;
    }

    /*
     * Método que busca os dados de UM livro
     */

    public function buscaUsuario() {
        $id = $this->getId();
        $sql = "SELECT * FROM usuarios WHERE idusuarios=$id";
        $conn = mysql_connect($this->db['host'], $this->db['adm'], $this->db['senha']) or die(mysql_error());
        mysql_select_db($this->db['banco']);
        $status = mysql_query($sql, $conn);
        return $status;
    }

    public function updateUsuario() {
        $id = $this->getId();
        $nome = $this->getNome();
        $login = $this->getLogin();
        $privilegio = $this->getPrivilegio();
        $email = $this->getEmail();
        $sql = "UPDATE  usuarios SET  nome = '$nome', login='$login', privilegio = '$privilegio', email='$email' WHERE  idusuarios =$id";
        $conn = mysql_connect($this->db['host'], $this->db['adm'], $this->db['senha']) or die(mysql_error());
        mysql_select_db($this->db['banco']);
        $status = mysql_query($sql, $conn);
        return $status;
    }

    public function apagaUsuario() {
        $id = $this->getId();
        $sql = "DELETE FROM usuarios WHERE idusuarios=$id";
        $conn = mysql_connect($this->db['host'], $this->db['adm'], $this->db['senha']) or die(mysql_error());
        mysql_select_db($this->db['banco']);
        $status = mysql_query($sql, $conn);
        return $status;
    }

}