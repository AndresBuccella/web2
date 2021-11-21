<?php

require_once 'ContentController.php';

class GenreController extends ContentController{

    function __construct(){
        parent::__construct();
    }
    
    function showCategories(){
        $sessiON = $this->authHelper->checkLoggedIn();
        $admin = $this->authHelper->admin();
        $genres = $this->genreModel->getGenres();
        $this->productView->showCategories($sessiON, $genres, '', $admin);

    }

    function createGenre(){
        $this->authHelper->checkPermission();
        $admin = $this->authHelper->admin();
        if ($admin) {
            $sessiON = true;
            $genres = $this->genreModel->getGenres();
            foreach ($genres as $genre) {
                if ($genre->genero == $_POST['genero']) {
                    $this->productView->showCategories($sessiON, $genres, 'Este genero ya existe', $admin);
                    return;
                }
            }
            $this->genreModel->addGenre($_POST['genero'], $_POST['descripcion_genero']);
            $this->productView->showCategories($sessiON, $genres, 'Creado con exito', $admin);
        }
        else{
            //mandar a login
        }
    }

    function editGenre(){
        $this->authHelper->checkPermission();
        $admin = $this->authHelper->admin();
        if ($admin) {
            $sessiON = true;
            $genres = $this->genreModel->getGenres();
            foreach ($genres as $genre) {
                if ($genre->genero == $_POST['genero']) {
                    $this->productView->showCategories($sessiON, $genres, 'Este genero ya existe', $admin);
                    return;
                }
            }
            $this->genreModel->updateGenre($_POST['genero'], $_POST['descripcion_genero'], $_POST['id_genero']);
            $this->productView->showCategories($sessiON, $genres, 'Genero actualizado', $admin);
        }else{

        }
    }

    function deteleGenre($id){
        $this->authHelper->checkPermission();
        $admin = $this->authHelper->admin();
        if ($admin) {
            $sessiON = true;
            $this->productModel->deleteProductByFk($id);
            $this->genreModel->deleteGenre($id);
            $genres =  $this->genreModel->getGenres();
            $this->productView->showCategories($sessiON, $genres, 'Genero actualizado', $admin);
        }
    }
}