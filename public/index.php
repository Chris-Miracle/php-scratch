<?php

require "../helper.php";
require getBasePath('Framework/Router.php');
require getBasePath('Framework/Database.php');

// Instanriating the rouuter
$router = new Router();

// Loading the routes
$routes = require getBasePath('routes.php');

// get the uri and method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Route the request
$router->route($uri, $method);