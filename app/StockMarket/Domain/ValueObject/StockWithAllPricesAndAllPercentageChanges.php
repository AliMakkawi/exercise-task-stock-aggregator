<?php

declare(strict_types=1);

namespace App\StockMarket\Domain\ValueObject;

use App\StockMarket\Domain\Models\Stock;
use Illuminate\Support\Collection;

final readonly class StockWithAllPricesAndAllPercentageChanges
{
    public function __construct(
        public Stock $stock,
        public Collection $stockPrices,
        public Collection $percentageChanges,
    ) {
    }
}
