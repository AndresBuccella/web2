<?php

require_once('Control/TaskController.php');
require_once('Control/LoginController.php');
require_once('Control/SingUpController.php');

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

if (!empty($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = 'catalogue';
}


$params = explode('/', $action);
$taskController = new TaskController();
$LoginController = new LoginController();
$SingUpController = new SingUpController();


switch ($params[0]){
    case 'singUp':
        $SingUpController->singUp();
        break;
    case 'verifySingup':
        $SingUpController->verifySingUp();
        break;
    case 'loginUser':
        $LoginController->login();
        break;
    case 'verifyLogin':
        $LoginController->verifyLogin();
        break;
    //HOME
    case 'home':
        $taskController->showHome();
        break;
    //CATALOGO
    case 'juegoEspecifico':
        //VER SI PUEDO IMPLEMENTAR EL $VARIABLE = null/''
        if(is_numeric($params[1])){
            $taskController->mostrarProducto($params[1]);
        }else{
            $taskController->editarProducto($params[2]);
        }
        break;
    case 'categorias':
        if (empty($params[1])) {
            $taskController->mostrarCategorias();
        }else{
            $taskController->mostrarProductoPorGenero($params[1]);
        }
        break;
    case 'catalogue':
        $taskController->showCatalogue();
        break;
    case 'crearProducto':
        $taskController->crearProducto();
        break;
    case 'borrarProducto':
        $taskController->borrarProducto($params[1]);
        break;
    case 'crearGenero':
        $taskController->crearGenero();
        break;
    case 'borrarGenero':
        $taskController->borrarGenero($params[1]);
        break;
    case 'editarGenero':
        $taskController->editarGenero();
        break;
    default: 
        echo('404 Page not found'); 
        break;
                                            
}
?>