<?php


require_once('Model/UserModel.php');
require_once('Model/CommentModel.php');
//require_once('View/SingUpView.php');


require_once('View/ApiView.php');

class ApiCommentController{


    private $userModel;
    private $commentModel;
    //private $view;
    private $viewApi;


    function __construct(){
        $this->userModel = new UserModel();
        $this->commentModel = new CommentModel();
        //$this->view = new SingUpView();
        $this->viewApi = new ApiView();
        
    }


    private function getBody(){
        $bodyString = file_get_contents("php://input");
        return json_decode($bodyString);
    }

    function addComment(){
        $body = $this->getBody();
        if (isset($body)) {
            $this->commentModel->addComment($body->comment, $body->score,  $body->fk_usuario, $body->fk_producto);
            $this->viewApi->response("Comentario agregado con éxito", 200);
        }else{
            $this->viewApi->response("Ingrese los datos, por favor", 404);
        }
    }

    function getComments(){
        $body = $this->getBody();
        if (isset($body)){
            $comments = $this->commentModel->getComments($body->fk_producto);
            if (empty($comments)) {
                $this->viewApi->response("No se han registrado comentarios", 204);
            }else{
                return $this->viewApi->response($comments, 200);
            }
        }
    }


    function deteleComment($params = []) {
        if (!empty($params)) {
            $id = $params[':ID'];
            $comment = $this->commentModel->getComment($id);

            if (isset($comment)) { //compruebo la existencia por si otro admin lo borro y no se acualizo en la pagina que veo
                print_r('hola');
                $this->commentModel->deleteComment($id);
                $this->viewApi->response("Comentario id=$id eliminado con éxito", 200);
            }
            else{
                $this->viewApi->response("Comentario id=$id not found", 404);
            }
        }
    }


















/*
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