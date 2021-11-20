<?php
//A partir da URL separa entre classe, função e parametro;
// localhost/cadastro/curso/informatica
//             ^        ^        ^
//           CLasse   Funcão  Parametro
class Routes
{
    public function __construct()
    {
        $this->run();
    }

    public function run()
    {
        $parameters = NULL;

        if (isset($_GET['pag'])) {
            $url = $_GET['pag'];
        }

        if (!empty($url)) {

            $url = explode('/', $url);
            error_log($url[0]);
            

            $controller = $url[0] . 'Controller'; // classe
            array_shift($url);
            
            //API ANTES DAQUI |-||<>||-|


            //Define o Método| Padrão é index
            if (isset($url[0]) && !empty($url[0])) {
                $metod = $url[0];
                array_shift($url);
            } else {
                $metod = 'index';
            }

           //Define Parametros
            count($url) > 0 ? $parameters = $url : null;


       
        } else { //caso nao seja passado nada na URl
           
            $controller = "homeController";
            $metod = "homepage";
        }


        $route = '../CONTROLLER/' . $controller . '.php';
        //caso A 
        if(!class_exists($controller)){
            $controller = 'homeController';
        }
       
        if(!method_exists($controller, $metod)){
            $metod = get_class_methods(new $controller)[0];
        }; 
        if (!file_exists($route) && !method_exists($controller, $metod)) {
         
         
            $controller = "homeController";
            $metod = "homepage";
        }
        
        $classe = new $controller;
        $classe->{$metod}($parameters);
     
    }
}

?>
