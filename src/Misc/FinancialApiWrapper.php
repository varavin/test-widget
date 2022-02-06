<?php
namespace Varavin\TestWidget\Misc;

use GuzzleHttp\Client;
use Varavin\TestWidget\Dto\CompanyDto;
use Varavin\TestWidget\Dto\CompanyStockPriceDto;

class FinancialApiWrapper
{
    private $apiKey;

    private $client;

    public function __construct()
    {
        $this->apiKey = $_ENV['API_KEY'];
        $this->client = new Client();
    }

    public function getRandomCompany(): ?CompanyDto
    {
        $response = $this->client->request('GET', 'https://financialmodelingprep.com/api/v3/stock_market/actives?apikey=' . $this->apiKey);

        $data = json_decode($response->getBody()->getContents(), true);
        $randomItem = $data[array_rand($data)];

        return SerializerWrapper::arrayToObject($randomItem, CompanyDto::class);
    }

    public function getCompanyStockPrice(string $symbol): ?CompanyStockPriceDto
    {
        $response = $this->client->request('GET', 'https://financialmodelingprep.com/api/v3/quote-short/' . $symbol. '?apikey=' . $this->apiKey);
        $data = json_decode($response->getBody()->getContents(), true);

        return SerializerWrapper::arrayToObject($data[0], CompanyStockPriceDto::class);
    }
}