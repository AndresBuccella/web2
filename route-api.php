<?php
require_once 'libs/Router.php';
require_once 'Control/ApiCommentController.php';

$router = new Router();

$router->addRoute('comentarios/:ID', 'GET', 'ApiCommentController', 'getComments');
$router->addRoute('comentario', 'POST', 'ApiCommentController', 'addComment');
$router->addRoute('comentario/:ID', 'DELETE', 'ApiCommentController', 'deteleComment');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
