<?php 
//Excluir a necessidade de estar massivamente requerendo classes
//echo("SPL funciona?");
spl_autoload_register(
    function($filename)
    {
        if(file_exists('../CONTROLLER/'.$filename.'.php')){
        require_once '../CONTROLLER/'.$filename.'.php';
        
        
    
        }elseif (file_exists('../Routes/'.$filename.'.php')) {
            require_once '../Routes/'.$filename.'.php';
        //   echo 'passou por autoload ->';

    
        }elseif (file_exists('../MODEL/'.$filename.'.php')) {
            require_once '../MODEL/'.$filename.'.php';
    
        }
    }
);

?>