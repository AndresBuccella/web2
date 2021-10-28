<?php
require_once 'libs/Router.php';
require_once 'Control/ApiUserController.php';

// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('usuario', 'GET', 'ApiUserController', 'getUsers');
$router->addRoute('usuario/:ID', 'GET', 'ApiUserController', 'getUser');
$router->addRoute('usuario', 'POST', 'ApiUserController', 'addUser');
$router->addRoute('usuario/:ID', 'DELETE', 'ApiUserController', 'deleteUser');
$router->addRoute('usuario/:ID', 'PUT', 'ApiUserController', 'updateLicense');








$router->addRoute('tareas', 'POST', 'ApiCommentController', 'addComment');
$router->addRoute('tareas/:ID', 'DELETE', 'ApiUserController', 'borrarTarea');

/*    case 'singUp':
        $singupController->singUp();
        break;
    case 'verifySingup':
        $singupController->verifySingUp();
        break;*/
// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
