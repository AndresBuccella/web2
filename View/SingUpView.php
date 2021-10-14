<?php

require_once('./libs/smarty-3.1.39/libs/Smarty.class.php');
require_once('LoginView.php');

class SingUpView{

    private $smarty;
    private $login;


    function __construct(){
        $this->smarty = new Smarty();
        $this->login = new LoginView();
    }

    function showHomeLocation(){
        header('Location:' .BASE_URL. 'home');
    }
    function showLogin(){
        $this->login->showLogin('Registro exitoso. Bienvenido!');
    }
    function showSingUp($error = ''){
        $this->smarty->assign('singup', 'Reg');
        $this->smarty->assign('error', $error);
        $this->smarty->display('./templates/singup.tpl');
    }
}