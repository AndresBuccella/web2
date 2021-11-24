<?php
require_once 'ContentController.php';
require_once './Model/CommentModel.php';

class ProductController extends ContentController{

    private $commentModel;

    function __construct(){
        parent::__construct();
        $this->commentModel = new CommentModel();
    }

    function showProduct($id){
        $sessiON = $this->authHelper->checkLoggedIn();
        $admin = $this->authHelper->admin($sessiON);
        $product = $this->productModel->getProduct($id);
        if (!empty($product)) {
            $genres = $this->genreModel->getGenres();//si existe el producto, es porque existe el genero
            $this->productView->showProduct($sessiON, $product, $genres, $admin);
        }else{
            $this->productView->showCatalogueLocation();
        }
    }

    function showProductByGenre($id){
        $sessiON = $this->authHelper->checkLoggedIn();
        $admin = $this->authHelper->admin($sessiON);
        $table = $this->productModel->getProductsByGenre($id);
        if (!empty($table)) {
            $genre = $this->genreModel->getGenre($id);
            $this->productView->showProductByGenre($sessiON, $table, $genre, $admin);
        }else{
            $this->productView->showCategoriesLocation();
        }
    }

    function createProduct(){
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $plataforma = $_POST['plataforma'];
        $fk_id_genero = $_POST['fk_id_genero'];
        if ((!empty($nombre) && !empty($precio) && !empty($descripcion) && !empty($plataforma) && !empty($fk_id_genero))) {
            $sessiON = $this->authHelper->checkLoggedIn();
            if ($sessiON) {
                $admin = $this->authHelper->admin($sessiON);
                if ($admin) {
                    $table = $this->productModel->getProducts();
                    if (!empty($table)) {
                        foreach ($table as $game) {
                            if (($game->nombre == $nombre) && ($game->plataforma == $plataforma)) {
                                $this->productView->showCatalogueLocation();
                                return;
                            }
                        }
                        $this->productModel->addProduct($nombre, $precio, $descripcion, $plataforma, $fk_id_genero);
                        $this->productView->showCatalogueLocation();
                    }
                }else{
                    $this->productView->showLoginLocation();
                }
            }else{
                $this->productView->showLoginLocation();
            }
        }else{
            $this->productView->showCatalogueLocation();
        }
    }


    function deleteProduct($id){
        if (is_numeric($id)) {
            $sessiON = $this->authHelper->checkLoggedIn();
            if ($sessiON) {
                $admin = $this->authHelper->admin($sessiON);
                if ($admin) {
                    $producto = $this->productModel->getProduct($id);
                    if (!empty($producto)) {
                        $this->commentModel->deleteComments($id);
                        $this->productModel->deleteProduct($id);
                        $this->productView->showCatalogueLocation();
                    }else{
                        $this->productView->showCatalogueLocation();
                    }
                }else{
                    $this->productView->showLoginLocation();
                }
            }else{
                $this->productView->showLoginLocation();
            }
        }else{
            $this->productView->showLoginLocation();
        }
    }

    function editProduct($id){
        if (is_numeric($id)) {
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $descripcion = $_POST['descripcion'];
            $plataforma = $_POST['plataforma'];
            $fk_id_genero = $_POST['fk_id_genero'];
            if ((!empty($nombre) && !empty($precio) && !empty($descripcion) && !empty($plataforma) && !empty($fk_id_genero))) {
                $sessiON = $this->authHelper->checkLoggedIn();
                if ($sessiON) {
                    $admin = $this->authHelper->admin($sessiON);
                    if ($admin) {
                        $producto = $this->productModel->getProduct($id);
                        if (!empty($producto)) {
                            $this->productModel->updateProduct($id, $nombre, $precio, $descripcion, $plataforma, $fk_id_genero);
                            $this->productView->showSpecifiedProduct($id);
                        }else{
                            $this->productView->showCatalogueLocation();
                        }
                    }else{
                        $this->productView->showLoginLocation();
                    }
                }else{
                    $this->productView->showLoginLocation();
                }
            }else{
                $this->productView->showSpecifiedProduct($id);
            }
        }else{
            $this->productView->showLoginLocation();
        }
    }

}