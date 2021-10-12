<?php
require_once 'ContentController.php';

class ProductController extends ContentController{


    function __construct(){
        parent::__construct();
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
        $this->model->actualizarProducto($id, $_POST['nombre'], $_POST['precio'], $_POST['descripcion'], $_POST['plataforma'], $_POST['fk_id_genero']);
        
        $this->view->mostrarProductoParticular($id);
    }

}