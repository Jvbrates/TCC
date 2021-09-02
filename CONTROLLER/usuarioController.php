<?php

class usuarioController extends controller{
    public function __construct(){
       }

    public function cadastrar()
    {
        $cadastro = new usuarioCon();
        $teste = ["nome" => "Fulano", 
        "username" => "nickname", 
        "senha" => "22082303", 
        "email" => "teste@teste.com" ];
        $cadastro->cadastrar($teste);
        //echo "chegou em homecontroller index->";
       
       //echo "chegou em homecontroller index";
    }
}