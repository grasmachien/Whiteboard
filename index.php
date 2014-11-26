<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

define('DS', DIRECTORY_SEPARATOR);
define('WWW_ROOT', __DIR__ . DS);

$routes = array(
    'home' => array(
        'controller' => 'Projects',
        'action' => 'index'
    ),
    'login-register' => array(
    	'controller' => 'Users',
    	'action' => 'loginregister'
	),
	'logout' => array(
    	'controller' => 'Users',
    	'action' => 'logout'
	),
);

if(empty($_GET['page'])) {
    $_GET['page'] = 'home';
}


if (empty($_SESSION["user"]) && $_GET["page"] != "login-register") {
    header("Location:index.php?page=login-register");
    exit();
}

if(empty($routes[$_GET['page']])) {
    header('Location: index.php');
    exit();
}

$route = $routes[$_GET['page']];
$controllerName = $route['controller'] . 'Controller';

require_once WWW_ROOT . 'controller' . DS . $controllerName . ".php";

$controllerObj = new $controllerName();
$controllerObj->route = $route;
$controllerObj->filter();
$controllerObj->render();