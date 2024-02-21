<?php

namespace App\Core\HTTPClient;

use Exception;

class HTTPClient implements HTTPClientInterface
{
    private $curl;

    public function __construct()
    {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 30);
        // Add more options as needed
    }

    /**
     * @param string $url
     * @return string
     * @throws Exception
     */
    public function get(string $url): string
    {
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_HTTPGET, true);
        return $this->execute();
    }

    /**
     * @param string $url
     * @param array $data
     * @return string
     * @throws Exception
     */
    public function post(string $url, array $data): string
    {
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        return $this->execute();
    }

    /**
     * @return string
     * @throws Exception
     */
    private function execute(): string
    {
        $response = curl_exec($this->curl);
        if ($response === false) {
            throw new Exception(curl_error($this->curl), curl_errno($this->curl));
        }
        return $response;
    }

    public function __destruct()
    {
        curl_close($this->curl);
    }
}
