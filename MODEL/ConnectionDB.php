<?php

Class ConnectionDB
{
    private static $instance; 

    public static function getConnection() {
        
        if(!isset(self::$instance))
        {

            
            $name = 'DBTCC'; 
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

$conexão  = ConnectionDB::getConnection();



?>