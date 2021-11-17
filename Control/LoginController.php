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

    function showLogin(){
        $this->view->showLogin();
    }

    function logout(){
        $this->authHelper->logout();
        $this->view->showLogin('Te deslogueaste');
    }
    
    private function login($newUser, $password){

        $user = $this->userModel->getUserByName($newUser);
        if ($user && password_verify($password, $user->clave)){
            session_start();
            $_SESSION['usuario'] = $user->usuario;
            $sessiON = true;
            $this->view->showHome($sessiON, 'Bienvenido: ', $newUser);
        }else{
            $this->view->showLogin('Acceso denegado');
        }

    }

    function verifyLogin(){
        if ((!empty($_POST['usuario']) && (!empty($_POST['clave'])))) {
            $newUser = $_POST['usuario'];
            $password = $_POST['clave'];
            $this->login($newUser, $password);
        }else{
            if (!empty($user) && !empty($password)) {
                $this->login($user, $password);
            }else{
                $this->view->showLogin('Acceso denegado');
            }
        }
    }
}