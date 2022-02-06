<?php
namespace Varavin\TestWidget\Controllers;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;
use Varavin\TestWidget\Services\ApiService;

class ApiController
{
    public function test(ApiService $apiService): Response
    {
        $client = new Client();
        $payload = [];
        $response = $client->request('GET', '', $payload);
        var_dump(json_decode($response->getBody()->getContents(), true));


        return new Response('test api response');
    }
}
