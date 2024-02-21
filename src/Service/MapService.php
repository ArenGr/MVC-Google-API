<?php

namespace App\Service;

use App\Core\Config\ConfigHandler as Config;

class MapService
{

    public function getGoogleMapUrl()
    {
        return Config::get('api.google.url');
    }
}