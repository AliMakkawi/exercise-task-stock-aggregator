<?php

declare(strict_types=1);

namespace App\StockMarket\Infrastructure\ApiClients\AlphaVantage\Repositories;

use App\StockMarket\Infrastructure\ApiClients\AlphaVantage\Exceptions\AlphaVantageException;
use App\StockMarket\Infrastructure\ApiClients\AlphaVantage\Responses\TimeSeriesIntradayResponse;

interface AlphaVantageRepository
{
    /**
     *  @throws AlphaVantageException
     */
    public function find(string $symbol): TimeSeriesIntradayResponse;
}
