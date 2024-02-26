<?php

namespace App\Controllers;

use App\Models\GoogleMaps;
use App\Services\GoogleMapsService;

class GoogleMapsController
{
    public function __construct(
        public GoogleMaps $googleMapsApi,
        public GoogleMapsService $googleMapsService
    )
    {
    }

    /**
     * @param float $lat
     * @param float $lng
     * @return void
     */
    public function getStaticImage(float $lat, float $lng): void
    {
        $image = $this->googleMapsService->getStaticImage($lat, $lng);
        echo base64_encode($image);
    }

    public function getPredictions(string $input)
    {
        $predictions = $this->googleMapsService->getPredictions($input);
        echo json_encode($predictions);
    }

    public function getAddressDetails(string $placeId)
    {
        $details = $this->googleMapsService->getAddressDetails($placeId);
        echo json_encode($details);
    }
}