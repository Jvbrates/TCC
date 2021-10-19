<?php
class cursosModel
{
    private $con;

    //Ao criar o objeto será feira conexxão com banco de dados ==/ /==
    public function __construct()
    {
        $this->con = ConnectionDB::getConnection();
    }

    public function getAll()
    {

        $sql = "SELECT c.nomeCurso as 'CURSO', INSTITUICAO.nomeInstituicao as 'INSTITUIÇÂO' ,CIDADE.nome as 'CIDADE', c.turno FROM CURSO c JOIN CIDADE on c.idCIDADE = CIDADE.idCIDADE JOIN INSTITUICAO on c.idInstituicao = INSTITUICAO.idInstituicao; ";
        $read = $this->con->prepare($sql);
        $read->execute();

        $dados = array();
        $dados = $read->fetchAll(PDO::FETCH_ASSOC);

        return $dados;
    }

    public function getUF()
    {
        $read = $this->con->query('SELECT idESTADO, UF FROM ESTADO ');
        $dados = array();
        $dados = $read->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }

    public function cidades($UF)
    {
        $read = $this->con->query('SELECT idCidade, nome FROM CIDADE WHERE idESTADO LIKE ' . $UF);
        $dados = array();
        $dados = $read->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }

    public function getTipos()
    {
        $read = $this->con->query('SELECT * FROM TIPOCURSO');
        $dados = array();
        $dados = $read->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }
    public function cadCurso($nomeCurso, $descrição,  $modalidade, $turno, $duracao, $duracaoTipo, $idCidade, $tipoCurso, $instituicao)
    {
        $read = $this->con->prepare('INSERT INTO CURSO(nomeCurso,   modalidade, turno, duracao, Descrição, tipoDuracao, idtipoCurso, idCIDADE, idInstituicao) VALUE (:nomeCurso, :modalidade, :turno, :duracao, :descricao, :tipoDuracao, :idtipoCurso, :idCIDADE, :idInstituicao)');
        $read->bindParam(':nomeCurso', $nomeCurso);
        $read->bindParam(':modalidade', $modalidade);
        $read->bindParam(':turno', $turno);
        $read->bindParam(':duracao', $duracao);
        $read->bindParam(':descricao', $descrição);
        $read->bindParam(':tipoDuracao', $duracaoTipo);
        $read->bindParam(':idtipoCurso', $tipoCurso);
        $read->bindParam(':idCIDADE', $idCidade);
        $read->bindParam(':idInstituicao', $instituicao);
        $read->execute();
        return true;
    }
}

//SELECT CURSO.nomeCurso, INSTITUICAO.idInstituicao FROM `CURSO`, `INSTITUICAO` WHERE CURSO.idInstituicao LIKE INSTITUICAO.idInstituicao; 
