<?php

// enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// constants
define('DIR', __DIR__);

// load all classes
include_once "autoload.php";

Router::loadRoutes();

if ($_GET['path']) {
    $route = Router::match("/" . $_GET['path']);

    if ($route) {
        easyMVC::callAction($route['controller'], $route['action']);
    }
    else {
        throw new Exception("No Route for '".$_GET['path']."' found");
    }
}
else if ($_GET['controller'] && $_GET['action']) {
    easyMVC::callAction($_GET['controller'] . "Controller", $_GET['action'] . "Action");
}
else {
    throw new Exception("No Route found/given");
}

