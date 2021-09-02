<?php

use function PHPSTORM_META\type;

class loginController extends controller{
    public function __construct(){
        if (!isset($_SESSION)) {  /*session_start()*/;}
    }
    public function login(){
       
        include "../VIEW/".__FUNCTION__.".php";
    }

    public function logoff(){
        if(isset($_SESSION['user']) && isset($_SESSION['password'])) 
        {
            if(parent::verifica($_SESSION['user'],$_SESSION['password'])) 
            {
                $_SESSION['user'] = "";
                $_SESSION['password'] = "";
            }
        }
        
        header("location:  http://localhost/TCC/home");
    }


    public function setLogin() {
        $l = new loginCon;

        if($l->setLogin(parametros:$_POST)) {
            header("HTTP/1.1 200 OK");
            echo(json_encode('user:'.'logado'));
        } else {
            header("HTTP/1.1 401 ");
            echo(json_encode('user:'.'nao logado'));
        }
    }

    public static function getTipo()
    {
        if(isset($_SESSION['user']) && isset($_SESSION['password'])) {
            if(parent::verifica($_SESSION['user'],$_SESSION['password'])) 
            {
                $l = new loginCon;
                $a = $l->getAllData($_SESSION);
                
                $a['tipo'] = isset($a['tipo']) ? $a['tipo'] : '3';
                return intval($a['tipo']);
            } else {
                return 9;
            }
            
        } else {
            return 9;
        }
    }

    public static function redirectLogin(int ...$requerimento) {
        $tipo = loginController::getTipo();
        
        $cont = false;
        foreach ($requerimento as $req){
            echo $req.'=='.$tipo;
                echo '<br>';
            if ($req == $tipo) {
                $cont = true;
                
            }
        }
        if(!$cont) 
        {
            echo "nao passow";
            header('location: http://localhost/TCC/login/login');
            die();
        }

    }


    

    
}   


?>