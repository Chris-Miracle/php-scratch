<?php

class Router
{
    protected $routes = [];

    
    /**
     * Registers a new route in the application's routing table.
     *
     * @param string $method The HTTP method for the route (e.g. 'GET', 'POST', 'PUT', 'DELETE').
     * @param string $uri The URI pattern for the route.
     * @param string $controller The controller/handler for the route.
     * @return void
     */
    public function registerRoute($method, $uri, $controller)
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
        ];
    }

    /**
     * Add a get rooute
     * 
     * @param string $uri
     * @param string $controller
     * @return void
     */

    public function get($uri, $controller)
    {
        $this->registerRoute('GET', $uri, $controller);
    }

    /**
     * Add a post rooute
     * 
     * @param string $uri
     * @param string $controller
     * @return void
     */

    public function post($uri, $controller)
    {
        $this->registerRoute('POST', $uri, $controller);
    }

    /**
     * Add a put rooute
     * 
     * @param string $uri
     * @param string $controller
     * @return void
     */

    public function put($uri, $controller)
    {
        $this->registerRoute('PUT', $uri, $controller);
    }

    /**
     * Add a delete rooute
     * 
     * @param string $uri
     * @param string $controller
     * @return void
     */

    public function delete($uri, $controller)
    {
        $this->registerRoute('DELETE', $uri, $controller);
    }

    /**
     * load error page
     * 
     * @param int $httpCode
     * 
     * @return void
     */

    public function error($httpCode = 404)
    {
        http_response_code($httpCode);
        loadView("error/{$httpCode}");
        exit;
    }


    /**
     * Route the request
     * 
     * @param string $uiri
     * @param string $method
     * @return void
     */

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] == $method && $route['uri'] == $uri) {
                require getBasePath('App/'.$route['controller']);
                return;
            }
        }

        $this->error();
    }
}
