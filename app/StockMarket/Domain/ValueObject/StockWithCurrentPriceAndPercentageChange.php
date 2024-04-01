<?php

declare(strict_types=1);

namespace App\StockMarket\Domain\ValueObject;

use App\StockMarket\Domain\Models\Stock;
use App\StockMarket\Domain\Models\StockPrice;

final readonly class StockWithCurrentPriceAndPercentageChange
{
    public function __construct(
        public Stock $stock,
        public StockPrice $stockPrice,
        public ?string $percentageChange,
    ) {
    }
}
