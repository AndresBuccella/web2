<?php

require_once('Model/UserModel.php');
require_once('View/LoginView.php');

class UserController{
    
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

    function verify(){
        if ((!empty($_POST['mail']) && !empty($_POST['clave'])) 
        || (!empty($_POST['usuario']) && (!empty($_POST['clave'])))) {
            $user = $_POST['usuario'];
            $password = $_POST['clave'];
            $mail = $_POST['mail'];

            $user = $this->model->getUser($user, $mail);

            if ($user && password_verify($password, $user->password)){

                session_start();
                $_SESSION['mail'] = $user->mail;

                $this->view->showHome();
            }else{
                $this->view->showLogin('Acceso denegado');
            }
        }
        
    }
}