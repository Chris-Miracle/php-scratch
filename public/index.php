<?php

require __DIR__. '/../vendor/autoload.php';
require "../helper.php";

// spl_autoload_register(function ($class) {
//     $path = getBasePath('Framework/' . $class . '.php');
//     if (file_exists($path)) {
//         require $path;
//     }
// });

// Instantiating the rouuter
$router = new Router();

// Loading the routes
$routes = require getBasePath('routes.php');

// get the uri and method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Route the request
$router->route($uri, $method);
