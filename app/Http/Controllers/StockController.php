<?php

namespace App\Http\Controllers;

use App\Http\Resources\StockResource;
use App\StockMarket\Domain\Models\Stock;

    public function index(): JsonResource
    {
        return StockResource::collection(Stock::all());
    }
}
