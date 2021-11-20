<?php
class homeModel
{
    private $con;

    //Ao criar o objeto será feira conexxão com banco de dados ==/ /==
    public function __construct()
    {
        $this->con = ConnectionDB::getConnection();
    }

    public function getAll()
    {
        $read = $this->con->prepare("SELECT USUARIO.nome, USUARIO.nomeUsuario, USUARIO.emailUsuario, USUARIO.tipo FROM `USUARIO` WHERE USUARIO.tipo != 2; ");
        $read->execute();

        $dados = array();
        $dados = $read->fetchAll(PDO::FETCH_ASSOC);

        return $dados;
    }
    public function search($busca="", $cidade="", $modalidade = "", $turno="", $instituicao="", $tipo="")
    {
        $sql = 'SELECT c.nomeCurso as "CURSO", INSTITUICAO.nomeInstituicao as "INSTITUIÇÂO" ,CIDADE.nome as "CIDADE", c.IdCurso, c.turno, c.modalidade, c.turno, c.duracao, c.tipoDuracao, c.idtipoCurso, c.idCIDADE, c.idInstituicao, ESTADO.UF  as "UF", TIPOCURSO.nome FROM CURSO c JOIN CIDADE on c.idCIDADE = CIDADE.idCIDADE JOIN INSTITUICAO on c.idInstituicao = INSTITUICAO.idInstituicao JOIN ESTADO on CIDADE.idESTADO = ESTADO.idESTADO JOIN TIPOCURSO on TIPOCURSO.idTIPOCURSO = c.idtipoCurso WHERE nomeCurso LIKE "%'.$busca.'%" AND c.visivel = 1';

       
        
        //$read->bindValue(':id', '%'.$busca.'%');
        
        if(!empty($cidade)){
            
            $sql .= ' AND CIDADE.idCidade LIKE "%'.$cidade.'%" ';
        }

        if(!empty($modalidade)){
            
            $sql .= ' AND c.modalidade LIKE '.$modalidade.' ';
            
        }

        if(!empty($turno)){
            
            $sql .= " AND c.turno LIKE ".$turno." ";
           
        }
        
        if(!empty($instituicao)){
            
            $sql .= " AND c.idInstituicao LIKE ".$instituicao." ";
            
        }

        if(!empty($tipo)){
            
            $sql .= " AND c.idTIPOCURSO LIKE ".$tipo." ";
            
        }
       
        $read = $this->con->query($sql);
        
    
        
        $dados = array();
        $dados = $read->fetchAll(PDO::FETCH_ASSOC);

        return $dados;
    }


    public function getDados(){
        $read = $this->con->query("SELECT COUNT(INSTITUICAO.idInstituicao) as 'instituicoes' FROM INSTITUICAO; ");
        $data["Instituicoes"] = $read->fetch(PDO::FETCH_BOTH)[0];
        $read = $this->con->query("SELECT COUNT(CURSO.idCurso) as 'cursos' FROM CURSO;");
        $data['Cursos'] = $read->fetch(PDO::FETCH_BOTH)[0];
        $read = $this->con->query("SELECT COUNT(CURSO.idCurso) as 'cursosAtv' FROM CURSO WHERE CURSO.visivel = 1;");
        $data['CursosAtv'] = $read->fetch(PDO::FETCH_BOTH)[0];
        $read = $this->con->query("SELECT COUNT(USUARIO.idUsuario) as 'users' FROM USUARIO; ");
        $data['Usuarios'] = $read->fetch(PDO::FETCH_BOTH)[0];

        return $data;
    }
}
