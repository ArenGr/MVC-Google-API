<?php

namespace App\Controller;

use App\Core\Controller\BaseController;
use App\Core\Helpers\Dev;
use App\Core\View\View;
use App\Service\RequestHistoryService;

class RequestHistoryController
{
    public function __construct(public View $view, public RequestHistoryService $requestHistoryService)
    {
    }

    public function index()
    {
        $res = $this->requestHistoryService->getAllHistory();
        return $this->view->render('home', $res);

    }
}