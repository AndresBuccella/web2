<?php

require_once('Model/UserModel.php');
require_once('View/LoginView.php');
require_once('Helpers/AuthHelper.php');

class LoginController{
    
    private $model;
    private $view;
    private $authHelper;

    function __construct(){
        $this->model = new UserModel();
        $this->view = new LoginView();
        $this->authHelper = new AuthHelper();
    }
    
    function singUp(){
        $user = $this->model->getUser($_POST['mail']);
    }

    function login(){
        $this->view->showLogin();
    }

    function logout(){
        $this->authHelper->logout();
        $this->view->showLogin('Te deslogueaste');
    }

    function verifyLogin(){
        if ((!empty($_POST['usuario']) && (!empty($_POST['clave'])))) {
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];

            $user = $this->model->getUser($usuario);

            if ($user && password_verify($clave, $user->clave)){
                session_start();
                $_SESSION['usuario'] = $user->usuario;
                $sessiON = true;
                $this->view->showHome($sessiON, 'Bienvenido: ', $usuario);
            }else{
                $this->view->showLogin('Acceso denegado');
            }
        }else{
            $this->view->showLogin('Acceso denegado');
        }
        
    }
}