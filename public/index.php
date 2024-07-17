<?php

session_start();

use Framework\Router;

require __DIR__. '/../vendor/autoload.php';
require "../helper.php";

// Instantiating the rouuter
$router = new Router();

// Loading the routes
$routes = require getBasePath('routes.php');

// get the uri and method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Route the request
$router->route($uri);
