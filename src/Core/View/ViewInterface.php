<?php

namespace App\Core\View;

interface ViewInterface
{
    public function render(string $view, array $params): void;
}