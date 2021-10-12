<?php

require_once('Control/ContentController.php');
require_once('Control/ProductController.php');
require_once('Control/GenreController.php');
require_once('Control/LoginController.php');
require_once('Control/SingUpController.php');

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

if (!empty($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = 'catalogue';
}


$params = explode('/', $action);
$contentController = new ContentController();
$productController = new ProductController();
$genreController = new GenreController();
$loginController = new LoginController();

$singupController = new SingUpController();


switch ($params[0]){
    case 'logout':
        $userController->logout();
        break;
    case 'singUp':
        $singupController->singUp();
        break;
    case 'verifySingup':
        $singupController->verifySingUp();
        break;
    case 'loginUser':
        $userController->login();
        break;
    case 'verifyLogin':
        $userController->verifyLogin();
        break;
    //HOME
    case 'home':
        $contentController->showHome();
        break;
    //CATALOGO
    case 'juegoEspecifico':
        //VER SI PUEDO IMPLEMENTAR EL $VARIABLE = null/''
        if(is_numeric($params[1])){
            $productController->mostrarProducto($params[1]);
        }else{
            $productController->editarProducto($params[2]);
        }
        break;
    case 'categorias':
        if (empty($params[1])) {
            $genreController->mostrarCategorias();
        }else{
            $productController->mostrarProductoPorGenero($params[1]);
        }
        break;
    case 'catalogue':
        $contentController->showCatalogue();
        break;
    case 'productController':
        $productController->crearProducto();
        break;
    case 'productController':
        $productController->borrarProducto($params[1]);
        break;
    case 'crearGenero':
        $genreController->crearGenero();
        break;
    case 'borrarGenero':
        $genreController->borrarGenero($params[1]);
        break;
    case 'editarGenero':
        $genreController->editarGenero();
        break;
    default: 
        echo('404 Page not found'); 
        break;
                                            
}