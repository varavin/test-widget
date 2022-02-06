<?php
namespace Varavin\TestWidget\Models;

class WidgetData
{
    private $companyName;

    private $currentPrice;

    private $updatedTs;

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;
        return $this;
    }

    public function getCurrentPrice(): float
    {
        return $this->currentPrice;
    }

    public function setCurrentPrice(float $currentPrice): self
    {
        $this->currentPrice = $currentPrice;
        return $this;
    }

    public function getUpdatedTs(): int
    {
        return $this->updatedTs;
    }

    public function setUpdatedTs(int $updatedTs): self
    {
        $this->updatedTs = $updatedTs;
        return $this;
    }


}