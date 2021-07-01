<?php 
//A partir da URL separa entre classe, função e parametro;
// localhost/cadastro/curso/informatica
//             ^        ^        ^
//           CLasse   Funcão  Parametro
Class Routes{
    public function __construct(){
        $this->run();
    }

    public function run(){
        if(isset($_GET['pag'])) {
            $url = $_GET['pag'];
            
        }
        
        if(!empty($url)){
            $url = explode('/', $url);
            $controller= $url[0].'Controller'; // classe
            array_shift($url); 
         

            if(isset($url[0]) && !empty($url[0])){ 
                $metod = $url[0];
                array_shift($url);
                //echo "funciando aqui mas nao é pra funcionar aqui";

            } else {
                //somente classe
                $metod = 'index';
                //echo "funciando aqui no index main ->";

            }
            if(count($url)>0){
                $parameters = $url;
            }
        }else
        {
            $controller= "homeController";
            $metod = "index";
        }
        //echo "esta em route";
        $route = 'TCC/CONTROLLER/'.$controller.'.php';
        if(!file_exists($route) && !method_exists($controller, $metod)) {
            $controller= "homeController";
            $metod = "index";
        }
        //echo "chegou no fim de main.php ->";
        $c = new $controller;
        
        
        //call_user_func_array(array($c,$metod), $parameters);
        $c->{$metod}($parameters);
    }

}

?>