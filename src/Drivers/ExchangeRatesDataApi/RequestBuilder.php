<?php

declare(strict_types=1);

namespace AshAllenDesign\LaravelExchangeRates\Drivers\ExchangeRatesDataApi;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class RequestBuilder
{
    private const BASE_URL = 'https://api.apilayer.com/exchangerates_data/';

    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('laravel-exchange-rates.api_key');
    }

    /**
     * Make an API request to the ExchangeRatesAPI.
     *
     * @param  string  $path
     * @param  string[]  $queryParams
     * @return mixed
     *
     * @throws RequestException
     */
    public function makeRequest(string $path, array $queryParams = []): mixed
    {
        return Http::baseUrl(self::BASE_URL)
            ->withHeaders([
                'apiKey' => $this->apiKey,
            ])
            ->get($path, $queryParams)
            ->throw()
            ->json();
    }
}
