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

    public function getTipos()
    {
        $a = new cursosModel();
        header('Content-Type: application/json');
        echo (json_encode($a->getTipos(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }

    public function cad()
    {
        loginController::redirectLogin(1, 2);
        $a = new cursosModel();
 
        $lista = array(); 
        
        print_r($_POST);
        print_r($lista);
        
        if ($a->cadCurso(nomeCurso:$_POST['nomeCurso'], descrição:$_POST['descricaoCurso'], modalidade:$_POST['modalidadeCurso'], turno:$_POST['turno'],duracao:$_POST['duracaoCurso'],duracaoTipo:$_POST['tipoDuracaoCurso'],idCidade:$_POST['idCidade'],tipoCurso:$_POST['tipoCurso'],instituicao:$_POST['instituicaoCurso'])){
           header('location:http://localhost/TCC/cursos/');
           exit();

        } else {
            header('location:http://localhost/TCC/cursos/new/');
            exit();
        }
    }
}
