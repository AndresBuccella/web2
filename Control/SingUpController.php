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

    function singUp(){
        $users = $this->model->getUsers();
        foreach ($$users as $user) {
            if (($user->usuario != $_POST['usuario']) && ($user->mail != $_POST['mail'])) {
                $this->view->showSingUpLocation();
                return;
            }
        }
        $this->model->addUser($_POST['usuario'], $_POST['mail'], $_POST['clave']);
        $this->view->showHomeLocation();
    }
}