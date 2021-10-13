<?php

require_once 'ContentController.php';

class GenreController extends ContentController{

    function __construct(){
        parent::__construct();
    }
    
    function mostrarCategorias(){
        $sessiON = $this->authHelper->checkLoggedIn();
        $generos = $this->genreModel->traerGeneros();
        $this->view->mostrarCategorias($sessiON, $generos);

    }

    function crearGenero(){
        $this->authHelper->checkPermission();
        $tabla = $this->genreModel->traerGeneros();
        foreach ($tabla as $genero) {
            if ($genero->genero == $_POST['genero']) {
                $this->view->showCategoriasLocation();
                return;
            }
        }
        $this->genreModel->agregarGenero($_POST['genero'], $_POST['descripcion_genero']);
        $this->view->showCategoriasLocation();
    }

    function editarGenero(){
        $this->authHelper->checkPermission();
        $tabla = $this->genreModel->traerGeneros();
        foreach ($tabla as $genero) {
            if ($genero->genero == $_POST['genero']) {
                $this->view->showErrorCategoriasLocation();
                return;
            }
        }
        $this->genreModel->actualizarGenero($_POST['genero'], $_POST['descripcion_genero'], $_POST['id_genero']);
        $this->view->showCategoriasLocation();
    }

    function borrarGenero($id){
        $this->authHelper->checkPermission();
        $this->productModel->eliminarProductoFk($id);
        $this->genreModel->eliminarGenero($id);
        $this->view->showCategoriasLocation();
    }
}