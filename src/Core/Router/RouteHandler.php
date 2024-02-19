<?php

namespace App\Core\Router;

use App\Core\Exceptions\NotFoundException;

class RouteHandler
{
    private function hasRoute(): bool
    {
        return array_key_exists($_SERVER['REQUEST_URI'], RouteRegister::getRoutes());
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        if ($this->hasRoute()) {

            return RouteRegister::getRoutes()[$_SERVER['REQUEST_URI']];

        } else {

            NotFoundException::throw();

        }
    }
}
