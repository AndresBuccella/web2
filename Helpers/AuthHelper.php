<?php
require_once('View/LoginView.php');


class AuthHelper{

    private $view;

    function __construct(){
        
        $this->view = new LoginView();

    }

    
    function checkLoggedIn(){
        session_start();
        if(!isset($_SESSION['usuario'])){
            return false;
        }else{
            return true;
        }
    }

    function admin($sessiON){
        //2- admin user
        if ($sessiON) {
            if($_SESSION['rol'] == 2){
                return true;
            }
        }
        return false;
    }

    function login($user){
        session_start();
        $_SESSION['id'] = $user->id;
        $_SESSION['usuario'] = $user->usuario;
        $_SESSION['rol'] = $user->rol;
        return true;
    }
    
    function logout(){
        session_start();
        session_destroy();
    }
}