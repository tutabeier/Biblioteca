<?php

class UsuarioModel {

    var $id;
    var $nome;
    var $login;
    var $privilegio;
    var $email;
    var $senha;
    //Definições do banco de dados
    var $dns = 'mysql:host=localhost;port=3306;dbname=biblioteca';
    var $usuario = 'root';
    var $senha_db = '';

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
        // Recebe os dados.
        $nome = $this->getNome();
        $login = $this->getLogin();
        $senha = $this->getSenha();
        $privilegio = $this->getPrivilegio();
        $email = $this->getEmail();

        // Conecta ao bd usando PDO.
        $conexao = new PDO($this->dns, $this->usuario, $this->senha_db);

        // Prepara o insert
        $salva = $conexao->prepare('INSERT INTO usuarios (nome, login, privilegio, email, senha) 
            VALUES (:nome, :login, :privilegio, :email, :senha)');

        // Binda os parâmetros
        $salva->bindParam(':nome', $nome, PDO::PARAM_STR, 50);
        $salva->bindParam(':login', $login, PDO::PARAM_STR, 50);
        $salva->bindParam(':privilegio', $privilegio, PDO::PARAM_STR, 50);
        $salva->bindParam(':email', $email, PDO::PARAM_STR, 50);
        $salva->bindParam(':senha', $senha, PDO::PARAM_STR, 50);

        // Executa o comando
        $status = $salva->execute();


        return $status;
    }

    /*
     * Método que lista os livros do Banco de Dados
     */

    public function listaUsuarios() {
        // Conecta ao bd usando PDO.
        $conexao = new PDO($this->dns, $this->usuario, $this->senha_db);

        // Executa o select
        $status = $conexao->query('SELECT * FROM usuarios');

        return $status;
    }

    /*
     * Método que busca os dados de UM livro
     */

    public function buscaUsuario() {
        // Recebe os dados.
        $id = $this->getId();

        // Conecta ao bd usando PDO.
        $conexao = new PDO($this->dns, $this->usuario, $this->senha_db);

        // Prepara o select
        $busca = $conexao->prepare('SELECT * FROM usuarios WHERE idusuarios= :id');

        // Binda os parâmetros
        $busca->bindParam(':id', $id, PDO::PARAM_INT, 100);

        // Executa o comando
        $busca->execute();
        
        $linha = $busca->fetch(PDO::FETCH_ASSOC);

        return $linha;
    }

    /*
     * Método que faz o update dos usuários
     */
    public function updateUsuario() {
        // Recebe os dados.
        $id = $this->getId();
        $nome = $this->getNome();
        $login = $this->getLogin();
        $privilegio = $this->getPrivilegio();
        $email = $this->getEmail();

        // Conecta ao bd usando PDO.
        $conexao = new PDO($this->dns, $this->usuario, $this->senha_db);

        // Prepara o update
        $update = $conexao->prepare('UPDATE  usuarios SET  nome = :nome, 
            login = :login, privilegio = :privilegio, email = :email WHERE  idusuarios = :id');

        // Binda os parâmetros
        $update->bindParam(':id', $id, PDO::PARAM_INT);
        $update->bindParam(':nome', $nome, PDO::PARAM_STR, 50);
        $update->bindParam(':login', $login, PDO::PARAM_STR, 20);
        $update->bindParam(':privilegio', $privilegio, PDO::PARAM_STR, 50);
        $update->bindParam(':email', $email, PDO::PARAM_STR, 50);

        // Executa o comando
        $status = $update->execute();
        return $status;
    }

    /*
     * Método que apaga os usuários
     */
    public function apagaUsuario() {
        // Recebe os dados.
        $id = $this->getId();

        // Conecta ao bd usando PDO.
        $conexao = new PDO($this->dns, $this->usuario, $this->senha_db);

        // Prepara o delete
        $apaga = $conexao->prepare('DELETE FROM usuarios WHERE idusuarios = :id');

        // Binda os parâmetros
        $apaga->bindParam(':id', $id, PDO::PARAM_INT, 100);

        // Executa o comando
        $status = $apaga->execute();

        return $status;
    }

    /*
     * Método que retorna o privilegio de um usuário
     */
    public function logaUsuario() {
        // Recebe os dados.
        $login = $this->getLogin();
        $senha = $this->getSenha();

        // Conecta ao bd usando PDO.
        $conexao = new PDO($this->dns, $this->usuario, $this->senha_db);

        // Prepara o select
        $loga = $conexao->prepare('SELECT privilegio FROM usuarios WHERE login = :login AND senha = :senha');

        // Binda os parâmetros
        $loga->bindParam(':login', $login, PDO::PARAM_STR, 50);
        $loga->bindParam(':senha', $senha, PDO::PARAM_STR, 50);

        // Executa o comando
        $loga->execute();

        $linha = $loga->fetch(PDO::FETCH_ASSOC);

        return $linha;
    }

}