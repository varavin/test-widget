<?php
namespace Varavin\TestWidget\Models;

class Company
{
    private $symbol;

    private $name;

    private $change;

    private $price;

    private $changesPercentage;

    public static function fromArray(array $array): Company
    {
        $company = new Company();
        $company->setSymbol($array['symbol'] ?? '')
            ->setName($array['name'] ?? '')
            ->setChange($array['change'] ?? 0)
            ->setPrice($array['price'] ?? 0)
            ->setChangesPercentage($array['changesPercentage'] ?? 0);
        return $company;
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getChange(): float
    {
        return $this->change;
    }

    public function setChange(float $change): self
    {
        $this->change = $change;

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

    public function getChangesPercentage(): float
    {
        return $this->changesPercentage;
    }

    public function setChangesPercentage(float $changesPercentage): void
    {
        $this->changesPercentage = $changesPercentage;
    }
}