<?php

require_once('./libs/smarty/libs/Smarty.class.php');

class LoginView{

    private $smarty;

    function __construct(){
        $this->smarty = new Smarty();
    }

    function showLogin(){
        $this->smarty->assign('titulo', 'Log In');
        $this->smarty->display('./templates/login.tpl');
    }

    function showHome(){
        header("Location: ".BASE_URL."home");
    }
}