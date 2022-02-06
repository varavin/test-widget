<?php
namespace Tests\Services;

use PHPUnit\Framework\TestCase;
use Varavin\TestWidget\DataMappers\CompanyMapper;
use Varavin\TestWidget\DataMappers\CompanyStockPriceMapper;
use Varavin\TestWidget\Models\Company;
use Varavin\TestWidget\Models\CompanyStockPrice;
use Varavin\TestWidget\Services\ApiService;

class ApiServiceTest extends TestCase
{
    public function testGetWidgetDataDto()
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
        $widgetDataDto = $apiService->getWidgetDataDto();

        $this->assertEquals($company->getName(), $widgetDataDto->companyName);
        $this->assertEquals($companyStockPrice->getPrice(), $widgetDataDto->currentPrice);
        $this->assertGreaterThanOrEqual($tsNow, $widgetDataDto->updatedTs);
    }
}
