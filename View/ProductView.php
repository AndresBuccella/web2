<?php

require_once('./libs/smarty/libs/Smarty.class.php');

class ProductView{

    private $smarty;
    private $currency;

    function __construct(){
        $this->smarty = new Smarty();
        $this->currency = '$';
    }

    function showHome($sessiON=false, $alert='', $user=''){
        $this->smarty->assign('sessiON', $sessiON);
        $this->smarty->assign('alert', $alert);
        $this->smarty->assign('user', $user);
        $this->smarty->display('./templates/home.tpl');
    }

    function showProducts($sessiON, $product, $genres){
        //EN LA VARIABLE PRODUCTOS, ASIGNA $PRODUCTOS
        $this->smarty->assign('sessiON', $sessiON);
        $this->smarty->assign('productos', $product);
        $this->smarty->assign('generos', $genres);
        $this->smarty->assign('moneda', $this->currency);
        $this->smarty->display('./templates/tablaProductos.tpl');
        //LA MAS LINDA
    }

    function showProduct($sessiON, $product, $genres){
        $this->smarty->assign('sessiON', $sessiON);
        $this->smarty->assign('producto', $product);
        $this->smarty->assign('generos', $genres);
        $this->smarty->assign('moneda', $this->currency);
        $this->smarty->display('./templates/productoEspecifico.tpl');
    }

    function showProductByGenre($sessiON, $table){
        $this->smarty->assign('sessiON', $sessiON);
        $this->smarty->assign('juegos', $table);
        $this->smarty->display('./templates/listaJuegos.tpl');
    }

    function showCategories($sessiON, $genres, $error = ''){
        $this->smarty->assign('sessiON', $sessiON);
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