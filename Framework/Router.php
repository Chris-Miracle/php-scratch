<?php

namespace Framework;

use App\Controllers\ErrorController;
use Framework\Middleware\Authorize;

class Router
{
    protected $routes = [];


    /**
     * Registers a new route in the application's routing table.
     *
     * @param string $method The HTTP method for the route (e.g. 'GET', 'POST', 'PUT', 'DELETE').
     * @param string $uri The URI pattern for the route.
     * @param string $action The controller/handler for the route.
     * @param array $middleware
     * @return void
     */
    public function registerRoute($method, $uri, $action, $middleware = [])
    {
        list($controller, $controllerMethod) = explode('@', $action);

        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod,
            'middleware' => $middleware
        ];
    }

    /**
     * Add a get rooute
     * 
     * @param string $uri
     * @param string $controller
     * @param array $middleware
     * @return void
     */

    public function get($uri, $controller, $middleware = [])
    {
        $this->registerRoute('GET', $uri, $controller, $middleware);
    }

    /**
     * Add a post rooute
     * 
     * @param string $uri
     * @param string $controller
     * @param array $middleware
     * @return void
     */

    public function post($uri, $controller, $middleware = [])
    {
        $this->registerRoute('POST', $uri, $controller, $middleware);
    }

    /**
     * Add a put rooute
     * 
     * @param string $uri
     * @param string $controller
     * @param array $middleware
     * @return void
     */

    public function put($uri, $controller, $middleware = [])
    {
        $this->registerRoute('PUT', $uri, $controller, $middleware);
    }

    /**
     * Add a delete rooute
     * 
     * @param string $uri
     * @param string $controller
     * @param array $middleware
     * @return void
     */

    public function delete($uri, $controller, $middleware = [])
    {
        $this->registerRoute('DELETE', $uri, $controller, $middleware);
    }

    /**
     * Route the request
     * 
     * @param string $uiri
     * @param string $method
     * @return void
     */

    public function route($uri)
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Check for _method input
        if ($requestMethod === 'POST' && isset($_POST['_method'])) {
            $requestMethod = strtoupper($_POST['_method']);
        }

        foreach ($this->routes as $route) {
            // Split the current URI into segments
            $uriSegments = explode('/', trim($uri, '/'));

            // Split the route URI into segments
            $routeSegments = explode('/', trim($route['uri'], '/'));

            // Compare the URI segments against the route segments
            $match =  true;

            //Check if the number of segments match
            if (count($uriSegments) === count($routeSegments) && strtoupper($route['method'] === $requestMethod)) {
                $params = [];

                $match = true;

                for ($i = 0; $i < count($uriSegments); $i++) {
                    // If the uri's do not match and there is no param
                    if ($routeSegments[$i] !== $uriSegments[$i] && !preg_match('/\{(.+?)\}/', $routeSegments[$i])) {
                        $match = false;
                        break;
                    }

                    // Check for the param and add it to the params array
                    if (preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
                        $params[$matches[1]] = $uriSegments[$i];
                    }
                }

                if ($match) {
                    // Check if the route has middleware
                    foreach ($route['middleware'] as $middleware) {
                        (new Authorize())->handle($middleware);
                    }
                    
                    $controller = 'App\\Controllers\\' . $route['controller'];
                    $controllerMethod = $route['controllerMethod'];

                    // Instantiate the controller and call the controller method
                    $controllerInstance = new $controller();
                    $controllerInstance->$controllerMethod($params);

                    return;
                }
            }
        }

        ErrorController::notFound();
    }
}
