<?php

namespace Tests\Controllers;

use Varavin\TestWidget\Controllers\ApiController;
use PHPUnit\Framework\TestCase;
use Varavin\TestWidget\DataMappers\CompanyMapper;
use Varavin\TestWidget\DataMappers\CompanyStockPriceMapper;
use Varavin\TestWidget\Dto\WidgetDataDto;
use Varavin\TestWidget\Misc\SerializerWrapper;
use Varavin\TestWidget\Models\Company;
use Varavin\TestWidget\Models\CompanyStockPrice;
use Varavin\TestWidget\Services\ApiService;

class ApiControllerTest extends TestCase
{
    public function testWidgetData()
    {
        $company = (new Company())
            ->setName('Test Company Name')
            ->setSymbol('TEST');
        $companyStockPrice = (new CompanyStockPrice())
            ->setPrice(123.45);
        $tsNow = time();

        $companyMapperMock = $this->createMock(CompanyMapper::class);
        $companyMapperMock->method('findRandom')->willReturn($company);

        $companyStockPriceMapperMock = $this->createMock(CompanyStockPriceMapper::class);
        $companyStockPriceMapperMock->method('findBySymbol')->willReturn($companyStockPrice);

        $apiService = new ApiService($companyMapperMock, $companyStockPriceMapperMock);

        $apiController = new ApiController();
        $response = $apiController->widgetData($apiService);

        /** @var $widgetDataDto WidgetDataDto */
        $widgetDataDto = SerializerWrapper::jsonToObject($response->getContent(), WidgetDataDto::class);

        $this->assertEquals($companyStockPrice->getPrice(), $widgetDataDto->currentPrice);
        $this->assertEquals($company->getName(), $widgetDataDto->companyName);
    }
}
