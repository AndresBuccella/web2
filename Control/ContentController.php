<?php
require_once './Model/ProductModel.php';
require_once './Model/GenreModel.php';
require_once './View/GeneralView.php';
require_once './View/UserView.php';
require_once './View/ProductView.php';
require_once './Helpers/AuthHelper.php';

class ContentController{


    protected $productModel;
    protected $genreModel;
    protected $generalView;
    protected $userView;
    protected $productView;
    protected $authHelper;

    function __construct(){
        $this->productModel = new ProductModel();
        $this->genreModel = new GenreModel();
        $this->productView = new ProductView();
        $this->generalView = new GeneralView();
        $this->userView = new UserView();
        $this->authHelper = new AuthHelper();
    }
    
    function showHome(){
        $sessiON = $this->authHelper->checkLoggedIn();
        $this->productView->showHome($sessiON);
    }
    
    function showCatalogue(){
        $sessiON = $this->authHelper->checkLoggedIn();
        $admin = $this->authHelper->admin($sessiON);
        $table = $this->productModel->joinedTables();
        $genres = $this->genreModel->getGenres();
        if ((!empty($table)) && (!empty($genres))) {
            $this->productView->showProducts($sessiON, $table, $genres, $admin);
        }
    }

    

}




