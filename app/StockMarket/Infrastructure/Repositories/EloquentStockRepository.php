<?php

declare(strict_types=1);

namespace App\StockMarket\Infrastructure\Repositories;

use App\StockMarket\Domain\Models\Stock;

final class EloquentStockRepository implements StockRepository
{
    private function findAllPricesForStock(Stock $stock): Collection
    {
        return $stock->prices()->latest('date_and_time_of_price')->get();
    }

    private function findPercentageChangeForStock(string $currentPrice, string $previousPrice): ?string
    {
        if(bccomp($previousPrice, '0', 4) === 0) {
            return null;
        }

        $difference = bcsub($currentPrice, $previousPrice, 4);

        return bcmul(bcdiv($difference, $previousPrice, 6), '100', 4);
    }
}
