<?php
class cursosController extends controller
{
    public function cursos()
    {

        $loginTipo = loginController::getTipo();
        loginController::redirectLogin(1, 2);
        $a = new cursosModel();


        $this->carregarTemplate(__FUNCTION__, $loginTipo, $a->getAll());
    }

    public function new()
    {

        $loginTipo = loginController::getTipo();
        loginController::redirectLogin(1, 2);
        $this->carregarTemplate(__FUNCTION__ . 'Curso', $loginTipo);
    }


    public function getUF()
    {

        $a = new cursosModel();
        header('Content-Type: application/json');
        echo (json_encode($a->getUF(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }

    public function cidades($uf)
    {

        $a = new cursosModel();
        header('Content-Type: application/json');
        echo (json_encode($a->cidades($uf[0]), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }

    public function getUFid($cidade)
    {

        $a = new cursosModel();
        header('Content-Type: text/plain');
        echo (json_encode($a->getUFid($cidade[0]), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }

    public function getTipos()
    {
        $a = new cursosModel();
        header('Content-Type: application/json');
        echo (json_encode($a->getTipos(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }

    public function get()
    {
        $a = new cursosModel();
        header('Content-Type: application/json');
        echo (json_encode($a->getAll(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }

    public function getFull($id) // retorna todos os dados de um usuario
    {
        loginController::redirectLogin(1, 2);
        $a = new cursosModel();
        header('Content-Type: application/json');
        echo (json_encode($a->getFull($id[0])[0], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }

    public function getFullv($id) // retorna todos os dados de um usuario
    {
        
        $a = new cursosModel();
        header('Content-Type: application/json');
        echo (json_encode([$a->getFullv($id[0])[0], "log" => loginController::getTipo()], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        
    }

    public function cad()
    {
        loginController::redirectLogin(1, 2);
        $a = new cursosModel();

        $lista = array();

        print_r($_POST);
        print_r($lista);

        if ($a->cadCurso(nomeCurso: $_POST['nomeCurso'], descrição: $_POST['descricaoCurso'], modalidade: $_POST['modalidadeCurso'], turno: $_POST['turno'], duracao: $_POST['duracaoCurso'], duracaoTipo: $_POST['tipoDuracaoCurso'], idCidade: $_POST['idCidade'], tipoCurso: $_POST['tipoCurso'], instituicao: $_POST['instituicaoCurso'])) {
            header('location:http://localhost/TCC/cursos/');
            exit();
        } else {
            header('location:http://localhost/TCC/cursos/new/');
            exit();
        }
    }

    public function visivel($id)
    {
        loginController::redirectLogin(1, 2);
        $a = new cursosModel();
        header('Content-Type: application/json');

        if ($a->visibilidade($id[0], $_POST['check'])) {
            header("HTTP/1.1 200 OK");
            exit();
        } else {
            header("HTTP/1.1 500 erro");
            exit();
        };
    }

    public function delete($id)
    {
        loginController::redirectLogin(1, 2);
        $a = new cursosModel();
        header('Content-Type: application/json');

        if ($a->delete($id[0])) {
            header("HTTP/1.1 200 OK");
            exit();
        } else {
            header("HTTP/1.1 500 erro");
            exit();
        };
    }

    public function update() //Página de Editar
    {
        $loginTipo = loginController::getTipo();
        loginController::redirectLogin(1, 2);

        $this->carregarTemplate('updateCurso', $loginTipo);
    }

    public function edit($id)
    {
        loginController::redirectLogin(1, 2);

        $algo = json_decode(file_get_contents('php://input'), true);
        $a = new cursosModel();
        
        if ($a->update(values:$algo, id:$id[0])) {
            header("HTTP/1.1 200 ok");
        } else {
            header("HTTP/1.1 500 erro");
        }
    }

 

    public function view()
    {

        $this->carregarTemplate(__FUNCTION__.'Curso', loginController::getTipo());
    }

}
