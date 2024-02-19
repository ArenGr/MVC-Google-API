<?php

namespace App\Core\View;

interface ViewInterface
{
    public function renderView(string $view, array $params): void;
}