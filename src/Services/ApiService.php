<?php
namespace Varavin\TestWidget\Services;

use Varavin\TestWidget\Dto\WidgetDataDto;
use Varavin\TestWidget\Misc\FinancialApiWrapper;

class ApiService
{
    private $financialApiWrapper;

    public function __construct(FinancialApiWrapper $financialApiWrapper)
    {
        $this->financialApiWrapper = $financialApiWrapper;
    }

    public function getWidgetData(): WidgetDataDto
    {
        $randomCompany = $this->financialApiWrapper->getRandomCompany();

        $companyStockPrice = $this->financialApiWrapper->getCompanyStockPrice($randomCompany->symbol);

        $widgetDataDto = new WidgetDataDto();
        $widgetDataDto->companyName = $randomCompany->name;
        $widgetDataDto->currentPrice = $companyStockPrice->price;
        $widgetDataDto->updatedTs = time();

        return $widgetDataDto;
    }
}