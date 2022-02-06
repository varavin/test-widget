<?php

namespace Tests\DataMappers;

use Varavin\TestWidget\DataMappers\CompanyStockPriceMapper;
use PHPUnit\Framework\TestCase;
use Varavin\TestWidget\Storage\FinancialApiAdapter;

class CompanyStockPriceMapperTest extends TestCase
{
    public function test()
    {
        $companyStockPrice = ['price' => 123.45];

        $financialApiAdapterMock = $this->createMock(FinancialApiAdapter::class);
        $financialApiAdapterMock->method('getCompanyStockPrice')->willReturn($companyStockPrice);

        $companyStockPriceMapper = new CompanyStockPriceMapper($financialApiAdapterMock);

        $this->assertEquals($companyStockPrice['price'], $companyStockPriceMapper->findBySymbol('123')->getPrice());
    }
}
