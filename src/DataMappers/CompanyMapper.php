<?php
namespace Varavin\TestWidget\DataMappers;

use Varavin\TestWidget\Storage\FinancialApiAdapter;
use Varavin\TestWidget\Models\Company;

class CompanyMapper
{
    private $storageAdapter;

    public function __construct(FinancialApiAdapter $storageAdapter)
    {
        $this->storageAdapter = $storageAdapter;
    }

    public function findRandom(): Company
    {
        $arr = $this->storageAdapter->getRandomCompany();
        return $this->mapToCompany($arr);
    }

    private function mapToCompany($array): Company
    {
        return Company::fromArray($array);
    }
}