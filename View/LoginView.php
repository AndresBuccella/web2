<?php

require_once('./libs/smarty/libs/Smarty.class.php');

class LoginView{

    private $smarty;

    function __construct(){
        $this->smarty = new Smarty();
    }

    function showLogin($okSingup = ''){
        $this->smarty->assign('title', 'Log In');
        $this->smarty->assign('okSingup', $okSingup);
        $this->smarty->display('./templates/login.tpl');
    }

    function showHome($sessiON, $alert='', $usuario=''){
        $this->smarty->assign('sessiON', $sessiON);
        $this->smarty->assign('alert', $alert);
        $this->smarty->assign('user', $usuario);
        $this->smarty->display('./templates/home.tpl');
    }

}