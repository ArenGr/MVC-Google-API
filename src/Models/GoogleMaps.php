<?php

namespace App\Models;

use App\Core\Model\Model;

class GoogleMaps extends Model
{
    /**
     * @throws \Exception
     */
    public function getStaticImage(string $url): string
    {
        return $this->HTTPClient->get($url);
    }

    public function getPredictions(string $url)
    {
        return $this->HTTPClient->get($url);
    }

    public function getAddressDetails(string $url)
    {
        return $this->HTTPClient->get($url);
    }
}