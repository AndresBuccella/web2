<?php
require_once 'libs/Router.php';
//require_once 'Control/ApiUserController.php';
require_once 'Control/ApiCommentController.php';

$router = new Router();

/*
$router->addRoute('usuarios', 'GET', 'ApiUserController', 'getUsers');
$router->addRoute('usuario/:ID', 'GET', 'ApiUserController', 'getUser');
$router->addRoute('usuario', 'POST', 'ApiUserController', 'addUser');
$router->addRoute('usuario/:ID', 'DELETE', 'ApiUserController', 'deleteUser');
$router->addRoute('usuario/:ID', 'PUT', 'ApiUserController', 'updateLicense');
*/



$router->addRoute('comentarios/:ID', 'GET', 'ApiCommentController', 'getComments');
$router->addRoute('comentario', 'POST', 'ApiCommentController', 'addComment');
$router->addRoute('comentario/:ID', 'DELETE', 'ApiCommentController', 'deteleComment');
//$router->addRoute('comentario/:ID', 'GET', 'ApiCommentController', 'getComment');
//$router->addRoute('comentario/:ID', 'PUT', 'ApiCommentController', 'editComment');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
