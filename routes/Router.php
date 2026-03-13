<?php

class Router {
    private $routes = [];

    public function add($path, $controller, $method) {
        $this->routes[$path] = ['controller' => $controller, 'method' => $method];
    }

    public function dispatch($url) {
        $basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        $url = parse_url($url, PHP_URL_PATH);
        
        // Remove base path from URL if it exists
        if (strpos($url, $basePath) === 0) {
            $url = substr($url, strlen($basePath));
        }

        $url = rtrim($url, '/');
        if (empty($url)) $url = '/';

        if (isset($this->routes[$url])) {
            $route = $this->routes[$url];
            $controllerName = $route['controller'];
            $methodName = $route['method'];

            require_once "controllers/$controllerName.php";
            $controller = new $controllerName();
            $controller->$methodName();
        } else {
            http_response_code(404);
            echo "404 - Page not found";
        }
    }
}
