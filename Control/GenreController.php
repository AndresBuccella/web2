<?php

require_once 'ContentController.php';

class GenreController extends ContentController{

    function __construct(){
        parent::__construct();
    }
    
    function showCategories(){
        $sessiON = $this->authHelper->checkLoggedIn();
        $admin = $this->authHelper->admin($sessiON);
        $genres = $this->genreModel->getGenres();
        $this->productView->showCategories($sessiON, $genres, '', $admin);

    }

    function createGenre(){
        $genero = $_POST['genero'];
        $descripcion_genero = $_POST['descripcion_genero'];
        if ((!empty($genero)) && (!empty($descripcion_genero))) {
            $sessiON = $this->authHelper->checkLoggedIn();
            if ($sessiON) {
                $admin = $this->authHelper->admin($sessiON);
                if ($admin) {
                    $genres = $this->genreModel->getGenres();
                    if (!empty($genres)) {
                        foreach ($genres as $genre) {
                            if ($genre->genero == $genero) {
                                $this->productView->showCategories($sessiON, $genres, 'Este genero ya existe', $admin);
                                return;
                            }
                        }
                    }
                    $this->genreModel->addGenre($genero, $descripcion_genero);
                    $genres = $this->genreModel->getGenres();
                    $this->productView->showCategories($sessiON, $genres, 'Creado con exito', $admin);
                }
                else{
                    $this->generalView->showLoginLocation();
                }
            }else{
                $this->generalView->showLoginLocation();
            }   
        }else{
            $this->generalView->showCategoriesLocation();
        }
    }

    function editGenre(){
        $genero = $_POST['genero'];
        $descripcion_genero = $_POST['descripcion_genero'];
        $id_genero = $_POST['id_genero'];
        if ((!empty($genero)) && (!empty($descripcion_genero)) && (!empty($id_genero))) {
            $sessiON = $this->authHelper->checkLoggedIn();
            if ($sessiON) {
                $admin = $this->authHelper->admin($sessiON);
                if ($admin) {
                    $genres = $this->genreModel->getGenres();
                    if (!empty($genres)){
                        foreach ($genres as $genre) {
                            if ($genre->genero == $genero) {
                                $this->productView->showCategories($sessiON, $genres, 'Este genero ya existe', $admin);
                                return;
                            }
                        }
                        $this->genreModel->updateGenre($genero, $descripcion_genero, $id_genero);
                        $genres = $this->genreModel->getGenres();
                        $this->productView->showCategories($sessiON, $genres, 'Genero actualizado', $admin);
                    }else {
                        $this->generalView->showCategoriesLocation();
                    }
                }else{
                    $this->generalView->showLoginLocation();
                }
            }else{
                $this->generalView->showLoginLocation();
            }
        }else{
            $this->generalView->showCategoriesLocation();
        }
    }

    function deteleGenre($id){
        if (is_numeric($id)) {
            $sessiON = $this->authHelper->checkLoggedIn();
            if ($sessiON) {
                $admin = $this->authHelper->admin($sessiON);
                if ($admin) {
                    $genre =  $this->genreModel->getGenre($id);
                    if (!empty($genre)) {
                        $this->productModel->deleteProductByFk($id);
                        $this->genreModel->deleteGenre($id);
                        $genres =  $this->genreModel->getGenres();
                        $this->productView->showCategories($sessiON, $genres, 'Genero actualizado', $admin);
                    }else {
                        $this->generalView->showCategoriesLocation();
                    }
                }else{
                    $this->generalView->showLoginLocation();
                }
            }else{
                $this->generalView->showLoginLocation();
            }
        }else {
            $this->generalView->showCategoriesLocation();
        }
    }
}