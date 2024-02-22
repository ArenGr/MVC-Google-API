<?php

namespace App\Controllers;

use App\Models\GoogleMapsApi;

class GoogleMapsApiController
{
    public function __construct(public GoogleMapsApi $googleMapsApi){}

    /**
     * @param float $lat
     * @param float $lng
     * @return void
     */
    public function index(float $lat = 0, float $lng = 0): void
    {
        $image = $this->googleMapsApi->getGoogleMapsImageByCoordinates($lat, $lng);
        echo base64_encode($image);
    }
}