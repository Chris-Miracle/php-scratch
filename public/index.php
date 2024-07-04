<?php

require "../helper.php";
require getBasePath('Router.php');
require getBasePath('Database.php');

// Instanriating the rouuter
$router = new Router();

// Loading the routes
$routes = require getBasePath('routes.php');

// get the uri and method
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Route the request
$router->route($uri, $method);