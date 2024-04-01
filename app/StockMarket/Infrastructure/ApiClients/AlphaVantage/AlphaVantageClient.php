<?php

declare(strict_types=1);

namespace App\StockMarket\Infrastructure\ApiClients\AlphaVantage;

use App\StockMarket\Infrastructure\ApiClients\AlphaVantage\Exceptions\AlphaVantageException;
use App\StockMarket\Infrastructure\ApiClients\AlphaVantage\Responses\TimeSeriesIntradayResponse;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

final class AlphaVantageClient
{
    private const BASE_URL = 'https://www.alphavantage.co';

    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = env('ALPHA_VANTAGE_API_KEY');
    }

    /**
     * @throws AlphaVantageException
     */
    public function fetchTimeSeriesIntraday(string $symbol): TimeSeriesIntradayResponse
    {
        try {
            $response = Http::baseUrl(self::BASE_URL)
                ->get('/query', [
                    'function' => 'TIME_SERIES_INTRADAY',
                    'symbol' => $symbol,
                    'interval' => '1min',
                    'outputsize' => 'compact',
                    'extended_hours' => true,
                    'adjusted' => true,
                    'apikey' => $this->apiKey,
                ])->throw();

            $data = $response->json();

            if (isset($response['Error Message'])) {
                throw new AlphaVantageException('Failed to fetch data from Alpha Vantage due to wrong parameters', 500);
            }

            if (isset($response['Information'])) {
                throw new AlphaVantageException('Failed to fetch data from Alpha Vantage due to reaching request\'s limit', 500);
            }

            return TimeSeriesIntradayResponse::from($data);
        } catch (RequestException $exception) {
            throw new AlphaVantageException('Failed to fetch data from Alpha Vantage: '.$exception->getMessage(), $exception->getCode(), $exception);
        } catch (\Exception $exception) {
            throw new AlphaVantageException('An unexpected error occurred: '.$exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
