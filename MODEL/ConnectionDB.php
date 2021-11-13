<?php

class ConnectionDB
{
    private static $instance;

    public static function getConnection()
    {

        if (!isset(self::$instance)) {


            $name = 'DBTCC';
            $host = 'localhost';
            $user = 'root';
            $senha = '2318';
            try {

                self::$instance = new PDO("mysql:dbname=" . $name . ";host=" . $host, $user, $senha);
            } catch (Exception $e) {

                echo $e->getMessage();
                echo "deu erro";
            }
        }
        return self::$instance;
    }
}

$conexão  = ConnectionDB::getConnection();

?>