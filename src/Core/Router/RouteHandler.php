<?php

namespace App\Core\Router;

use App\Core\Exceptions\NotFoundException;
use App\Core\Helpers\UriHelper;

class RouteHandler
{

    private string $requestUri;

    public function __construct(string $requestUri)
    {
        $this->requestUri = UriHelper::sanitizeUri($requestUri);
    }

    /**
     * @return bool
     */
    private function hasRoute($path): bool
    {
        return array_key_exists($path, RouteRegister::getRoutes());
    }

    /**
     * @return mixed|void
     */
    public function getRoute()
    {
        $path = UriHelper::getPath($this->requestUri);

        if ($this->hasRoute($path)) {

            $path = RouteRegister::getRoutes()[$path];

            $path['params'] = UriHelper::getQuery($this->requestUri) ?? [];

            return $path;
        } else {
            NotFoundException::throw();
        }
    }
}
