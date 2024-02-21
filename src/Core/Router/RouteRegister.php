<?php

namespace App\Core\Router;

use App\Core\Helpers\Dev;

class RouteRegister
{

    private static array $routes = [];

    public static function add(string $name, string $path): void
    {
        if (!empty($name) && !empty($path)) {
            self::register($name, $path);
        }
    }

    private static function register(string $name, string $path)
    {
        $path = explode(':', $path);
        self::$routes[$name] = array(
            'controller' => $path[0],
            'action' => $path[1],
            /* To do - parameters */
        );
    }

    public static function getRoutes()
    {
        return self::$routes;
    }
}
