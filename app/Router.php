<?php

namespace App;

/**
 * ROUTER
 * Ez az oaztály feleős az útvonalak kezeléséért, és megfelelő kontrollerhez való továbbításért
 */
class Router
{
    // Ebben tároljuk le az útvonalakat
    protected $routes = [];

    // 
    public function __construct()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        $method = $_SERVER['REQUEST_METHOD'];

        // Ha létezik ilyen route
        if (array_key_exists($path, $this->routes[$method])) {
            $controller = $this->routes[$method][$path]['controller'];
            $action = $this->routes[$method][$path]['action'];

            // Ha létezik ilyen controller osztály
            if (class_exists($controller))
            {
                $controller = new $controller();
                $controller->$action();
            }
            else
            {
                throw new \Exception(message: '500, a controller nem található: ' . $controller);
            }
            
        } else {
            // TODO: rendes 404-es oldal, rendes válaszkóddal
            throw new \Exception('404, az oldal nem található: ' . $path);
        }
    }
    // Ezzel adjuk hozzá az útvonalakat
    private function registerRoute(string $method, string $route, $controller, $action): void
    {
        $this->routes[$method][$route] = ['controller' => $controller, 'action' => $action];
    }

    // Method alapú regisztráció
    public function get(string $route, Controller $controller, string $action): void
    {
        $this->registerRoute('GET', $route, $controller, $action);
    }
    public function post(string $route, Controller $controller, string $action): void
    {
        $this->registerRoute('POST', $route, $controller, $action);
    }
}