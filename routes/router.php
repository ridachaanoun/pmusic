<?php

class Router {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function run() {
        $requestUri = parse_url($_GET['route'], PHP_URL_PATH);
        $requestUri = trim($requestUri, '/');

        // echo $requestUri;
        // Define routes
        $routes = [
            // user routes
            'home' => ['homeController', 'show'],
            'register' => ['UserController', 'register'],
            'login' => ['UserController', 'login']

        ];

        if (isset($routes[$requestUri])) {
            list($controller, $action) = $routes[$requestUri];

                $controllerInstance = new $controller($this->db);
                call_user_func([$controllerInstance, $action]);
                return;
        }
        
    }
}