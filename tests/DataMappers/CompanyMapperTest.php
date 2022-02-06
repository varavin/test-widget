<?php
namespace Tests\DataMappers;

use Varavin\TestWidget\DataMappers\CompanyMapper;
use PHPUnit\Framework\TestCase;
use Varavin\TestWidget\Storage\FinancialApiAdapter;

class CompanyMapperTest extends TestCase
{
    public function testFindRandom()
    {
        $company = ['name' => 'Test Company Name', 'symbol' => 'TEST'];

        $financialApiAdapterMock = $this->createMock(FinancialApiAdapter::class);
        $financialApiAdapterMock->method('getRandomCompany')->willReturn($company);

        $companyMapper = new CompanyMapper($financialApiAdapterMock);

        $this->assertEquals($company['name'], $companyMapper->findRandom()->getName());
    }
}
