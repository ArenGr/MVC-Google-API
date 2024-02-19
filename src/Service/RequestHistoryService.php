<?php

namespace App\Service;

use App\Repository\RequestHistoryRepository;

class RequestHistoryService
{
    public function __construct(private RequestHistoryRepository $requestHistoryRepository){}

    public function getAllHistory()
    {
        return $this->requestHistoryRepository->getAllRequestHistory();
    }
}