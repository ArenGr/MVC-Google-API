<?php

namespace App\Contract;

use App\Core\Config\ConfigHandler as Config;

trait GoogleMapsAPI
{
    public function prepareGoogleMapsUrl(float $lat, float $lng): string
    {
        $base = Config::get('api.google.url') . '?';

        $settings[] = sprintf("center=%f,%f", $lat, $lng);

        $settings[] = sprintf("markers=color:red|%f,%f", $lat, $lng);

        $settings[] = sprintf('key=%s', Config::get('api.google.key'));

        $settings = array_merge($settings, Config::get('api.google.settings'));

        $params = implode('&', $settings);

        $url = $base . $params;

        return $url;
    }
}