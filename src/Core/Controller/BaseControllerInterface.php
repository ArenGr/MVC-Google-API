<?php

namespace App\Core\Controller;

interface BaseControllerInterface
{
    public function renderView(string $name, array $data): void;

    public function renderJsonResponse(array $data): void;

}