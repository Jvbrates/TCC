<?php

class controller
{
    public $dados = array();


    //Carrega o template, o arquivo recebera o nome de 'template' mais a variavel dados[0]
    public function carregarTemplate($viewName, $dados, $toJavascript = null)
    {
        $this->dados = $dados;
        //echo ' carregar template->';
        require '../VIEW/template' . $dados . '.php';
    }

    //Chamado de dentro do template carrega a página em si:
    public function carregarViewinTemplate($viewName, $dados, $toJavascript = null)
    {
        echo "<!----Variavel carregada estaticamente pelo servidor--->";

        if (isset($toJavascript)) {
            controller::toJavascript($toJavascript);
        }
        if (file_exists('../VIEW/' . $viewName . '.php')) {
            require '../VIEW/' . $viewName . '.php';
        } else {
            require '../VIEW/' . $viewName . '.html';
        }
    }

    //Verifica se as variaveis Existem
    public static function verifica(...$variaveis) //retorna false caso pelo menos uma das variaveis passadas não exista eu seja vazia
    { //Verifica Empty e Isset
        foreach ($variaveis as $variavel) {

            if (empty($variavel)) {
                return false;
            }

            return true;
        }
    }

    static function toJavascript(array $array)
    {
        echo '<script>';
        echo 'variavel = ';
        echo (json_encode($array, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        echo '</script>';
        
    }

    

}
