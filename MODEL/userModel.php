<?php
class userModel
{
    private $con;

    //Ao criar o objeto será feira conexxão com banco de dados ==/ /==
    public function __construct()
    {
        $this->con = ConnectionDB::getConnection();
    }

    public function getAll()
    {
        $read = $this->con->prepare("SELECT USUARIO.nome, USUARIO.nomeUsuario, USUARIO.emailUsuario, USUARIO.tipo FROM `USUARIO` WHERE USUARIO.tipo != 2; ");
        $read->execute();

        $dados = array();
        $dados = $read->fetchAll(PDO::FETCH_ASSOC);

        return $dados;
    }

    public function getFull($id)
    {

        $read = $this->con->prepare("SELECT *  FROM INSTITUICAO WHERE idInstituicao LIKE :id ");
        $read->bindParam(':id', $id[0]);
        $read->execute();

        $dados = array();
        $dados = $read->fetchAll(PDO::FETCH_ASSOC);
        //        $dados = json_encode($read->fethAll(PDO::FETCH_ASSOC));
        return $dados;
    }

    public function dell($id) //Deleta Usuário
    {
        $read = $this->con->prepare("DELETE FROM USUARIO  WHERE nome = :id");
        $read->bindParam(":id", $id);
        $read->execute();
    }

    public function setModerador(array $parametros, $senha)
    {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        $read = $this->con->prepare("INSERT INTO USUARIO (nome, nomeUsuario, senha, emailUsuario, tipo) VALUES ( :nome, :username, :senha, :email, 1)");
        $read->bindparam(':nome', $_POST['nome']);
        $read->bindparam(':username', $_POST['user']);
        $read->bindparam(':email', $_POST['email']);
        $read->bindparam(':senha', $senha);
        try {
            $read->execute();
            return true;
        } catch (Exception $e) {
            echo $e->getCode();
        }
    }
}
