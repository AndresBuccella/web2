<?php

require_once('Model/UserModel.php');
require_once('View/SingUpView.php');

class SingUpController{

    private $model;
    private $view;

    function __construct(){
        $this->model = new UserModel();
        $this->view = new SingUpView();
    }

    function singup(){
        $this->view->showSingUp();
    }

    function verifySingUp(){
        if (!empty($_POST['usuario']) && !empty($_POST['mail']) && !empty($_POST['clave'])){
            $usuario = $_POST['usuario'];
            $mail = $_POST['mail'];
            $clave = $_POST['clave'];
            $users = $this->model->getUsers();
            foreach ($users as $user) {
                if (($user->usuario == $usuario) || ($user->mail == $mail)) {
                    $this->view->showSingUp('El usuario y/o mail ya existen');
                    return;
                }
            }
            $claveCifrada = password_hash($clave, PASSWORD_BCRYPT);
            $this->model->addUser($usuario, $mail, $claveCifrada);
            $this->view->showLogin();
        }
    }
}