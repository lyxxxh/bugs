<?php

namespace App\Services;


use GuzzleHttp\Client;

class httpRequestService
{


    protected $headers = [];

    protected function createClient()
    {
        return new Client([
           'headers' => $this->headers
        ]);
    }

    public function httpGet( $url, $options = [])
    {
        return $this->createClient()->get($url, $options);
    }


    public function setHeaders($headers = [])
    {
        foreach ($headers as $header => $val)
        $this->headers[ $header] = $val;
    }


}