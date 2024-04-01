<?php

namespace App\StockMarket\Infrastructure\ApiClients\AlphaVantage;

use App\StockMarket\Infrastructure\ApiClients\AlphaVantage\Repositories\CacheAlphaVantageRepository;
use Illuminate\Support\ServiceProvider;
use App\StockMarket\Infrastructure\ApiClients\AlphaVantage\Repositories\AlphaVantageRepository;

class AlphaVantageServiceProvider extends ServiceProvider
{
    public array $bindings = [
        AlphaVantageRepository::class => CacheAlphaVantageRepository::class,
    ];
}
