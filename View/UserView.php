<?php
require_once('./libs/smarty-3.1.39/libs/Smarty.class.php');

class UserView{


    private $smarty;

    function __construct(){
        $this->smarty = new Smarty();
    }

    function showHome($sessiON=false, $alert='', $user='', $admin = false){
        $this->smarty->assign('sessiON', $sessiON);
        $this->smarty->assign('alert', $alert);
        $this->smarty->assign('user', $user);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('./templates/home.tpl');
    }

    function showSignUp($sessiON = false, $admin = false, $error = false){
        $this->smarty->assign('title', 'Sign up');
        $this->smarty->assign('sessiON', $sessiON);
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('error', $error);
        $this->smarty->display('./templates/signUp.tpl');
    }


    function showUsers($users = null, $admin = false, $sessiON = false){
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('users', $users);
        $this->smarty->assign('sessiON', $sessiON);
        $this->smarty->display('./templates/users.tpl');
    }
}