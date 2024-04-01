<?php

namespace App\Http\Resources;

use App\StockMarket\Domain\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
{
    /**
     * @var Stock
     */
    public $resource;

    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'symbol' => $this->resource->symbol,
        ];
    }
}
