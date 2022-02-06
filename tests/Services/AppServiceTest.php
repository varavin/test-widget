<?php
namespace Tests\Services;

use PHPUnit\Framework\TestCase;
use Varavin\TestWidget\Dto\CompanyDto;
use Varavin\TestWidget\Dto\CompanyStockPriceDto;
use Varavin\TestWidget\Misc\FinancialApiWrapper;
use Varavin\TestWidget\Services\ApiService;

class AppServiceTest extends TestCase
{
    public function testGetWidgetData()
    {
        $companyDto = new CompanyDto();
        $companyDto->name = 'Test Company Name';
        $companyDto->symbol = 'TEST';
        $companyStockPriceDto = new CompanyStockPriceDto();
        $companyStockPriceDto->price = 123.45;
        $tsNow = time();

        $financialApiWrapperMock = $this->createMock(FinancialApiWrapper::class);
        $financialApiWrapperMock->method('getRandomCompany')->willReturn($companyDto);
        $financialApiWrapperMock->method('getCompanyStockPrice')->willReturn($companyStockPriceDto);

        $apiService = new ApiService($financialApiWrapperMock);
        $widgetDataDto = $apiService->getWidgetData();

        $this->assertEquals($companyDto->name, $widgetDataDto->companyName);
        $this->assertEquals($companyStockPriceDto->price, $widgetDataDto->currentPrice);
        $this->assertGreaterThanOrEqual($tsNow, $widgetDataDto->updatedTs);
    }
}
