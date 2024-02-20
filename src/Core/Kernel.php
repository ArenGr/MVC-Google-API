<?php

namespace App\Core;

use App\Core\Helpers\Dev;
use App\Core\Router\RouteHandler as Route;
use Psr\Container\ContainerInterface;

class Kernel
{
    private array $routes;
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $route = new Route;
        $this->routes = $route->getRoute();
        $this->container = $container;
        $this->run();
    }

    public function run()
    {
        $this->call($this->routes['controller'], $this->routes['action'], []);
    }

    public function call($controller, $action, $params)
    {
        $controller = "App\Controller\\$controller";
        if (class_exists($controller)) {
            if (method_exists($controller, $action)) {
                $classInstance = $this->container->get($controller);
                call_user_func_array(array($classInstance, $action), $params);
            }
        }
    }
}
