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

    public function search(){
        $a = new homeModel();
    
        echo(json_encode($a->search(busca:$_POST['busca'], cidade:$_POST['cidade'], modalidade:$_POST['modalidade'], turno:$_POST['turno'], instituicao:$_POST['instituicao']), JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE));   
        //echo(json_encode($_POST, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE));   
    }

}   


?>