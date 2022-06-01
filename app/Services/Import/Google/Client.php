<?php

namespace App\Services\Import\Google;

class Client
{
    public function getData()
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request(
            'GET',
            'https://www.googleapis.com/books/v1/volumes?q=php'
        );

        if ($res->getStatusCode() !== 200) {
            throw new \Exception('Invalid client code');
        }

        return json_decode($res->getBody(), true);
    }
}
