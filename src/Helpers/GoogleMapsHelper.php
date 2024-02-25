<?php

namespace App\Helpers;

use App\Core\Config\ConfigHandler as Config;

class GoogleMapsHelper
{
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = Config::get('api.google.maps.key');
    }

    public function buildStaticImageUrl(float $lat, float $lng): string
    {
        $url = Config::get('api.google.maps.url') . '/staticmap?';
        $settings[] = sprintf("center=%f,%f", $lat,$lng);
        $settings[] = sprintf("markers=color:red|%f,%f", $lat,$lng);
        $settings[] = sprintf('key=%s', $this->apiKey);
        $settings = array_merge($settings, Config::get('api.google.maps.settings.static_image'));

        $params = implode('&', $settings);

        return $url . $params;
    }

    public function builAutocompleteUrl(string $input)
    {
        $url = Config::get('api.google.maps.url') . '/place/autocomplete/json';

        return $url . '?input=' . urlencode($input) . '&key=' . $this->apiKey;
    }

    public function buildPlaceDetailsUrl(string $placeId)
    {
        $url = Config::get('api.google.maps.url') . '/place/details/json';

        return $url . '?place_id=' . urlencode($placeId) . '&fields=geometry,address_components&key=' . $this->apiKey;
    }
}