<?php

namespace App\Services\Giphy;

use GuzzleHttp\Client;

class Giphy
{
    private $client;
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.giphy.api_key');

        $this->client = new Client([
            'base_uri'    => 'http://api.giphy.com/v1/',
            'http_errors' => false,
        ]);
    }

    public function search($query, $limit, $offset)
    {
        $response = $this->client->request('GET', 'gifs/search', [
            'query' => [
                'q'       => $query,
                'api_key' => $this->apiKey,
                'limit'   => $limit,
                'offset'  => $offset,
            ],
        ]);

        $response = $response->getBody()->getContents();

        return json_decode($response);
    }
}
