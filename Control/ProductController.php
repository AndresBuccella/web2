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
        $genres = $this->genreModel->getGenres();
        $this->productView->showProduct($sessiON, $product, $genres, $admin);
    }

    function showProductByGenre($id){
        $sessiON = $this->authHelper->checkLoggedIn();
        $admin = $this->authHelper->admin($sessiON);
        $table = $this->productModel->getProductsByGenre($id);
        $genre = $this->genreModel->getGenre($id);
        $this->productView->showProductByGenre($sessiON, $table, $genre, $admin);
    }

    function createProduct(){
        $this->authHelper->checkPermission();
        $sessiON = true;
        $admin = $this->authHelper->admin($sessiON);
        if ($admin) {
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
    }


    function deleteProduct($id){
        $this->authHelper->checkPermission();
        $sessiON = true;
        $admin = $this->authHelper->admin($sessiON);
        if ($admin) {
            $this->commentModel->deleteComments($id);
            $this->productModel->deleteProduct($id);
            $this->productView->showCatalogueLocation();
        }else{
            $this->productView->showLoginLocation();
        }
    }

    function editProduct($id){
        $this->authHelper->checkPermission();
        $sessiON = true;
        $admin = $this->authHelper->admin($sessiON);

        $name = $_POST['nombre'];
        $price = $_POST['precio'];
        $description = $_POST['descripcion'];
        $platform = $_POST['plataforma'];
        $fk_id_genero = $_POST['fk_id_genero'];

        if (($admin) && (isset($name)) && (isset($price)) && (isset($platform)) && (isset($fk_id_genero))) {
            $this->productModel->updateProduct($id, $name, $price, $description, $platform, $fk_id_genero);
            $this->productView->showSpecifiedProduct($id);
        }else{
            $this->productView->showLoginLocation();
        }
    }

}