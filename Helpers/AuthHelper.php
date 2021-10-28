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
            //$this->view->showLogin();
            //header('Location: '.BASE_URL.'loginUser'); //corta la ejecucion
            return false;
        }else{
            return true;
        }
    }
    function checkPermission(){
        session_start();
        if(!isset($_SESSION['usuario'])){
            //$this->view->showLogin();
            header('Location: '.BASE_URL.'loginUser'); //corta la ejecucion
            die;
        }
    }

    
    function logout(){
        session_start();
        session_destroy();
    }
}