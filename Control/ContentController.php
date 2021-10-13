<?php
require_once './Model/ProductModel.php';
require_once './Model/GenreModel.php';
require_once './View/ProductView.php';
require_once './Helpers/AuthHelper.php';

class ContentController{


    protected $productModel;
    protected $genreModel;
    protected $view;
    protected $authHelper;

    function __construct(){
        $this->productModel = new ProductModel();
        $this->genreModel = new GenreModel();
        $this->view = new ProductView();
        $this->authHelper = new AuthHelper();
    }
    
    function showHome(){
        $sessiON = $this->authHelper->checkLoggedIn();
        $this->view->showHome($sessiON);
    }
    
    function showCatalogue(){
        $sessiON = $this->authHelper->checkLoggedIn();
        $tabla = $this->productModel->tablasUnidas();
        $generos = $this->genreModel->traerGeneros();
        $this->view->mostrarProductos($sessiON, $tabla, $generos);
    }

    

}




