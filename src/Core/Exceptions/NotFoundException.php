<?php

namespace App\Core\Exceptions;

use App\Core\Config\ConfigHandler;
use App\Core\Helpers\Dev;
use Exception;
use Psr\Container\NotFoundExceptionInterface;

class NotFoundException extends Exception implements NotFoundExceptionInterface
{
    public static function throw()
    {
        http_response_code(404);
        include(ConfigHandler::get('paths.views') . '/errors/404.php');
        die();
    }
}
