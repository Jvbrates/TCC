<?php

class controller{
    public $dados = array();

    public function carregarTemplate($viewName, ...$dados)
    {
        $this->dados = $dados;
        //echo ' carregar template->';
        require '../VIEW/template'.$dados[0].'.php';

        
    }

    public function carregarViewinTemplate($viewName, $dados)
    {
        require '../VIEW/'.$viewName.'.php';
        
        
    }

    protected static function verifica(...$variaveis) //retorna false caso pelo menos uma das variaveis passadas não exista eu seja vazia
    {//Verifica Empty e Isset
        foreach ($variaveis as $variavel) {

            if(empty($variavel)) {
                return false;
            }
            
            return true;
        }
    } 
}

?>