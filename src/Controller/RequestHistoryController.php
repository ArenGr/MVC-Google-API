<?php

namespace App\Controller;

use App\Core\Controller\BaseController;
use App\Core\Helpers\Dev;
use App\Service\RequestHistoryService;

class RequestHistoryController extends BaseController
{
    public function __construct(public RequestHistoryService $requestHistoryService)
    {
    }
    public function index()
    {
        $res = $this->requestHistoryService->getAllHistory();
        return $this->renderView('home', $res);

    }
}