<?php
class instituicaoCon
{
    private $con;

    //Ao criar o objeto será feira conexxão com banco de dados ==/ /==
    public function __construct()
    {
        $this->con = ConnectionDB::getConnection();
    }

    public function getAll()
    {
        $read = $this->con->prepare("SELECT idInstituicao, nomeInstituicao, fone, email, site  FROM INSTITUICAO ");
        $read->execute();

        $dados = array();
        $dados = $read->fetchAll(PDO::FETCH_ASSOC);
        //        $dados = json_encode($read->fethAll(PDO::FETCH_ASSOC));
        return $dados;
    }

    public function getFull($id)
    {

        $read = $this->con->prepare("SELECT *  FROM INSTITUICAO WHERE idInstituicao LIKE :id ");
        $read->bindParam(':id', $id[0]);
        $read->execute();

        $dados = array();
        $dados = $read->fetchAll(PDO::FETCH_ASSOC);
        //        $dados = json_encode($read->fethAll(PDO::FETCH_ASSOC));
        return $dados;
    }

    public function dell($id)
    {
        $read = $this->con->prepare("DELETE FROM INSTITUICAO  WHERE idInstituicao = :id");
        $read->bindParam(":id", $id);
        $read->execute();
    }

    public function cad($parametros)
    {
        $coordenadas = $parametros['lat'] . '|' . $parametros["long"];
        echo ($coordenadas);

        if (!filter_var($parametros['emailInstituicao'], FILTER_VALIDATE_EMAIL)) {
            return false;
        } else {
            if (controller::verifica(
                $parametros['nomeInstituicao'],
                $parametros['endereco'],
                $parametros["sobre"],
                $parametros['fone'],
                $parametros['emailInstituicao'],
                $parametros['site'],
                $parametros['lat'],
                $parametros["long"]
            )) {
                $read = $this->con->prepare("INSERT INTO INSTITUICAO (nomeInstituicao, endereco, sobre, localizacao, fone, email, site) VALUES (:nome, :endereco, :sobre, :coord, :fone, :email, :site);");
                $read->bindParam(":nome", $parametros['nomeInstituicao']);
                $read->bindParam(":endereco", $parametros['endereco']);
                $read->bindParam(":sobre", $parametros["sobre"]);
                $read->bindParam(":coord", $coordenadas);
                $read->bindParam(":fone", $parametros['fone']);
                $read->bindParam(":email", $parametros['emailInstituicao']);
                $read->bindParam(":site", $parametros['site']);

                $read->execute();
            }
        }
        //TODO verificações de email, empty e correção de cordenadas vazias no javascritp



        //print_r($read->fetchAll(PDO::FETCH_ASSOC));
        return true;
    }

    public function update($id, $parametros)
    {
        $coordenadas = $parametros['lat'] . '|' . $parametros["long"];
        echo ($coordenadas);
        if(!empty($parametros['emailInstituicao'])){
        if (!filter_var($parametros['emailInstituicao'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        } else {
            if (controller::verifica(
                $parametros['nomeInstituicao'],
                $parametros['endereco'],
                $parametros["sobre"],
                $parametros['fone'],

                $parametros['site'],
                $parametros['lat'],
                $parametros["long"]
            )) {
                $read = $this->con->prepare("UPDATE `INSTITUICAO` SET `nomeInstituicao` = :nome, `endereco` = :endereco, `sobre` = :sobre, `localizacao` = :coord   , `fone` = :fone, `email` = :email, `site` = :site WHERE `INSTITUICAO`.`idInstituicao` = :id; ");
                $read->bindParam(":id", $id);
                $read->bindParam(":nome", $parametros['nomeInstituicao']);
                $read->bindParam(":endereco", $parametros['endereco']);
                $read->bindParam(":sobre", $parametros["sobre"]);
                $read->bindParam(":coord", $coordenadas);
                $read->bindParam(":fone", $parametros['fone']);
                $read->bindParam(":email", $parametros['emailInstituicao']);
                $read->bindParam(":site", $parametros['site']);

                $read->execute();
            }
        }
        return true;
    }

    public function getCascade($id)
    {

        $read = $this->con->prepare("SELECT nomeCurso FROM DBTCC.CURSO WHERE DBTCC.CURSO.idInstituicao LIKE :id");
        $read->bindParam(':id', $id[0]);
        $read->execute();

        $dados = array();
        $dados = $read->fetchAll(PDO::FETCH_ASSOC);
        //        $dados = json_encode($read->fethAll(PDO::FETCH_ASSOC));
        return $dados;
    }


}
