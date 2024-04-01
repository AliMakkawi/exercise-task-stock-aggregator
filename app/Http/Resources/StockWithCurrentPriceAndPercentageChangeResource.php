<?php

namespace App\Http\Resources;

use App\StockMarket\Domain\ValueObject\StockWithCurrentPriceAndPercentageChange;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockWithCurrentPriceAndPercentageChangeResource extends JsonResource
{
    /**
     * @var StockWithCurrentPriceAndPercentageChange
     */
    public $resource;

    public function toArray(Request $request): array
    {
        $percentageChange = $this->resource->percentageChange;
        return [
            'name' => $this->resource->stock->name,
            'symbol' => $this->resource->stock->symbol,
            'price' => '$'. $this->resource->stockPrice->price,
            'percentage_change' => isset($percentageChange) ? $percentageChange . '%' : 'None',
        ];
    }
}
