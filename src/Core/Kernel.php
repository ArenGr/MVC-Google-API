<?php

namespace App\Core;

use App\Core\Router\RouteHandler as Route;
use Psr\Container\ContainerInterface;

class Kernel
{
    private Route $route;
    private array $routes;
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->route = new Route($_SERVER['REQUEST_URI']);
        $this->routes = $this->route->getRoute();
        $this->container = $container;
        $this->run();
    }

    private function call($controller, $action, $params)
    {
        $controller = "App\Controllers\\$controller";

        if (class_exists($controller)) {
            if (method_exists($controller, $action)) {
                $classInstance = $this->container->get($controller);
                call_user_func_array(array($classInstance, $action), $params);
            }
        }
    }

    private function run()
    {
        $this->call($this->routes['controller'], $this->routes['action'], $this->routes['params']);
    }
}
