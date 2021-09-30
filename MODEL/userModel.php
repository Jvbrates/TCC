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
}
