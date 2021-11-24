<?php

require_once('./libs/smarty-3.1.39/libs/Smarty.class.php');

class ProductView{

    private $smarty;
    private $currency;

    function __construct(){
        $this->smarty = new Smarty();
        $this->currency = '$';
    }

    function showHome($sessiON=false, $alert='', $user='', $admin = false){
        $this->smarty->assign('sessiON', $sessiON);
        $this->smarty->assign('alert', $alert);
        $this->smarty->assign('user', $user);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('./templates/home.tpl');
    }

    function showProducts($sessiON, $products, $genres, $admin = false){
        //EN LA VARIABLE PRODUCTOS, ASIGNA $PRODUCTOS
        $this->smarty->assign('sessiON', $sessiON);
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('productos', $products);
        $this->smarty->assign('generos', $genres);
        $this->smarty->assign('moneda', $this->currency);
        $this->smarty->display('./templates/tablaProductos.tpl');
    }

    function showProduct($sessiON, $product, $genres, $admin = false){
        $this->smarty->assign('sessiON', $sessiON);
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('producto', $product);
        $this->smarty->assign('generos', $genres);
        $this->smarty->assign('moneda', $this->currency);
        $this->smarty->display('./templates/productoEspecifico.tpl');
    }

    function showProductByGenre($sessiON, $table, $genre, $admin = false){
        $this->smarty->assign('sessiON', $sessiON);
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('juegos', $table);
        $this->smarty->assign('genero', $genre);
        $this->smarty->display('./templates/listaJuegos.tpl');
    }

    function showCategories($sessiON, $genres, $error = '', $admin = false){
        $this->smarty->assign('sessiON', $sessiON);
        $this->smarty->assign('admin', $admin);
        $this->smarty->assign('categorias', $genres);
        $this->smarty->assign('error', $error);
        $this->smarty->display('./templates/categorias.tpl');
    }

    function showCatalogueLocation(){
        
        //REDIRECCIONA LA PAGINA UNA VEZ QUE LO CREA

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

    function showLoginLocation(){
        header("Location: ". BASE_URL. "loginUser");
    }
}