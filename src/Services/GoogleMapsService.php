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

    /**
     * @throws \Exception
     */
    public function getStaticImage(float $lat, float $lng)
    {
        $url = $this->googleMapsHelper->buildStaticImageUrl($lat, $lng);
        return $this->googleMaps->getStaticImage($url);
    }

    public function getPredictions(string $input): array
    {
        $url = $this->googleMapsHelper->builAutocompleteUrl($input);
        $response = $this->googleMaps->getPredictions($url);
        $response = json_decode($response, true);
        return array_map(function ($item) {
            return [$item['place_id'], $item['description']];
        }, $response['predictions']);
    }

    public function getAddressDetails(string $placeId): array
    {
        $url = $this->googleMapsHelper->buildPlaceDetailsUrl($placeId);

        $response = $this->googleMaps->getAddressDetails($url);
        $response = json_decode($response, true);

        return array(
            'location' => $response['result']['geometry']['location'],
            'address' => $response['result']['address_components']
        );
    }
}