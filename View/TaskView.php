<?php

require_once('./libs/smarty/libs/Smarty.class.php');

class TaskView{

    private $smarty;
    private $moneda;

    function __construct(){
        $this->smarty = new Smarty();
        $this->moneda = '$';
    }

    function mostrarProductos($productos, $generos){
        //EN LA VARIABLE PRODUCTOS, ASIGNA $PRODUCTOS
        $this->smarty->assign('productos', $productos);
        $this->smarty->assign('generos', $generos);
        $this->smarty->assign('moneda', $this->moneda);
        $this->smarty->display('./templates/tablaProductos.tpl');
        //LA MAS LINDA
    }

    function mostrarProducto($producto, $generos){
        $this->smarty->assign('producto', $producto);
        $this->smarty->assign('generos', $generos);
        $this->smarty->assign('moneda', $this->moneda);
        $this->smarty->display('./templates/productoEspecifico.tpl');
    }

    function mostrarProductoPorGenero($tabla){
        $this->smarty->assign('juegos', $tabla);
        $this->smarty->display('./templates/listaJuegos.tpl');
    }

    function mostrarCategorias($generos){
        $this->smarty->assign('categorias', $generos);
        $this->smarty->display('./templates/categorias.tpl');
    }

    
   /* function mostrarProductos($producto, $genero){
        //LA PEOR SOLUCION, PERO TIENEN EL MISMO NOMBRE
        echo '<ul>';
        foreach($productos as $producto){
            echo ' <li> '. $producto->nombre . ' ' . $producto->precio . ' ' . $producto->descripcion . ' ' . $producto->plataforma;
            foreach ($generos as $genero) {
                if ($producto->fk_id_genero == $genero->id_genero){
                    echo ' ' . $genero->nombre . ' ' . $genero->descripcion . '</li>';
                }else{
                    echo '</li>';
                }
             }
        }
        echo '</ul>';
    }*/


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
}