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
}
