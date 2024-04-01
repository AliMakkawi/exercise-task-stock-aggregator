<?php

declare(strict_types=1);

namespace App\StockMarket\Infrastructure\ApiClients\AlphaVantage\Repositories;

use App\StockMarket\Infrastructure\ApiClients\AlphaVantage\AlphaVantageClient;
use App\StockMarket\Infrastructure\ApiClients\AlphaVantage\Responses\TimeSeriesIntradayResponse;

final readonly class ApiAlphaVantageRepository implements AlphaVantageRepository
{
    public function __construct(private AlphaVantageClient $alphaVantageClient)
    {
    }

    public function find(string $symbol): TimeSeriesIntradayResponse
    {
        return $this->alphaVantageClient->fetchTimeSeriesIntraday($symbol);
    }
}
