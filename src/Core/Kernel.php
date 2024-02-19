<?php

namespace App\Core;

use App\Core\Container\Container;
use App\Core\Router\RouteHandler as Route;
use Psr\Container\ContainerInterface;

class Kernel
{
    private array $routes;
    private ContainerInterface $container;

    public function __construct()
    {
        $route = new Route;
        $this->routes = $route->getRoute();
        $this->container = new Container();
        $this->run();
    }

    public function run()
    {
        $this->call($this->routes['controller'], $this->routes['action'], []);
    }

    public function call($controller, $action, $params)
    {
//        Dev::dd($controller);
        $controller = "App\Controller\\$controller";
        if (class_exists($controller)) {
            if (method_exists($controller, $action)) {
                $classInstance = $this->container->get($controller);
                call_user_func_array(array($classInstance, $action), $params);
            }
        }
    }
}
