<?php
namespace Varavin\TestWidget\DataMappers;

use Varavin\TestWidget\Storage\FinancialApiAdapter;
use Varavin\TestWidget\Models\CompanyStockPrice;

class CompanyStockPriceMapper
{
    private $financialApiAdapter;
    
    public function __construct(FinancialApiAdapter $financialApiAdapter)
    {
        $this->financialApiAdapter = $financialApiAdapter;
    }

    public function findBySymbol(string $symbol): CompanyStockPrice
    {
        $arr = $this->financialApiAdapter->getCompanyStockPrice($symbol);
        return $this->mapToCompany($arr);
    }

    private function mapToCompany($array): CompanyStockPrice
    {
        return CompanyStockPrice::fromArray($array);
    }
}