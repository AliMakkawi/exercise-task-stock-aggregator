<?php

declare(strict_types=1);

namespace App\StockMarket\Infrastructure\ApiClients\AlphaVantage\Responses;

final readonly class TimeSeriesIntradayResponse
{
    public function __construct(
        public string $symbol,
        public string $dateAndTimeOfPrice,
        public string  $price,
    ) {
    }

    public static function from(array $data): self
    {
        $timeSeriesKeys = array_keys($data['Time Series (1min)']);
        $mostRecentTime = $timeSeriesKeys[0];
        $price = $data['Time Series (1min)'][$mostRecentTime]['4. close'];

        return new self(
            symbol: $data['Meta Data']['2. Symbol'],
            dateAndTimeOfPrice: $data['Meta Data']['3. Last Refreshed'],
            price: $price
        );
    }
}
