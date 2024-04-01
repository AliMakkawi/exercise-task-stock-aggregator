<?php

namespace App\StockMarket;

use App\StockMarket\Domain\Repositories\StockRepository;
use App\StockMarket\Infrastructure\Repositories\EloquentStockRepository;
use Illuminate\Support\ServiceProvider;

class StockMarketServiceProvider extends ServiceProvider
{
    public array $bindings = [
        StockRepository::class => EloquentStockRepository::class,
    ];
}
