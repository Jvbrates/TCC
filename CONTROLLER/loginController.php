<?php

class loginController extends controller
{

    public function login()
    {
        include "../VIEW/" . __FUNCTION__ . ".php";
    }

    //Carrega a página de Cadastro
    public function cadastro()
    {
        include "../VIEW/" . __FUNCTION__ . ".php";
    }

    //Realizar o logoff, para isso apaga as variaveis 
    //$_SESSION 'user' e 'password' e redireciona para pagina inicial.
    public function logoff()
    {
        if (isset($_SESSION['user']) && isset($_SESSION['password'])) {
            if (parent::verifica($_SESSION['user'], $_SESSION['password'])) {
                $_SESSION['user'] = "";
                $_SESSION['password'] = "";
            }
        }

        header("location:  http://localhost/TCC/");
    }

    //Verifica o Login, a partir do retorno da Model loginCon->setlogin define 200 para true e 401 para false
    public function setLogin()
    {
        $l = new loginCon;

        if ($l->setLogin(parametros: $_POST)) {
            header("HTTP/1.1 200 OK");
            echo (json_encode('user:' . 'logado'));
            exit();
        } else {
            header("HTTP/1.1 401 ");
            echo (json_encode('user:' . 'nao logado'));
            exit();
        }
    }

    //Verifica o login, a partir do retorno da Model loginCon->setlogin 
    //e retorna o tipo de usuário, no caso de não está logado, retorna 9
    public static function getTipo()
    {
        if (isset($_SESSION['user']) && isset($_SESSION['password'])) {
            if (parent::verifica($_SESSION['user'], $_SESSION['password'])) {
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
    //Verifica a disponibilidade do nome no banco de dados
    public function verNome()
    {
        $l = new loginCon;
        if ($l->verNome(nome: $_POST['user'])) {
            header("HTTP/1.1 202 OK");

            exit(); 
        } else {
            header("HTTP/1.1 401 ");

            exit();
        }
    }
    //Verifica a disponibilidade do email no banco de dados
    public function verEmail()
    {
        $l = new loginCon;
        if ($l->verEmail(email: $_POST['email'])) {
            header("HTTP/1.1 202 OK");
            exit();
        } else {
            header("HTTP/1.1 401 ");
            exit();
        }
    }

    public function setCadastro()
    {
        $l = new loginCon;
        if($l->setCadastro(parametros: $_POST)){
            
            $_SESSION['user'] = $_POST['user'];
            $_SESSION['password'] = $_POST['password'];
            header('location: http://localhost/TCC/home/');
        } else {
            header('location: http://localhost/TCC/cadastro/cadastro');
        }
    }


    //Redireciona o usuário caso seu tipo não seja permitido naquela página,
    // faz uso do método loginController::getTipo
    public static function redirectLogin(int ...$requerimento)
    {
        $tipo = loginController::getTipo();
        
        $cont = false;
        foreach ($requerimento as $req) {
            
            if ($req == $tipo) {
                $cont = true;
            }
        }
        if (!$cont) {
            header('location: http://localhost/TCC/login/login');
            exit();
        }
    }
}
