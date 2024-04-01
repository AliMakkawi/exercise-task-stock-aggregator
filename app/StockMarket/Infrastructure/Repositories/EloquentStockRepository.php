<?php

declare(strict_types=1);

namespace App\StockMarket\Infrastructure\Repositories;

use App\StockMarket\Domain\Models\Stock;
use App\StockMarket\Domain\Repositories\StockRepository;
use App\StockMarket\Domain\ValueObject\StockWithCurrentPriceAndPercentageChange;
use Illuminate\Support\Collection;

final class EloquentStockRepository implements StockRepository
{
    public function findCurrentPriceAndPercentageChangeForStock(Stock $stock): StockWithCurrentPriceAndPercentageChange
    {
        $prices = $stock->prices()->latest('date_and_time_of_price')->take(2)->pluck('price');

        $currentStockPrice = $stock->prices()->latest('date_and_time_of_price')->first();

        if ($prices->count() < 2) {
            return new StockWithCurrentPriceAndPercentageChange(
                $stock,
                $currentStockPrice,
                null,
            );
        }
        return new StockWithCurrentPriceAndPercentageChange(
            $stock,
            $currentStockPrice,
            $this->findPercentageChangeForStock($prices[0], $prices[1]),
        );
    }

    private function findAllPricesForStock(Stock $stock): Collection
    {
        return $stock->prices()->latest('date_and_time_of_price')->get();
    }

    private function findAllPercentageChangesForStock(Stock $stock): Collection
    {
        $prices = $stock->prices()->latest('date_and_time_of_price')->get();

        if ($prices->count() < 2) {
            return collect();
        }

        $percentageChanges = collect();
        $previousPrice = null;

        foreach($prices as $price) {
            if ($previousPrice === null) {
                $previousPrice = (string) $price->price;
                continue;
            }
            $currentPrice = (string) $price->price;

            $percentageChanges->put($price->date_and_time_of_price, $this->findPercentageChangeForStock($currentPrice, $previousPrice));

            $previousPrice = $currentPrice;
        }

        return $percentageChanges;
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
