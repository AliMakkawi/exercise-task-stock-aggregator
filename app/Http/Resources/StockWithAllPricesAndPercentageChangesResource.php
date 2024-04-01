<?php

namespace App\Http\Resources;

use App\StockMarket\Domain\ValueObject\StockWithAllPricesAndAllPercentageChanges;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockWithAllPricesAndPercentageChangesResource extends JsonResource
{
    /**
     * @var StockWithAllPricesAndAllPercentageChanges
     */
    public $resource;

    public function toArray(Request $request): array
    {
        $prices = $this->resource->stockPrices->pluck('price', 'date_and_time_of_price');
        $changes = $this->resource->percentageChanges->toArray();

        $pricesAndPercentageChanges = $prices->map(function ($price, $date) use ($changes) {
            $change = $changes[$date] ?? null;
            return [
                'price' => '$' . $price,
                'percentage_change' =>  isset($change) ? $change . '%' : 'None',
            ];
        });

        return [
            'name' => $this->resource->stock->name,
            'symbol' => $this->resource->stock->symbol,
            'prices_and_percentage_changes' => $pricesAndPercentageChanges,
        ];
    }
}
