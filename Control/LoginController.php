<?php

require_once('Model/UserModel.php');
require_once('View/LoginView.php');
require_once('Helpers/AuthHelper.php');

class LoginController{
    
    private $userModel;
    private $view;
    private $authHelper;

    function __construct(){
        $this->userModel = new UserModel();
        $this->view = new LoginView();
        $this->authHelper = new AuthHelper();
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

            $user = $this->userModel->getUser($usuario);

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