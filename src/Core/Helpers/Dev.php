<?php

namespace App\Core\Helpers;

class Dev
{
    public static function dd($arg, $die = true)
    {
        echo "<pre>";
            var_dump($arg);
        echo "</pre>";
        if ($die) {
            die();
        }
    }
}
