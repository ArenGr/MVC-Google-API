<?php

namespace App\Controller;

use App\Core\Config\ConfigHandler as Config;
use App\Core\Helpers\Dev;
use App\Core\HTTPClient\HTTPClient;
use App\Core\View\View;
use App\Service\RequestHistoryService;

class RequestHistoryController
{
    public function __construct(public View $view, public RequestHistoryService $requestHistoryService,public HTTPClient $httpClient)
    {
    }

    public function index(int $lat = 0, int $lng = 0)
    {
//        echo 'aaaaaaaaaaa';
//        $lat = $_GET['lat'];
//        $lng = $_GET['lng'];
//        echo $lng;
//        echo $lat;
        $url = sprintf("https://maps.googleapis.com/maps/api/staticmap?center=%s,%s&zoom=12&size=600x400&key=%s", $lat, $lng, Config::get('api.google.key'));

        $res = $this->httpClient->get($url);
        Dev::dd($res);
//        $res = $this->requestHistoryService->getAllHistory();
        return $this->view->render('home', ['img' => $res]);

    }

//    public function store()
//    {
//
//    }
}