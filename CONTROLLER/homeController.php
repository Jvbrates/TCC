<?php

class homeController extends controller{

    public function homepage(){
        
       //echo(loginController::getTipo());
       
        if(isset($_POST['user']) && isset($_POST['password'])) 
        {
            if(parent::verifica($_POST['user'],$_POST['password'])) 
            {
                //session_start();
                $_SESSION['user'] = $_POST['user'];
                $_SESSION['password'] = $_POST['password'];
                
            }
        }
       
        $loginTipo = loginController::getTipo();

    
       
        $this->carregarTemplate(__FUNCTION__, $loginTipo); 
        
         
       //echo "chegou em homecontroller index";
    }

    public function testededados()
    {   
        //$a = new testeconexao();
        //$dados = $a->listatab();
        
        
        include '../VIEW/testededados.php'  ;
    }
}   


?>