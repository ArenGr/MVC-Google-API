<?php

namespace App\Core\Exceptions;

use App\Core\Config\ConfigHandler as Config;
use Exception;
use Psr\Container\NotFoundExceptionInterface;

class NotFoundException extends Exception implements NotFoundExceptionInterface
{
    public static function throw()
    {
        http_response_code(404);
        include(Config::get('path.views') . '/errors/404.php');
        die();
    }
}
