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
        /* SELECT c.nomeCurso as 'CURSO', ESTADO.idESTADO as 'estado' ,CIDADE.nome as 'CIDADE', c.turno, c.visivel, c.idCurso FROM CURSO c JOIN CIDADE on c.idCIDADE = CIDADE.idCIDADE JOIN ESTADO on ESTADO.idESTADO = CIDADE.idESTADO; */

        $sql = "SELECT c.nomeCurso as 'CURSO', INSTITUICAO.nomeInstituicao as 'INSTITUIÇÂO' ,CIDADE.nome as 'CIDADE', c.turno, c.visivel, c.idCurso FROM CURSO c JOIN CIDADE on c.idCIDADE = CIDADE.idCIDADE JOIN INSTITUICAO on c.idInstituicao = INSTITUICAO.idInstituicao; ";
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

    public function getUFid($cidade){
        $read = $this->con->query('SELECT idESTADO FROM CIDADE WHERE CIDADE.idCIDADE LIKE '.$cidade);
        $dados = array();
        $dados = $read->fetch(PDO::FETCH_ASSOC);
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
    { //BUG envia dados vazios -- incluir is empty
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
        try {
            $read->execute();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
        
    }

    public function visibilidade($id, $check) //BUG envia dados vazios -- incluir is empty
    {
        $check = filter_var($check, FILTER_VALIDATE_BOOLEAN);
        $valor = $check ? 1 : 0;


        $read = $this->con->prepare('UPDATE CURSO SET visivel = :visibilidade WHERE idCurso = :id; ');
        $read->bindParam(':visibilidade', $valor);
        $read->bindParam(':id', $id);
        try {
            return $read->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    public function delete($id)
    { //TODO Verificar CSRF


        $read = $this->con->prepare('DELETE FROM CURSO WHERE idCurso LIKE :id');
        $read->bindParam(':id', $id);
        try {
            return $read->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    public function getFull($id)
    {

        $read = $this->con->prepare("SELECT c.idCurso, c.nomeCurso, c.modalidade, c.turno, c.duracao, c.Descrição, c.visivel, c.tipoDuracao, c.idtipoCurso, c.idCIDADE, c.idInstituicao, ESTADO.idESTADO as 'idESTADO' FROM CURSO c JOIN CIDADE on c.idCIDADE = CIDADE.idCIDADE JOIN ESTADO on ESTADO.idESTADO = CIDADE.idESTADO WHERE c.idCurso = :id; ");
        $read->bindParam(':id', $id); 
        
        $read->execute();
        
        $dados = array();
        $dados = $read->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
        

        
    }

    public function getFullv($id)//FIXME Caso curso favoritado mas invisivel, será vísivel?
    {

        $read = $this->con->prepare("SELECT c.idCurso, c.nomeCurso, c.modalidade, c.turno, c.duracao, c.Descrição, c.visivel, c.tipoDuracao, c.idtipoCurso, c.idCIDADE, c.idInstituicao, CIDADE.nome as 'CIDADE', ESTADO.UF as 'UF' FROM CURSO c JOIN CIDADE on c.idCIDADE = CIDADE.idCIDADE JOIN ESTADO on ESTADO.idESTADO = CIDADE.idESTADO WHERE c.idCurso = :id AND c.visivel = 1; ");
        $read->bindParam(':id', $id); 
        
        $read->execute();
        
        $dados = array();
        $dados = $read->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
        

        
    }

    public function update($values, $id) //Página de Editar
    {   
        $read = $this->con->prepare("UPDATE `CURSO` SET `nomeCurso` = :nome, `modalidade` = :modalidade, `turno` = :turno, `duracao` = :duracao, `Descrição` = :descr , `idtipoCurso` = :tipo, `idCIDADE` = :cidade WHERE `CURSO`.`idCurso` = :id");        
        $read->bindParam(':id', $id); //id do curso
        //                  
        //valores alterados \/
        $read->bindParam(':nome', $values['nomeCurso']); 
        $read->bindParam(':modalidade', $values['modalidadeCurso']); 
        $read->bindParam(':turno', $values['turno']); 
        $read->bindParam(':duracao', $values['duracaoCurso']); 
        $read->bindParam(':descr', $values['descricaoCurso']);
        $read->bindParam(':tipo', $values['tipoCurso']); 
        $read->bindParam(':cidade', $values['idCidade']); 

        try {
            return $read->execute();
        } catch (Exception $e) {
            return false;
        }
    }





}
