<?php

namespace App\Services;

use App\Helpers\GoogleMapsHelper;
use App\Models\GoogleMaps;

class GoogleMapsService
{
    public function __construct(
        protected GoogleMaps       $googleMaps,
        protected GoogleMapsHelper $googleMapsHelper
    )
    {
    }

    public function getStaticImage(float $lat, float $lng)
    {
        $url = $this->googleMapsHelper->buildStaticImageUrl($lat, $lng);
        return $this->googleMaps->HTTPClient->get($url);
    }

    public function getPredictions(string $input): array
    {
        $url = $this->googleMapsHelper->builAutocompleteUrl($input);
        $resposne = $this->googleMaps->HTTPClient->get($url);
        $resposne = json_decode($resposne, true);
        $predictions = array_map(function ($item) {
            return [$item['place_id'], $item['description']];
        }, $resposne['predictions']);

        return $predictions;
    }

    public function getCoordinates(string $placeId): array
    {
        $url = $this->googleMapsHelper->buildPlaceDetailsUrl($placeId);

        $resposne = $this->googleMaps->HTTPClient->get($url);
        $resposne = json_decode($resposne, true);

        return array(
            'location' => $resposne['result']['geometry']['location'],
            'address' => $resposne['result']['address_components']
        );
    }
}