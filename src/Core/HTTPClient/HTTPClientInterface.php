<?php

namespace App\Core\HTTPClient;

interface HTTPClientInterface
{
    public function get(string $url): string;
    public function post(string $url, array $data): string;
}