<?php 

namespace App\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class CurrencyExchangeRates
{
    /**
     * Exchange API Endpoint
     *
     * @var string
     */
    protected $exchangeApi;

    /**
     * Exchange API Key
     *
     * @var string
     */
    protected $apiKey;

    /**
     * The Base Currency of the APP
     *
     * @var string
     */
    protected $baseCurrency;

    /**
     * The currency to make the exchange
     *
     * @var string
     */
    protected $currency;

    /**
     * Exchange Rates from the API
     *
     * @var array
     */
    protected $rates;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->exchangeApi = $this->getExchangeApi();

        $this->apiKey = $this->getApiKey();

        $this->baseCurrency = $this->getBaseCurrency();

        $this->currency = config('localization.currency');

        $this->rates = $this->getRates();
    }

    /**
     * Get the Exchange API Endpoint
     *
     * @return string
     */
    protected function getExchangeApi(): string
    {
        return env('CURRENCY_EXCHANGE_API');
    }

    /**
     * Get the Exchange API Key
     *
     * @return string
     */
    protected function getApiKey(): string
    {
        return env('CURRENCY_EXCHANGE_KEY');
    }

    /**
     * Get the Base Currency
     *
     * @return string
     */
    public function getBaseCurrency(): string
    {
        return 'USD';
    }

    /**
     * Set a new currency for exchange
     *
     * @param string $currency
     * @return self
     */
    public function setCurrency($currency): self
    {
        $currency = $this->formatCurrency($currency);

        if ($this->isValidCurrency($currency)) {
            $this->currency = $currency;
        }

        return $this;
    }

    /**
     * Get the current currency
     *
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Get the Excahange Rates
     *
     * @return array
     */
    public function getRates(): array
    {
        return Cache::remember('currency_rates', now()->addMinutes(60), function () {
            $response = Http::get($this->exchangeApi, [
                'app_id' => $this->apiKey,
                'base' => $this->baseCurrency,
            ]);
            
            if (!$response->successful()) {
                \Illuminate\Support\Facades\Log::error("Error conecting to the API.");
                \Illuminate\Support\Facades\Log::error($response);
                
                return [];
            }
    
            return (array) json_decode($response)->rates;
        });
    }

    /**
     * Convert from the base currency
     *
     * @param float $amount
     * @return float
     */
    public function convert(float $amount): float
    {
        if (!is_numeric($amount)) {
            throw new \Exception("Only numeric value allowed", 1);
        }

        return $amount * (float) $this->getRate();
    }

    /**
     * Convert to base currency
     *
     * @param float $amount
     * @return float
     */
    public function convertToUsd($amount)
    {
        if (!is_numeric($amount)) {
            throw new \Exception("Only numeric value allowed", 1);
        }

        if ($this->getBaseCurrency() == $this->getCurrency()) {
            return $amount;
        }

        return $amount / (float) $this->getRate();
    }

    /**
     * Get the Exchange rate for the given currency
     *
     * @param [type] $currency
     * @return float
     */
    public function getRate(): float
    {
        return $this->rates[$this->currency] ?? 1;
    }

    /**
     * Check if the currency exist on the Exchange API
     *
     * @param string $currency
     * @return boolean
     */
    protected function isValidCurrency($currency): bool
    {
        $currency = $this->formatCurrency($currency);

        // VERIFY THAT THE CURRENCY EXISTS ON THE EXCHANGE
        if (!Arr::exists($this->rates, $currency)) {
            // SET THE CURRENCY BACK TO DEFAULT
            session(['currency' => $this->baseCurrency]);
            
            throw new \Exception("The currency {$currency} does not exist in this API", 1);
        }

        return true;
    }

    /**
     * Format the currency
     *
     * @param string $currency
     * @return string
     */
    protected function formatCurrency($currency): string
    {
        return Str::upper($currency);
    }
}
