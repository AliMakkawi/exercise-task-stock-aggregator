<?php

namespace App\Http\Controllers;

use App\Http\Resources\StockResource;
use App\Http\Resources\StockWithAllPricesAndPercentageChangesResource;
use App\Http\Resources\StockWithCurrentPriceAndPercentageChangeResource;
use App\StockMarket\Domain\Models\Stock;
use App\StockMarket\Domain\Repositories\StockRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
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

    public function query(Request $request): JsonResource
    {

        $validatdData = $request->validate([
            'symbol' => ['string', 'max:255', Rule::in(Stock::pluck('symbol'))],
        ]);
        if(isset($validatdData['symbol'])) {
            $stock = Stock::where('symbol', $validatdData['symbol'])->first();
            return StockWithAllPricesAndPercentageChangesResource::make($this->stockRepository->findAllPricesAndPercentageChangesForStock($stock));
        }

        $stocksWithAllPricesAndPercentageChanges = collect();
        $stocks = Stock::all();
        foreach($stocks as $stock) {
            $stocksWithAllPricesAndPercentageChanges->push($this->stockRepository->findAllPricesAndPercentageChangesForStock($stock));
        }
        return StockWithAllPricesAndPercentageChangesResource::collection($stocksWithAllPricesAndPercentageChanges);
    }
}
