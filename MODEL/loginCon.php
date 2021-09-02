<?php
//Este arquivo de conexão será responsável pelas autenticações 
//logins e cadastros assim como redirecionamentos


class  loginCon
{

    private $con;
    public function __construct()
    {
        $this->con = ConnectionDB::getConnection();
    }

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

    public function getAllData(array $parametros) // retorna dados do usuario
    {
        $read = $this->con->prepare("SELECT * FROM USUARIO WHERE nomeUsuario LIKE :nomeUsuario AND senha LIKE :senha ");

        $read->bindparam(':nomeUsuario', $parametros['user']);
        $read->bindparam(':senha', $parametros['password']);
        $read->execute();
        $retorno = array();

        if ($read->rowCount() == 0) {
            return false;
        } else {
            $dados = array();

            $dados = $read->fetch(PDO::FETCH_ASSOC);
            echo ($dados['tipo']);
            return $dados;
        }
    }
}
