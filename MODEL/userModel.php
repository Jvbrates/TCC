<?php
class userModel
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

    public function getFull()
    {

        $read = $this->con->prepare("SELECT nome, nomeUsuario, emailUsuario  FROM USUARIO WHERE nomeUsuario LIKE :nome ");
        $read->bindParam(':nome', $_SESSION['user']);
        $read->execute();

        $dados = array();
        $dados = $read->fetch(PDO::FETCH_ASSOC);
        //        $dados = json_encode($read->fethAll(PDO::FETCH_ASSOC));
        return $dados;
    }


    public function dell($id) //Deleta Usuário
    {
        $read = $this->con->prepare("DELETE FROM USUARIO  WHERE nome = :id");
        $read->bindParam(":id", $id);
        $read->execute();
    }

    public function setModerador(array $parametros, $senha)
    {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        $read = $this->con->prepare("INSERT INTO USUARIO (nome, nomeUsuario, senha, emailUsuario, tipo) VALUES ( :nome, :username, :senha, :email, 1)");
        $read->bindparam(':nome', $_POST['nome']);
        $read->bindparam(':username', $_POST['user']);
        $read->bindparam(':email', $_POST['email']);
        $read->bindparam(':senha', $senha);
        try {
            $read->execute();
            return true;
        } catch (Exception $e) {
            echo $e->getCode();
        }
    }

    public function edit($value)
    {

        if (!filter_var($value['email'], FILTER_VALIDATE_EMAIL)) {
            echo ('nao passou no email');
            return false;
        }
        try {
            $read = $this->con->prepare('SELECT idUsuario FROM USUARIO WHERE nomeUsuario LIKE :nome');
            $n = $_SESSION['user'];
            $read->bindparam(':nome', $n);
            $read->execute();
            $id = $read->fetch(PDO::FETCH_BOTH)[0];

            $read = $this->con->prepare('UPDATE USUARIO SET USUARIO.nome = :nome, USUARIO.nomeUSuario = :nomeUsuario, USUARIO.emailUsuario = :email WHERE USUARIO.idUsuario LIKE :id');
            $read->bindparam(':nome', $value['nome']);
            $read->bindparam(':nomeUsuario', $value['username']);
            $read->bindparam(':email', $value['email']);
            $read->bindparam(':id', $id);
            $read->execute();


            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function editsenha($value)
    {

        if ($_SESSION['password'] !=  $value['senha']) {
            echo ('nao passou na senha');
            return false;
        }
        try {
            $read = $this->con->prepare('SELECT idUsuario FROM USUARIO WHERE nomeUsuario LIKE :nome');
            $n = $_SESSION['user'];
            $read->bindparam(':nome', $n);
            $read->execute();
            $id = $read->fetch(PDO::FETCH_BOTH)[0];

            $read = $this->con->prepare('UPDATE USUARIO SET USUARIO.senha = :senha WHERE USUARIO.idUsuario LIKE :id');
            $read->bindparam(':senha', $value['nsenha']);

            $read->bindparam(':id', $id);
            $read->execute();

            session_unset();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getFav()
    {

        try {
            $read = $this->con->prepare('SELECT CURSO.nomeCurso, INSTITUICAO.nomeInstituicao, f.ativo, CURSO.idCurso FROM `FAVORITOS` f JOIN CURSO ON CURSO.idCurso = f.idCurso JOIN INSTITUICAO on INSTITUICAO.idInstituicao = CURSO.idInstituicao WHERE f.idUsuario = :id AND f.ativo = 1; ');
            $read->bindparam(':id', $_SESSION['id']);
            $read->execute();

            $dados = array();
            $dados = $read->fetchAll(PDO::FETCH_ASSOC);

            if($read->rowCount() != 0){
                return $dados;
            } else {
                return false;
            }
            

        } catch (Exception $e) {
            return false;
        }
    }

    public function toggleFav($id){
        try {
            $read = $this->con->prepare('INSERT INTO FAVORITOS (idCurso, idUsuario) VALUES (:idCurso, :idUser)');
            $read->bindparam(':idUser', $_SESSION['id']);
            $read->bindparam(':idCurso', $id[0]);
            $read->execute();

        } catch (\Throwable $th) {
            $read = $this->con->prepare('UPDATE FAVORITOS SET FAVORITOS.ativo = !FAVORITOS.ativo WHERE FAVORITOS.idCurso = :idCurso AND FAVORITOS.idUsuario = :idUser; ');
            $read->bindparam(':idUser', $_SESSION['id']);
            $read->bindparam(':idCurso', $id[0]);
            $read->execute();
            return true;
        }
    }

    public function newSenha($email, $senha){
        $read = $this->con->prepare('UPDATE USUARIO SET senha = :senha WHERE emailUsuario LIKE :email');
        $read->bindParam(':senha', $senha);
        $read->bindParam(':email', $email);
        $read->execute();
    }

}
