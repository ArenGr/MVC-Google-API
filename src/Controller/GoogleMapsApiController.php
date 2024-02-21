<?php

namespace App\Controller;

use App\Models\GoogleMapsApi;

class GoogleMapsApiController
{

    public function __construct(public GoogleMapsApi $googleMapsApi){}

    public function index(float $lat = 0, float $lng = 0)
    {
        $image = $this->googleMapsApi->getGoogleMapsImageByCoordinates($lat, $lng);
//        $this->googleMapsApi->get($lat, $lng);
//        $a = $this->mapService->getGoogleMapUrl();
//        Dev::dd($a);
//        $params = array(
//            'latitude' => $lat,
//            'longitude' => $lng,
//            'zoom' => 7,
//            'width' => 600,
//            'height' => 400,
//            'color' => 'red',
//            'api_key' => Config::get('api.google.key')
//        );
//
//        $urlTemplate = 'https://maps.googleapis.com/maps/api/staticmap?center=%latitude%,%longitude%&zoom=%zoom%&size=%width%x%height%&markers=color:%color%|%latitude%,%longitude%&key=%api_key%&format=png';
//
//        $url = str_replace(
//            array_map(function ($key) {
//                return '%' . $key . '%';
//            }, array_keys($params)),
//            array_values($params),
//            $urlTemplate
//        );
//
//        $res = $this->httpClient->get($url);
        echo base64_encode($image);
    }
}