<?php
//Este arquivo de conexão será responsável pelas autenticações 
class  loginCon
{
    
    private $con;

    //Ao criar o objeto será feira conexxão com banco de dados ==/ /==
    public function __construct()
    {

        $this->con = ConnectionDB::getConnection();
    }


    //Retorna True para login e senha corretos e false para o resto
    public function setLogin(array $parametros) //verifica se login senha esta correto
    {
        $read = $this->con->prepare("SELECT idUsuario FROM USUARIO WHERE nomeUsuario LIKE :nomeUsuario AND senha LIKE :senha ");

        $read->bindparam(':nomeUsuario', $parametros['user']);
        $read->bindparam(':senha', $parametros['password']);
        $read->execute();

        if ($read->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }


    //Possui os mesmo parametros e processos que loginCon->setLogin, 
    //mas retorna um array com os dados do usuario
    public function getAllData(array $parametros) // retorna dados do usuario
    {
        $read = $this->con->prepare("SELECT * FROM USUARIO WHERE nomeUsuario LIKE :nomeUsuario AND senha LIKE :senha ");

        $read->bindparam(':nomeUsuario', $parametros['user']);
        $read->bindparam(':senha', $parametros['password']);
        $read->execute();

        if ($read->rowCount() == 0) {
            return false;
        } else {
            $dados = array();

            $dados = $read->fetch(PDO::FETCH_ASSOC);
            return $dados;
        }
    }
    //Verifica a disponibilidade do nome no banco de dados
    public function verNome(string $nome)
    {

        $read = $this->con->prepare("SELECT idUsuario FROM USUARIO WHERE nomeUsuario LIKE :nomeUsuario");
        $read->bindparam(':nomeUsuario', $nome);
        $read->execute();
        if ($read->rowCount() == 0) {
            return true;
        } else {
            return false;
        }
    }

    //Verifica a disponibilidade do email no banco de dados
    
    public function verEmail(string $email)
    {

        $read = $this->con->prepare("SELECT idUsuario FROM USUARIO WHERE emailUsuario LIKE :email");
        $read->bindparam(':email', $email);
        $read->execute();
        if ($read->rowCount() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function setCadastro(array $parametros)
    {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        $read = $this->con->prepare("INSERT INTO USUARIO (nome, nomeUsuario, senha, emailUsuario, tipo) VALUES ( :nome, :username, :senha, :email, 0)");
        $read->bindparam(':nome', $_POST['nome']);
        $read->bindparam(':username', $_POST['user']);
        $read->bindparam(':email', $_POST['email']);
        $read->bindparam(':senha', $_POST['password']);
        try {
            $read->execute();
            return true;
        } catch (Exception $e) {
            echo $e->getCode();
        }
    }
}
