<?php
namespace Varavin\TestWidget\Services;

use Varavin\TestWidget\DataMappers\CompanyMapper;
use Varavin\TestWidget\DataMappers\CompanyStockPriceMapper;
use Varavin\TestWidget\Dto\WidgetDataDto;

class ApiService
{
    private $companyMapper;

    private $companyStockPriceMapper;

    public function __construct(CompanyMapper $companyMapper, CompanyStockPriceMapper $companyStockPriceMapper)
    {
        $this->companyMapper = $companyMapper;
        $this->companyStockPriceMapper = $companyStockPriceMapper;
    }

    public function getWidgetDataDto(): WidgetDataDto
    {
        $randomCompany = $this->companyMapper->findRandom();
        $companyStockPrice = $this->companyStockPriceMapper->findBySymbol($randomCompany->getSymbol());

        $widgetDataDto = new WidgetDataDto();
        $widgetDataDto->companyName = $randomCompany->getName();
        $widgetDataDto->currentPrice = $companyStockPrice->getPrice();
        $widgetDataDto->updatedTs = time();

        return $widgetDataDto;
    }
}