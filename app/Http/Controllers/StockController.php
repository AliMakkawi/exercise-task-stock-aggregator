<?php

namespace App\Http\Controllers;

use App\Http\Resources\StockResource;
use App\Http\Resources\StockWithCurrentPriceAndPercentageChangeResource;
use App\StockMarket\Domain\Models\Stock;
use App\StockMarket\Domain\Repositories\StockRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StockController extends Controller
{
    public function __construct(private readonly StockRepository $stockRepository)
    {
    }

    public function index(): JsonResource
    {
        return StockResource::collection(Stock::all());
    }

    public function current(Request $request): StockWithCurrentPriceAndPercentageChangeResource
    {
        $validatdData = $request->validate([
            'symbol' => ['required', 'string', 'max:255', Rule::in(Stock::pluck('symbol'))],
        ]);
        $stock = Stock::where('symbol', $validatdData['symbol'])->first();

        return StockWithCurrentPriceAndPercentageChangeResource::make($this->stockRepository->findCurrentPriceAndPercentageChangeForStock($stock));
    }
}
