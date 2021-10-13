<?php

require_once('./libs/smarty/libs/Smarty.class.php');

class ProductView{

    private $smarty;
    private $moneda;

    function __construct(){
        $this->smarty = new Smarty();
        $this->moneda = '$';
    }

    function showHome($sessiON=false, $alert='', $user=''){
        $this->smarty->assign('sessiON', $sessiON);
        $this->smarty->assign('alert', $alert);
        $this->smarty->assign('user', $user);
        $this->smarty->display('./templates/home.tpl');
    }

    function mostrarProductos($sessiON, $productos, $generos){
        //EN LA VARIABLE PRODUCTOS, ASIGNA $PRODUCTOS
        $this->smarty->assign('sessiON', $sessiON);
        $this->smarty->assign('productos', $productos);
        $this->smarty->assign('generos', $generos);
        $this->smarty->assign('moneda', $this->moneda);
        $this->smarty->display('./templates/tablaProductos.tpl');
        //LA MAS LINDA
    }

    function mostrarProducto($sessiON, $producto, $generos){
        $this->smarty->assign('sessiON', $sessiON);
        $this->smarty->assign('producto', $producto);
        $this->smarty->assign('generos', $generos);
        $this->smarty->assign('moneda', $this->moneda);
        $this->smarty->display('./templates/productoEspecifico.tpl');
    }

    function mostrarProductoPorGenero($sessiON, $tabla){
        $this->smarty->assign('sessiON', $sessiON);
        $this->smarty->assign('juegos', $tabla);
        $this->smarty->display('./templates/listaJuegos.tpl');
    }

    function mostrarCategorias($sessiON, $generos){
        $this->smarty->assign('sessiON', $sessiON);
        $this->smarty->assign('categorias', $generos);
        $this->smarty->display('./templates/categorias.tpl');
    }

    function showCatalogueLocation(){
        
        //REDIRECCIONA LA PAGINA UNA VEZ QUE LO CREA

        header("Location: ". BASE_URL. "catalogue");
    }

    function showHomeLocation(){
        header("Location: ". BASE_URL. "home");
    }

    function mostrarProductoParticular($id){
        header("Location: ". BASE_URL. "juegoEspecifico/".$id);
    }

    function showCategoriasLocation(){
        header("Location: ". BASE_URL. "categorias");

    }
    function showErrorCategoriasLocation(){
        header("Location: ". BASE_URL. "categorias");
    }

    function showLoginLocation(){
        header("Location: ". BASE_URL. "loginUser");
    }
}