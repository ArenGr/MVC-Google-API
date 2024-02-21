<?php

namespace App\Models;

use App\Core\Model\Model;

class GoogleMapsApi extends Model
{

    /**
     * Retrieves a Google Maps static image based on the provided latitude and longitude coordinates.
     * @param float $lat
     * @param $lng
     * @return mixed
     */
    public function getGoogleMapsImageByCoordinates(float $lat, $lng)
    {
        $url = $this->prepareGoogleMapsUrl($lat, $lng);

        return $this->HTTPClient->get($url);
    }
}