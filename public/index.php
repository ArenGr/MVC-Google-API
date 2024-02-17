<?php

use App\Controller\TestController;

require_once dirname(__DIR__).'/vendor/autoload.php';


spl_autoload_register(function ($className) {

    $className = str_replace('App', '/src', str_replace('\\', '/', $className));

    $file = dirname(__DIR__) . $className . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});


$test = new TestController;
$test->index();
