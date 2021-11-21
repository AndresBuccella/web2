<?php
require_once('LoginController.php');
require_once('Model/UserModel.php');
require_once('View/SingUpView.php');
require_once('View/UserView.php');
require_once('./Helpers/AuthHelper.php');

class UserController{

    private $loginController;
    private $userModel;
    private $userView;
    private $authHelper;

    function __construct(){
        $this->loginController = new LoginController();
        $this->userView = new UserView();
        $this->userModel = new UserModel();
        $this->viewSingUp = new SingUpView();
        $this->authHelper = new AuthHelper();
    }

    
    function showSignUp(){
        //no tendria que poder registrarse si esta logueado
        $this->userView->showSignUp();
    }
    
    function showUsers(){
        $this->authHelper->checkPermission();
        $sessiON = true;
        $admin = $this->authHelper->admin();
        if ($admin) {
            $sessiON = $admin;
            $users = $this->userModel->getUsers(); //solo un usuario puede ver los usuarios por lo que no tendria sentido comprobar la existencia
            $this->userView->showUsers($users, $admin, $sessiON);
        }else{
            //mandar a home
        }
        
        
        
        
    }
    
    /*function getUser($params = []){
        if (empty($params)) {
            $users = $this->userModel->getUsers();
            return $this->viewApi->response($users, 200);
        }else{
            $idUser = $params[":ID"];
            $user = $this->userModel->getUserById($idUser);
            if (!empty($user)) {
                return $this->viewApi->response($user, 200);
            }else{
                return $this->viewApi->response("Hola", 204);
            }
        }
    }*/
    


    function addUser(){
        
        if ((isset($_POST['usuario'])) && (isset($_POST['mail'])) && (isset($_POST['clave']))) {

            $usuario = $_POST['usuario'];
            $mail = $_POST['mail'];
            $clave = $_POST['clave'];

            $users = $this->userModel->getUsers();

            foreach ($users as $user) {
                if (($user->usuario == $usuario) || ($user->mail == $mail)) {
                    $this->view->showSingUp('El usuario y/o mail ya existen');
                    return;
                }
            }

            $claveCifrada = password_hash($clave, PASSWORD_BCRYPT);
            $this->userModel->addUser($usuario, $mail, $claveCifrada);
            $this->loginController->verifyLogin($usuario, $claveCifrada);

        }else{
            return $this->userView->showSignUp();
        }
    }



    function deleteUser($id) {
        $this->authHelper->checkPermission();
        $admin = $this->authHelper->admin();
        $sessiON = true;
        if ($admin) {
            if (($id > 0) && is_numeric($id)) {
                $user = $this->userModel->getUserById($id);
                
                if ($user) {
                    $this->userModel->deleteUser($id);
                }

                $users = $this->userModel->getUsers();
                $this->userView->showUsers($users, $admin, $sessiON);
            }
        }else{
            $this->userView->showHome($sessiON);
        }
    }

    function updateLicense($id){
        $this->authHelper->checkPermission();
        $admin = $this->authHelper->admin();
        $sessiON = true;

        $adminUser = 2;
        $normalUser = 1;
        

        if ($admin) {
            $user = $this->userModel->getUserById($id);
            if ($user->rol == 1) {
                $this->userModel->updateLicense($adminUser, $id);
            } else if ($user->rol == 2) {
                $this->userModel->updateLicense($normalUser, $id);
            }
            $users = $this->userModel->getUsers();
            $this->userView->showUsers($users, $admin, $sessiON);
        }else{
            $this->userView->showHome($sessiON);
        }

    }
 
    private function getBody(){
        $bodyString = file_get_contents("php://input");
        return json_decode($bodyString);
    }
/*
 NO HAY QUE EDITARLO PERO LO DEJO POR LAS DUDAS

    function updateUser($params = []){
        $id = $params[':ID'];
        $user = $this->userModel->getUser($id);

        $license = 'BUSCAR ALGUNA FORMA DE CARGAR';

        if ($user) {
            $this->userModel->updateLicense($license, $id);
            $this->viewApi->response("Usuario id=$id actualizado con éxito", 200);
        }else{
            $this->viewApi->response("User id=$id not found", 404);
        }

    }*/
}