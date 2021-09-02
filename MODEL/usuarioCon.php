<?php 


class  usuarioCon
{

    private $con;
    public function __construct()
    {
        $this->con = ConnectionDB::getConnection();
    }

    public function cadastrar($post){ 
        extract($post);
        
        $cmd = $this->con->prepare("INSERT INTO USUARIO (idUsuario, nome, nomeUsuario, senha, emailUsuario, tipo) VALUES (NULL, :nome, :username, :senha, :email, 0);");
        $cmd->bindparam(":nome", $nome);
        $cmd->bindparam(":username", $username);
        $cmd->bindparam(":senha", $senha);
        $cmd->bindparam(":email", $email);
        try      {
        $cmd->execute();
        } catch(Exception $e) {
            if ($cmd->errorCode() == 23000){
            echo "Nome de usuário e email não podem ser cadastrados 2 vezes";
            }
        }
        
    }

    //public function login(){}
    //public function atualizarDados(){}
    //public function obterDados(){}

}