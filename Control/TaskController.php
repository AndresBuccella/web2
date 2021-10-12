<?php
require_once './Model/TaskModel.php';
require_once './View/TaskView.php';
require_once './Helpers/AuthHelper.php';

class TaskController{


    private $model;
    private $view;
    private $authHelper;

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

    function mostrarCategorias(){
        $sessiON = $this->authHelper->checkLoggedIn();
        $generos = $this->model->traerGeneros();
        $this->view->mostrarCategorias($sessiON, $generos);

    }

    function mostrarProducto($id){
        $sessiON = $this->authHelper->checkLoggedIn();
        $producto = $this->model->traerProducto($id);
        $generos = $this->model->traerGeneros();
        $this->view->mostrarProducto($sessiON, $producto, $generos);
    }

    function mostrarProductoPorGenero($genero){
        $sessiON = $this->authHelper->checkLoggedIn();
        $tabla = $this->model->tablasUnidasFiltradasPorGenero($genero);
        $this->view->mostrarProductoPorGenero($sessiON, $tabla);
    }

    function crearProducto(){
        $this->authHelper->checkPermission();
        $tabla = $this->model->traerProductos();
        foreach ($tabla as $juego) {
            if (($juego->nombre == $_POST['nombre']) && ($juego->plataforma == $_POST['plataforma'])) {
                $this->view->showCatalogueLocation();
                return;
            }
        }
        $this->model->agregarProducto($_POST['nombre'], $_POST['precio'], $_POST['descripcion'], $_POST['plataforma'], $_POST['fk_id_genero']);
        $this->view->showCatalogueLocation();
    }


    function borrarProducto($id){
        $this->authHelper->checkPermission();
        $this->model->eliminarProducto($id);
        $this->view->showCatalogueLocation();
    }

    function editarProducto($id){
        $this->authHelper->checkPermission();
        $tabla = $this->model->traerProductos();
        foreach ($tabla as $juego) {
            if (($juego->nombre == $_POST['nombre']) && ($juego->plataforma == $_POST['plataforma'])) {
                $this->view->mostrarProductoParticular($id);
                return;
            }
        }
        //$this->model->actualizarProducto('Crash Bandicoot', '60', 'El animal que gira', 'Play', 1);
        $this->model->actualizarProducto($id, $_POST['nombre'], $_POST['precio'], $_POST['descripcion'], $_POST['plataforma'], $_POST['fk_id_genero']);
        
        $this->view->mostrarProductoParticular($id);
    }

    function crearGenero(){
        $this->authHelper->checkPermission();
        $tabla = $this->model->traerGeneros();
        foreach ($tabla as $genero) {
            if ($genero->genero == $_POST['genero']) {
                $this->view->showCategoriasLocation();
                return;
            }
        }
        $this->model->agregarGenero($_POST['genero'], $_POST['descripcion_genero']);
        $this->view->showCategoriasLocation();
    }

    function editarGenero(){
        $this->authHelper->checkPermission();
        $tabla = $this->model->traerGeneros();
        foreach ($tabla as $genero) {
            if ($genero->genero == $_POST['genero']) {
                $this->view->showErrorCategoriasLocation();
                return;
            }
        }
        $this->model->actualizarGenero($_POST['genero'], $_POST['descripcion_genero'], $_POST['id_genero']);
        $this->view->showCategoriasLocation();
    }
    function borrarGenero($id){
        $this->authHelper->checkPermission();
        $this->model->eliminarProductoFk($id);
        $this->model->eliminarGenero($id);
        $this->view->showCategoriasLocation();
    }
}




