<?php

namespace App\Controllers;

use App\Core\Config\ConfigHandler as Config;

class ProxyController
{

    public function index()
    {
        /* TODO Implement secure logic */

        echo json_encode(Config::get('api.google.key'));
    }
}