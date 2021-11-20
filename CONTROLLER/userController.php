<?php

class userController extends controller
{

    public function users()
    {

        $loginTipo = loginController::getTipo();
        loginController::redirectLogin(2);
        $a = new userModel();

        
        $this->carregarTemplate(__FUNCTION__, $loginTipo, $a->getAll());
    }


    public function perfil()
    {

        $loginTipo = loginController::getTipo();
        loginController::redirectLogin(0, 1, 2);



        
        $this->carregarTemplate(__FUNCTION__, $loginTipo);
    }


    public function user()
    {


        loginController::redirectLogin(0, 1, 2);
        $a = new userModel();
        header('Content-Type: application/json');
        echo (json_encode($a->getFull(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }


    public function edit()
    {
        loginController::redirectLogin(0, 1, 2);

        $a = new userModel();

        $algo = json_decode(file_get_contents('php://input'), true);

        if ($a->edit($algo)) {
            header("HTTP/1.1 200 OK");
        } else {
            header("HTTP/1.1 500 erro");
        }
        exit();
    }

    public function editsenha()
    {
        loginController::redirectLogin(0, 1, 2);

        $a = new userModel();

        $algo = json_decode(file_get_contents('php://input'), true);

        if ($a->editsenha($algo)) {
            header("HTTP/1.1 200 OK");
        } else {
            
            header("HTTP/1.1 500 erro");
        }
        exit();
    }

    public function dell() //Deleta a Instituição Anti CSRF?
    {
        loginController::redirectLogin(2);
        $a = new userModel();
        $a->dell($_POST['id']);
        exit();
    }

    public function new()
    {
        loginController::redirectLogin(2);

        $this->carregarTemplate('moderador', loginController::getTipo());
    }


    public function setModerador()
    {
        loginController::redirectLogin(2);
        $l = new userModel();
        $senha = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVYXWZabcdefghijklmnopqrstuvyxwz0123456789!@#$%¨&*()_+='), 0, 8);
        if ($l->setModerador(parametros: $_POST, senha: $senha)) {
            $command = " ./../Email C jv.belmonterates@gmail.com covid-19 {$_POST['email']} {$_POST['nome']} {$_POST['user']} {$senha}  > /dev/null 2>/dev/null &";
            shell_exec($command);
            header('location: http://localhost/TCC/user');
        } else {

            header('location: http://localhost/TCC/user/new');
        }
    }

    public function novaSenha(){
        
        $email = new loginCon();
        

        if(!$email->verEmail($_POST['email'])){
            $senha = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVYXWZabcdefghijklmnopqrstuvyxwz0123456789!@#$%¨&*()_+='), 0, 8);
            $l = new userModel();
            $l->newSenha($_POST['email'], $senha);
            $command = " ./../Email C jv.belmonterates@gmail.com covid-19 {$_POST['email']} 'n' 'n' {$senha}  > /dev/null 2>/dev/null &";
            shell_exec($command);
            echo "aaa";
        } else {
            $command = " ./../Email F jv.belmonterates@gmail.com covid-19 '{$_POST['email']}' 'n' 'n' 'n'  > /dev/null 2>/dev/null &";
            shell_exec($command);
           
            
        }
        exit();
    }

    public function favoritos($get = null)
    {
        loginController::redirectLogin(0);
        if (!$get) {
            $this->carregarTemplate(__FUNCTION__, loginController::getTipo());
        } elseif ($get = 'getfav') {
            $a = new userModel();
            header('Content-Type: application/json');
            $ret = $a->getFav();
            if ($ret) {
                echo (json_encode($a->getFav(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            } else {
                header("HTTP/1.1 500 erro");
            }
        }
    }

    public function toggleFav($id)
    {
        loginController::redirectLogin(0);
        $a = new userModel();

        if ($a->toggleFav($id)) {
            header("HTTP/1.1 200 ok");
        } else {
            header("HTTP/1.1 500 erro");
        }
    }
}
