<?php

declare(strict_types=1);

namespace App\StockMarket\Domain\Repositories;

use App\StockMarket\Domain\Models\Stock;
use App\StockMarket\Domain\ValueObject\StockWithAllPricesAndAllPercentageChanges;
use App\StockMarket\Domain\ValueObject\StockWithCurrentPriceAndPercentageChange;

interface StockRepository
{
    public function findCurrentPriceAndPercentageChangeForStock(Stock $stock): StockWithCurrentPriceAndPercentageChange;

    public function findAllPricesAndPercentageChangesForStock(Stock $stock): StockWithAllPricesAndAllPercentageChanges;
}
