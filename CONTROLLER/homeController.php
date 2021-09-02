<?php

class homeController extends controller{
    public function __construct(){
       
    }
    public function homepage(){
        //echo "chegou em homecontroller index->";  
       //echo(loginController::getTipo());
        
        if(isset($_POST['user']) && isset($_POST['password'])) 
        {
            if(parent::verifica($_POST['user'],$_POST['password'])) 
            {
                //session_start();
                $_SESSION['user'] = $_POST['user'];
                $_SESSION['password'] = $_POST['password'];
                var_dump($_SESSION);
            }
        }
       
        $loginTipo = loginController::getTipo();


       
        $this->carregarTemplate(__FUNCTION__, $loginTipo); 
         
       //echo "chegou em homecontroller index";
    }

    public function testededados()
    {   
        loginController::redirectLogin(0);
        //$a = new testeconexao();
        //$dados = $a->listatab();
        //$this->carregarTemplate(__FUNCTION__, $dados, "tdados2");
        include '../VIEW/testededados.php'  ;
    }
}   


?>