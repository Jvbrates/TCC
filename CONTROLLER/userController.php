<?php

class userController extends controller{

    public function users()
    {
        
        $loginTipo = loginController::getTipo();
        loginController::redirectLogin(2);
        $a = new userModel();
        
        $this->carregarTemplate(__FUNCTION__, $loginTipo, $a->getAll() );
    }
}