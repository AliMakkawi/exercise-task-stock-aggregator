<?php

return [
    App\Providers\AppServiceProvider::class,
    App\StockMarket\Infrastructure\ApiClients\AlphaVantage\AlphaVantageServiceProvider::class,
    App\StockMarket\StockMarketServiceProvider::class,
];
