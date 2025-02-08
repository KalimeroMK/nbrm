<?php

namespace Kalimeromk\Nbrm;

use Illuminate\Support\Facades\Http;

class NBRMExchangeService
{
    protected string $baseUrl;
    protected string $format;

    public function __construct()
    {
        $this->baseUrl = config('nbrm.base_url', 'https://www.nbrm.mk/KLServiceNOV/');
        $this->format = config('nbrm.format', 'json');
    }

    /**
     * @param  string  $startDate
     * @param  string  $endDate
     * @return array
     */
    public function getExchangeRate(string $startDate, string $endDate): array
    {
        return $this->fetchData("GetExchangeRate", $startDate, $endDate);
    }

    /**
     * @param  string  $startDate
     * @param  string  $endDate
     * @return array
     */
    public function getExchangeRateD(string $startDate, string $endDate): array
    {
        return $this->fetchData("GetExchangeRateD", $startDate, $endDate);
    }

    /**
     * @param  string  $startDate
     * @param  string  $endDate
     * @return array
     */
    public function getExchangeRates(string $startDate, string $endDate): array
    {
        return $this->fetchData("GetExchangeRates", $startDate, $endDate);
    }

    /**
     * @param  string  $startDate
     * @param  string  $endDate
     * @return array
     */
    public function getExchangeRatesD(string $startDate, string $endDate): array
    {
        return $this->fetchData("GetExchangeRatesD", $startDate, $endDate);
    }

    /**
     * @param  string  $method
     * @param  string  $startDate
     * @param  string  $endDate
     * @return array
     */
    private function fetchData(string $method, string $startDate, string $endDate): array
    {
        if (in_array($method, ['GetExchangeRateD', 'GetExchangeRatesD'])) {
            $startDate = date('d-M-Y', strtotime($startDate));
            $endDate = date('d-M-Y', strtotime($endDate));
        } else {
            $startDate = date('d.m.Y', strtotime($startDate));
            $endDate = date('d.m.Y', strtotime($endDate));
        }

        $url = "{$this->baseUrl}{$method}?StartDate={$startDate}&EndDate={$endDate}&format={$this->format}";

        $response = Http::get($url);
        if (!$response->successful()) {
            return [];
        }

        return $response->json() ?? [];
    }

}