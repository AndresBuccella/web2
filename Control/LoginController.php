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
        $sessiON = false;
        $msg = 'Log out successfull';
        $this->view->showLogin($sessiON, $msg);
    }
    
    private function login($user, $password){

        $userInfo = $this->userModel->getUserByName($user);
        if ($userInfo && password_verify($password, $userInfo->clave)){
            $sessiON = $this->authHelper->login($userInfo);
            $admin = $this->authHelper->admin($sessiON);
            $this->view->showHome($sessiON, 'Bienvenido: ', $user, $admin);
        }else{
            $this->view->showLogin('Acceso denegado');
        }

    }

    function verifyLogin(){
        $user = $_POST['usuario'];
        $password = $_POST['clave'];
        if ((isset($user)) && (isset($password))) {
            $this->login($user, $password);
        }else{
            $this->view->showLogin('Acceso denegado');
        }
    }
}