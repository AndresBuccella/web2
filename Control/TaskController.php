<?php
require_once './Model/TaskModel.php';
require_once './View/TaskView.php';

class TaskController{


    private $model;
    private $view;

    function __construct(){
        $this->model = new TaskModel();
        $this->view = new TaskView();
    }
    

    function showHome(){

    }
    
    function showCatalogue(){
        $tabla = $this->model->tablasUnidas();
        $generos = $this->model->traerGeneros();
        $this->view->mostrarProductos($tabla, $generos);
    }

    function mostrarCategorias(){
        $generos = $this->model->traerGeneros();
        $this->view->mostrarCategorias($generos);

    }

    function mostrarProducto($id){
        $producto = $this->model->traerProducto($id);
        $generos = $this->model->traerGeneros();
        $this->view->mostrarProducto($producto, $generos);
    }

    function mostrarProductoPorGenero($genero){
        $tabla = $this->model->tablasUnidasFiltradasPorGenero($genero);
        $this->view->mostrarProductoPorGenero($tabla);
    }

    function crearProducto(){
        print_r($_POST);
        $this->model->agregarProducto($_POST['nombre'], $_POST['precio'], $_POST['descripcion'], $_POST['plataforma'], $_POST['fk_id_genero']);
        $this->view->showCatalogueLocation();
    }

    function borrarProducto($id){
        $this->model->eliminarProducto($id);
        $this->view->showCatalogueLocation();
    }

    function editarProducto($id){
        //$this->model->actualizarProducto('Crash Bandicoot', '60', 'El animal que gira', 'Play', 1);
        $this->model->actualizarProducto($id, $_POST['nombre'], $_POST['precio'], $_POST['descripcion'], $_POST['plataforma'], $_POST['fk_id_genero']);
        
        $this->view->mostrarProductoParticular($id);
    }

    function crearGenero(){
        $this->model->agregarGenero($_POST['genero'], $_POST['descripcion_genero']);
        $this->view->showCatalogueLocation();
    }

    function editarGenero(){
        $this->model->actualizarGenero($_POST['genero'], $_POST['descripcion_genero'], $_POST['id_genero']);
        $this->view->showCategoriasLocation();
    }
    function borrarGenero($id){
        $this->model->eliminarProductoFk($id);
        $this->model->eliminarGenero($id);
        $this->view->showCategoriasLocation();
    }
}