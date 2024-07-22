<?php

require __DIR__ . '/../vendor/autoload.php';
require "../helper.php";

use Framework\Router;
use Framework\Session;

// Start the session
Session::start();

// Instantiating the rouuter
$router = new Router();

// Loading the routes
$routes = require getBasePath('routes.php');

// get the uri and method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Route the request
$router->route($uri);
