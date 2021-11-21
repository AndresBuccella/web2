<?php

require_once('./libs/smarty-3.1.39/libs/Smarty.class.php');

class LoginView{

    private $smarty;

    function __construct(){
        $this->smarty = new Smarty();
    }

    function showLogin($sessiON = false, $msg = '', $admin = false){
        $this->smarty->assign('title', 'Log In');
        $this->smarty->assign('msg', $msg);
        $this->smarty->assign('sessiON', $sessiON);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('./templates/login.tpl');
    }

    function showHome($sessiON = false, $alert='', $user='', $admin = false){
        $this->smarty->assign('sessiON', $sessiON);
        $this->smarty->assign('alert', $alert);
        $this->smarty->assign('user', $user);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('./templates/home.tpl');
    }

}