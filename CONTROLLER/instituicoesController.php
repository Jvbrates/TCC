<?php

class instituicoesController extends controller
{

    public function instituicoes()
    {

        $loginTipo = loginController::getTipo();
        loginController::redirectLogin(1, 2);

        $this->carregarTemplate(__FUNCTION__, $loginTipo);
    }

    public function getAll() //Retorna dados simples de todas os usuários, exceto administrador
    {

        $a = new instituicaoCon();
        header('Content-Type: application/json');
        echo (json_encode($a->getAll(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }

    static function getFull($id) // retorna todos os dados de um usuario
    {

        $a = new instituicaoCon();
        header('Content-Type: application/json');
        echo (json_encode($a->getFull($id), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }

    public function dell($id) //Deleta a Instituição
    {
        loginController::redirectLogin(1, 2);
        $a = new instituicaoCon();
        $a->dell($id[0]);
        header('location: http://localhost/TCC/instituicoes/admin');
        exit();
    }

    public function new() //Página de Cadastro
    {
        $loginTipo = loginController::getTipo();
        loginController::redirectLogin(1, 2);

        $this->carregarTemplate('newInstituicao', $loginTipo);
    }

    public function update() //Página de Editar
    {
        $loginTipo = loginController::getTipo();
        loginController::redirectLogin(1, 2);

        $this->carregarTemplate('updateInstituicao', $loginTipo);
    }

    public function cad() ///Realiza o Cadastro
    {
        loginController::redirectLogin(1, 2);

        $a = new instituicaoCon();
        if ($a->cad($_POST)) {
            header('location: http://localhost/TCC/instituicoes/admin');
            exit();
        } else {
            header('location: http://localhost/TCC/instituicoes/new');
            exit();
        }
    }

    public function edit($id) // Realiza  o update/edit
    {
        loginController::redirectLogin(1, 2);

        $a = new instituicaoCon();
        if ($a->update($id[0], $_POST)) {
            header('location: http://localhost/TCC/instituicoes/admin');
            exit();
        } else {
            header('location: http://localhost/TCC/instituicoes/update/' . $id);
            exit();
        }
    }

    static function getCascade($id) // retorna todos os dados de uma instituição
    {
        loginController::redirectLogin(1, 2);
        $a = new instituicaoCon();
        header('Content-Type: application/json');
        echo (json_encode($a->getCascade($id), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }
}
