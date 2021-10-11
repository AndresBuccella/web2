<?php

require_once('Model/UserModel.php');
require_once('View/LoginView.php');

class LoginController{
    
    private $model;
    private $view;

    function __construct(){
        $this->model = new UserModel();
        $this->view = new LoginView();
    }
    
    function singUp(){
        $user = $this->model->getUser($_POST['mail']);
    }

    function login(){
        $this->view->showLogin();
    }

    function verifyLogin(){
        if ((!empty($_POST['mail']) && !empty($_POST['clave'])) 
        || (!empty($_POST['usuario']) && (!empty($_POST['clave'])))) {
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $mail = $_POST['mail'];

            $user = $this->model->getUser($mail);

            if ($user && password_verify($clave, $user->clave)){
    
            session_start();
                $_SESSION['mail'] = $user->mail;
    
                $this->view->showHome('Bienvenido: ', $usuario);
            }else{
                $this->view->showLogin('Acceso denegado');
            }
        }else{
            $this->view->showLogin('Acceso denegado');
        }
        
    }
}