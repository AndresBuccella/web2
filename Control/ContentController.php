<?php
require_once './Model/ProductModel.php';
require_once './Model/GenreModel.php';
require_once './View/ProductView.php';
require_once './Helpers/AuthHelper.php';

class ContentController{


    protected $productModel;
    protected $genreModel;
    protected $productView;
    protected $authHelper;

    function __construct(){
        $this->productModel = new ProductModel();
        $this->genreModel = new GenreModel();
        $this->productView = new ProductView();
        $this->authHelper = new AuthHelper();
    }
    
    function showHome(){
        $sessiON = $this->authHelper->checkLoggedIn();
        $this->productView->showHome($sessiON);
    }
    
    function showCatalogue(){
        $sessiON = $this->authHelper->checkLoggedIn();
        $table = $this->productModel->joinedTables();
        $genres = $this->genreModel->getGenres();
        $this->productView->showProducts($sessiON, $table, $genres);
    }

    

}




