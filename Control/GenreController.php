<?php

require_once 'ContentController.php';

class GenreController extends ContentController{

    function __construct(){
        parent::__construct();
    }
    
    function showCategories(){
        $sessiON = $this->authHelper->checkLoggedIn();
        $genres = $this->genreModel->getGenres();
        $this->productView->showCategories($sessiON, $genres);

    }

    function createGenre(){
        $this->authHelper->checkPermission();
        $sessiON = true;
        $genres = $this->genreModel->getGenres();
        foreach ($genres as $genre) {
            if ($genre->genero == $_POST['genero']) {
                $this->productView->showCategories($sessiON, $genres, 'Este genero ya existe');
                return;
            }
        }
        $this->genreModel->addGenre($_POST['genero'], $_POST['descripcion_genero']);
        $this->productView->showCategoriesLocation();
    }

    function editGenre(){
        $this->authHelper->checkPermission();
        $sessiON = true;
        $genres = $this->genreModel->getGenres();
        foreach ($genres as $genre) {
            if ($genre->genero == $_POST['genero']) {
                $this->productView->showCategories($sessiON, $genres, 'Este genero ya existe');
                return;
            }
        }
        $this->genreModel->updateGenre($_POST['genero'], $_POST['descripcion_genero'], $_POST['id_genero']);
        $this->productView->showCategoriesLocation();
    }

    function deteleGenre($id){
        $this->authHelper->checkPermission();
        $this->productModel->deleteProductByFk($id);
        $this->genreModel->deleteGenre($id);
        $this->productView->showCategoriesLocation();
    }
}