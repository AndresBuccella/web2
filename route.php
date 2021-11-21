<?php

require_once('Control/ContentController.php');
require_once('Control/ProductController.php');
require_once('Control/GenreController.php');
require_once('Control/LoginController.php');
require_once('Control/UserController.php');
//require_once('Control/SingUpController.php');

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

if (!empty($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = 'home';
}


$params = explode('/', $action);
$contentController = new ContentController();
$productController = new ProductController();
$genreController = new GenreController();
$loginController = new LoginController();
$userController = new UserController();




switch ($params[0]){
    //USERS
    case 'signUp':
        $userController->showSignUp();
        break;
    case 'addUser':
        $userController->addUser();
        break;
    case 'deleteUser':
        $userController->deleteUser($params[1]);
        break;
    case 'logout':
        $loginController->logout();
        break;
    case 'loginUser':
        $loginController->showLogin();
        break;
    case 'verifyLogin':
        $loginController->verifyLogin();
        break;
    case 'users':
        $userController->showUsers();
        break;
    case 'deleteUser':
        $userController->deleteUser($params[1]);
        break;
    case 'updateLicense':
        $userController->updateLicense($params[1]);
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