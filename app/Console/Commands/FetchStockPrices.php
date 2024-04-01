<?php

namespace App\Console\Commands;

use App\StockMarket\Domain\Models\Stock;
use App\StockMarket\Domain\Models\StockPrice;
use App\StockMarket\Infrastructure\ApiClients\AlphaVantage\Repositories\AlphaVantageRepository;
use Illuminate\Console\Command;

class FetchStockPrices extends Command
{
    protected $signature = 'stock:fetch-prices';

    protected $description = 'Fetches stock prices from Alpha Vantage API';

    public function __construct(
        private readonly  AlphaVantageRepository $alphaVantageRepository,
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $stocks = Stock::all('id', 'symbol');
        foreach ($stocks as $stock) {
            try {

                $response = $this->alphaVantageRepository->find($stock->symbol);
                if($stock->prices()->where('date_and_time_of_price', $response->dateAndTimeOfPrice)->exists()) {
                    continue;
                }
                $stockPrice = new StockPrice();
                $stockPrice->price = (float) $response->price;
                $stockPrice->date_and_time_of_price = $response->dateAndTimeOfPrice;
                $stock->prices()->save($stockPrice);
            } catch(\Exception $exception) {
                $this->error($exception->getMessage());
            }
        }
    }
}
