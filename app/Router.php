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

    protected $route = [];

    public function __construct()
    {
        $this->route['path'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->route['query'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        $this->route['method'] = $_SERVER['REQUEST_METHOD'];
    }

    // A felhasználótól érkezett adatok fertőtlenítése
    private function sanitize(array $data): array
    {
        $sanizizedData = [];
        foreach ($data as $key => $value)
        {
            $sanizizedData[$key] = htmlspecialchars($value);
        }
        return $sanizizedData;
    }

    // 
    public function init(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        $method = $_SERVER['REQUEST_METHOD'];

        // Ha létezik ilyen route
        if (array_key_exists($path, $this->routes[$method])) {
            $controller = $this->routes[$method][$path]['controller'];
            $action = $this->routes[$method][$path]['action'];

            // Adataok metódustól függően
            if ($method === 'GET' && !empty($query))
            {
                parse_str($query, $data);
                $data = $this->sanitize($data);
            }
            elseif ($method === 'POST' && !empty($_POST))
            {
                $data = $this->sanitize($_POST);
            }
            else
            {
                $data = null;
            }

            // Ha létezik ilyen controller osztály
            if (class_exists($controller))
            {
                $controller = new $controller();
                $controller->$action($data);
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
    public function get(string $route, string $controller, string $action): void
    {
        $this->registerRoute('GET', $route, $controller, $action);
    }
    public function post(string $route, string $controller, string $action): void
    {
        $this->registerRoute('POST', $route, $controller, $action);
    }

    public function getRoute(): array
    {
        return $this->route;
    }
}