<?php
require_once 'libs/Router.php';
require_once 'Control/ApiUserController.php';
require_once 'Control/ApiCommentController.php';

// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('usuarios', 'GET', 'ApiUserController', 'getUsers');
$router->addRoute('usuario/:ID', 'GET', 'ApiUserController', 'getUser');
$router->addRoute('usuario', 'POST', 'ApiUserController', 'addUser');
$router->addRoute('usuario/:ID', 'DELETE', 'ApiUserController', 'deleteUser');
$router->addRoute('usuario/:ID', 'PUT', 'ApiUserController', 'updateLicense');



$router->addRoute('comentarios', 'GET', 'ApiCommentController', 'getComments');
//$router->addRoute('comentario/:ID', 'GET', 'ApiCommentController', 'getComment');
$router->addRoute('comentario', 'POST', 'ApiCommentController', 'addComment');
$router->addRoute('comentario/:ID', 'DELETE', 'ApiCommentController', 'deteleComment');
//$router->addRoute('comentario/:ID', 'PUT', 'ApiCommentController', 'editComment');

/*    case 'singUp':
        $singupController->singUp();
        break;
    case 'verifySingup':
        $singupController->verifySingUp();
        break;*/
// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
