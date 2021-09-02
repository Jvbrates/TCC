<?php 


class  testeconexao
{

    private $con;

    public function __construct()
    {
        $this->con = ConnectionDB::getConnection();
    }

    public function listatab(){


        $ddos = array();
        $cmd = $this->con->query("SHOW TABLES;");
        $ddos = $cmd->fetchAll(PDO::FETCH_ASSOC);
        print_r( $ddos[0]);
        return $ddos;
    }
}