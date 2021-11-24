<?php
require_once('LoginController.php');
require_once('Model/UserModel.php');
require_once('View/UserView.php');
require_once('View/GeneralView.php');
require_once('./Helpers/AuthHelper.php');

class UserController{

    private $loginController;
    private $userModel;
    private $userView;
    private $generalView;
    private $authHelper;

    function __construct(){
        $this->loginController = new LoginController();
        $this->userView = new UserView();
        $this->userModel = new UserModel();
        $this->generalView = new GeneralView();
        $this->authHelper = new AuthHelper();
    }

    
    function showSignUp(){
        $sessiON = $this->authHelper->checkLoggedIn();
        if (!$sessiON) {
            $this->userView->showSignUp();
        }
    }
    
    function showUsers(){
        $sessiON = $this->authHelper->checkLoggedIn();
        if ($sessiON) {
            $admin = $this->authHelper->admin($sessiON);
            if ($admin) {
                $users = $this->userModel->getUsers(); //solo un usuario puede ver los usuarios por lo que no tendria sentido comprobar la existencia
                $this->userView->showUsers($users, $admin, $sessiON);
            }else{
                $this->generalView->showLoginLocation();
            }
        }else{
            $this->generalView->showLoginLocation();
        }
    }
    
    function addUser(){
        
        $usuario = $_POST['usuario'];
        $mail = $_POST['mail'];
        $clave = $_POST['clave'];

        if ((isset($usuario)) && (isset($mail)) && (isset($clave))) {

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
        if (is_numeric($id)) {
            $sessiON = $this->authHelper->checkLoggedIn();
            if ($sessiON) {
                $admin = $this->authHelper->admin($sessiON);
                if ($admin) {
                    $user = $this->userModel->getUserById($id);
                    
                    if ($user) {
                        $this->userModel->deleteUser($id);
                    }
    
                    $users = $this->userModel->getUsers();
                    $this->userView->showUsers($users, $admin, $sessiON);
                }else{
                    $this->userView->showHome($sessiON);
                }
            }else{
                $this->generalView->showLoginLocation();
            }
        }else{
            $this->generalView->showLoginLocation();
        }
    }

    function updateLicense($id){
        if (is_numeric($id)) {
            $sessiON = $this->authHelper->checkLoggedIn();
            if ($sessiON) {
                $admin = $this->authHelper->admin($sessiON);

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
            }else{
                $this->generalView->showLoginLocation();
            }
        }else{
            $this->generalView->showLoginLocation();
        }
    }
}