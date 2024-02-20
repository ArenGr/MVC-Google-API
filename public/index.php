<?php

use App\Core\Container\Container;
use App\Core\Kernel;

require_once dirname(__DIR__) . '/vendor/autoload.php';

define('APP_ROOT', dirname(__DIR__));

$dotenv = Dotenv\Dotenv::createImmutable(APP_ROOT);
$dotenv->load();

spl_autoload_register(function ($className) {

    $className = str_replace('App', '/src', str_replace('\\', '/', $className));

    $file = APP_ROOT . $className . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

require_once APP_ROOT . '/routes/web.php';

$container = new Container();

$kernel = new Kernel($container);
