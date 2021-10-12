<?php
require_once './Model/TaskModel.php';
require_once './View/TaskView.php';
require_once './Helpers/AuthHelper.php';

class ContentController{


    protected $model;
    protected $view;
    protected $authHelper;

    function __construct(){
        $this->model = new TaskModel();
        $this->view = new TaskView();
        $this->authHelper = new AuthHelper();
    }
    
    function showHome(){
        $sessiON = $this->authHelper->checkLoggedIn();
        $this->view->showHome($sessiON);
    }
    
    function showCatalogue(){
        $sessiON = $this->authHelper->checkLoggedIn();
        $tabla = $this->model->tablasUnidas();
        $generos = $this->model->traerGeneros();
        $this->view->mostrarProductos($sessiON, $tabla, $generos);
    }

    

}




