<?php
namespace Varavin\TestWidget\Models;

class CompanyStockPrice
{
    private $symbol;

    private $price;

    private $volume;

    public static function fromArray(array $array): CompanyStockPrice
    {
        $companyStockPrice = new CompanyStockPrice();
        $companyStockPrice->setSymbol($array['symbol'] ?? '')
            ->setPrice($array['price'] ?? 0)
            ->setVolume($array['volume'] ?? 0);
        return $companyStockPrice;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getVolume(): int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): self
    {
        $this->volume = $volume;
        return $this;
    }
}