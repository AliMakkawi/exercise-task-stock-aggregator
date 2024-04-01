<?php

declare(strict_types=1);

namespace App\StockMarket\Infrastructure\ApiClients\AlphaVantage\Repositories;

use App\StockMarket\Infrastructure\ApiClients\AlphaVantage\Responses\TimeSeriesIntradayResponse;
use Illuminate\Contracts\Cache\Repository as CacheRepository;

final readonly class CacheAlphaVantageRepository implements AlphaVantageRepository
{
    public function __construct(
        private CacheRepository $cache,
        private ApiAlphaVantageRepository $apiAlphaVantageRepository
    ) {
    }

    public function find(string $symbol): TimeSeriesIntradayResponse
    {
        return $this->cache->remember("alpha_vantage_time_series_intraday_$symbol", 60, function () use ($symbol) {
            return $this->apiAlphaVantageRepository->find($symbol);
        });
    }
}
