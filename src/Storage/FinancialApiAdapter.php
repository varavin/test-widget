<?php
namespace Varavin\TestWidget\Storage;

use GuzzleHttp\Client;

class FinancialApiAdapter
{
    private $apiKey;

    private $client;

    public function __construct()
    {
        $this->apiKey = $_ENV['API_KEY'];
        $this->client = new Client();
    }

    public function getRandomCompany(): array
    {
        $response = $this->client->request('GET', 'https://financialmodelingprep.com/api/v3/stock_market/actives?apikey=' . $this->apiKey);

        $data = json_decode($response->getBody()->getContents(), true);
        return $data[array_rand($data)];
    }

    public function getCompanyStockPrice(string $symbol): array
    {
        $response = $this->client->request('GET', 'https://financialmodelingprep.com/api/v3/quote-short/' . $symbol. '?apikey=' . $this->apiKey);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data[0];
    }
}