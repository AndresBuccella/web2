<?php

class GeneralView{



    function __construct(){
        
    }


    function showLoginLocation(){
        header("Location: ". BASE_URL. "loginUser");
    }

    function showCatalogueLocation(){
        header("Location: ". BASE_URL. "catalogue");
    }

    function showHomeLocation(){
        header("Location: ". BASE_URL. "home");
    }

    function showSpecifiedProduct($id){
        header("Location: ". BASE_URL. "juegoEspecifico/".$id);
    }

    function showCategoriesLocation(){
        header("Location: ". BASE_URL. "categorias");
    }

}