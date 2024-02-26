<?php

namespace App\Controllers;

use App\Core\View\View;
use App\Models\RequestsHistory;

class HomeController
{
    public function __construct(
        public View            $view,
        public RequestsHistory $requestsHistory
    )
    {
    }

    public function index()
    {
        $res = $this->requestsHistory->getAll();
        echo $this->view->render('home', $res);
    }

    public function store()
    {
        $input = file_get_contents("php://input");
        $data = json_decode($input, true);

        return $this->requestsHistory->store($data);
    }

    public function getAll()
    {
        echo json_encode($this->requestsHistory->getAll());
    }
}