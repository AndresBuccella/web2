<?php

require_once('Control/ContentController.php');
require_once('Control/ProductController.php');
require_once('Control/GenreController.php');
require_once('Control/LoginController.php');
//require_once('Control/SingUpController.php');

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

//$singupController = new SingUpController();


switch ($params[0]){
    case 'logout':
        $loginController->logout();
        break;
    case 'loginUser':
        $loginController->showLogin();
        break;
    case 'verifyLogin':
        $loginController->verifyLogin();
        break;

    //HOME
    case 'home':
        $contentController->showHome();
        break;
    //CATALOGO
    case 'juegoEspecifico':
        $productController->showProduct($params[1]);
        break;
    case 'editarProducto':
        $productController->editProduct($params[1]);
        break;
    case 'categorias':
        if (empty($params[1])) {
            $genreController->showCategories();
        }else{
            $productController->showProductByGenre($params[1]);
        }
        break;

    case 'catalogue':
        $contentController->showCatalogue();
        break;
    case 'crearProducto':
        $productController->createProduct();
        break;
    case 'borrarProducto':
        $productController->deleteProduct($params[1]);
        break;
    case 'crearGenero':
        $genreController->createGenre();
        break;
    case 'borrarGenero':
        $genreController->deteleGenre($params[1]);
        break;
    case 'editarGenero':
        $genreController->editGenre();
        break;
    default: 
        echo('404 Page not found'); 
        break;
                                            
}