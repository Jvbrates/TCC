<?php

Class ConnectionDB
{
    private static $instance; 

    private function __constructor(){}

    public static function getConnection() {
        if(!isset(self::$instance))
        {

            
            $name = 'DBTCC'; //<----- Nome do Banco de Dados
            $host = 'localhost';
            $user = 'root';
            $senha = '2318';
            try {
                self::$instance = new PDO("mysql:dbname=".$name.";host=".$host, $user, $senha);
            } catch (Exception $e) {
                echo '<script>alert("erro: '.$e.'")</script>';
                echo "deu erro";
            }    
        }
        return self::$instance;
    }
}

?>