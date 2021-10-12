<?php

class AuthHelper{

    function __construct(){
        
    }

    
    function checkLoggedIn(){
        session_start();
        if(!isset($_SESSION['usuario'])){
            //$this->view->showLoginLocation();
            //header('Location: '.BASE_URL.'loginUser'); //corta la ejecucion
            return false;
        }else{
            return true;
        }
    }
    function checkPermission(){
        session_start();
        if(!isset($_SESSION['usuario'])){
            //$this->view->showLoginLocation();
            header('Location: '.BASE_URL.'loginUser'); //corta la ejecucion
        }
    }

    
    function logout(){
        session_start();
        session_destroy();
    }
}