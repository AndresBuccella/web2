<?php


require_once('Model/UserModel.php');
//require_once('View/SingUpView.php');


require_once('View/ApiView.php');

class ApiCommentController{


    private $model;
    //private $view;
    private $viewApi;


    function __construct(){
        $this->model = new UserModel();
        //$this->view = new SingUpView();
        $this->viewApi = new ApiView();
        
    }


    function getComments(){
        $comments = $this->model->getComments();
        if (empty($comments)) {
            $this->viewApi->response("No se han registrado usuarios", 204);
        }else{
            return $this->viewApi->response($users, 200);
        }
    }






















    function getUser($params = []){
        if (empty($params)) {
            $users = $this->model->getUsers();
            return $this->viewApi->response($users, 200);
        }else{
            $idUser = $params[":ID"];
            $user = $this->model->getUser($idUser);
            if (!empty($user)) {
                return $this->viewApi->response($user, 200);
            }else{
                return $this->viewApi->response("Hola", 204);
            }
        }
    }

    function addUser(){
        $body = $this->getBody();
        if ((!empty($body->user)) && (!empty($body->email)) && (!empty($body->password))) {
            $users = $this->model->getUsers();
            foreach ($users as $user) {
                if ($user->usuario == $body->user) {
                    return $this->viewApi->response("El usuario ya existe", 500);
                    //VER QUE CODIGO PONER
                }
                if ($user->mail == $body->email) {
                    return $this->viewApi->response("El email ya existe", 500);
                }
            }
            $id = $this->model->addUser($body->user, $body->email, $body->password);
            return $this->viewApi->response("El usuario con id=$id fue ingresado correctamente", 200);

        }else{
            return $this->viewApi->response("El usuario no se pudo registrar por falta de datos", 500);
        }
    }



    function deleteUser($params = []) {
        $id = $params[':ID'];
        $user = $this->model->getUser($id);

        if ($user) {
            $this->model->deleteUser($id);
            $this->viewApi->response("Usuario id=$id eliminado con éxito", 200);
        }
        else 
            $this->viewApi->response("User id=$id not found", 404);
    }

    function updateLicense($params = []){
        if (empty($params)) {
            $this->viewApi->response("Debe ingresar un id para editar el rol", 200);
        }else {
            $id = $params[':ID'];
            $user = $this->model->getUser($id);
    
            $license = $this->getBody();
    
            if ($user) {
                $this->model->updateLicense($license->rol, $id);
                $this->viewApi->response("Usuario id=$id actualizado con éxito", 200);
            }else{
                $this->viewApi->response("User id=$id not found", 404);
            }
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
        $user = $this->model->getUser($id);

        $license = 'BUSCAR ALGUNA FORMA DE CARGAR';

        if ($user) {
            $this->model->updateLicense($license, $id);
            $this->viewApi->response("Usuario id=$id actualizado con éxito", 200);
        }else{
            $this->viewApi->response("User id=$id not found", 404);
        }

    }*/
}
}