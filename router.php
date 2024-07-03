<?php

$routes = require getBasePath('routes.php');

if (array_key_exists($uri, $routes)) {
    require(getBasePath($routes[$uri]));
} else {
    http_response_code(404);
    require(getBasePath($routes['404']));
}