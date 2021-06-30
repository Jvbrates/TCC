<?php
include "../CONTROLLER/connectionDB.php";

$tst = ConnectionDB::getConnection();
$r = $tst->query("SHOW tables;");

$dados = $r->fetchAll(PDO::FETCH_ASSOC);
        //print_r( $dados);
        print_r($dados);