<?php

class Router {
    private $routes = [];

    public function add($path, $controller, $method) {
        $this->routes[$path] = ['controller' => $controller, 'method' => $method];
    }

    public function dispatch($url) {
        $url = parse_url($url, PHP_URL_PATH);
        // Clean URL (remove base path if necessary, here we assume it's root handled by .htaccess)
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
