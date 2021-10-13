<?php
require_once 'ContentController.php';

class ProductController extends ContentController{


    function __construct(){
        parent::__construct();
    }


    function showProduct($id){
        $sessiON = $this->authHelper->checkLoggedIn();
        $product = $this->productModel->getProduct($id);
        $genres = $this->genreModel->getGenres();
        $this->productView->showProduct($sessiON, $product, $genres);
    }

    function showProductByGenre($genre){
        $sessiON = $this->authHelper->checkLoggedIn();
        $table = $this->genreModel->tablesFilteredByGenre($genre);
        $this->productView->showProductByGenre($sessiON, $table);
    }

    function createProduct(){
        $this->authHelper->checkPermission();
        $table = $this->productModel->getProducts();
        foreach ($table as $game) {
            if (($game->nombre == $_POST['nombre']) && ($game->plataforma == $_POST['plataforma'])) {
                $this->productView->showCatalogueLocation();
                return;
            }
        }
        $this->productModel->addProduct($_POST['nombre'], $_POST['precio'], $_POST['descripcion'], $_POST['plataforma'], $_POST['fk_id_genero']);
        $this->productView->showCatalogueLocation();
    }


    function deleteProduct($id){
        $this->authHelper->checkPermission();
        $this->productModel->deleteProduct($id);
        $this->productView->showCatalogueLocation();
    }

    function editProduct($id){
        $this->authHelper->checkPermission();
        $this->productModel->updateProduct($id, $_POST['nombre'], $_POST['precio'], $_POST['descripcion'], $_POST['plataforma'], $_POST['fk_id_genero']);
        $this->productView->showSpecifiedProduct($id);
    }

}