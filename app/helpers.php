<?php
 
if (! function_exists('lot_size')) {
    function lot_size($meassure)
    {
        $fmt = new \NumberFormatter(
            config('localization.available_locales')[config('localization.locale')]['locale'], 
            \NumberFormatter::DECIMAL
        );

        $fmt->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, 2);

        if (config('localization.meassure') != 'non-metric') {
            return $fmt->format($meassure * 0.4046856422);
        }

        return $fmt->format($meassure);
    }
}

if (! function_exists('property_size')) {
    function property_size($meassure)
    {
        $fmt = new \NumberFormatter(
            config('localization.available_locales')[config('localization.locale')]['locale'],
            \NumberFormatter::DECIMAL
        );

        $fmt->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, 2);

        if (config('localization.meassure') != 'non-metric') {
            return $fmt->format($meassure / 10.764);
        }

        return $fmt->format($meassure);
    }
}

if (! function_exists('price')) {
    function price($price)
    {
        $fmt = new \NumberFormatter(
            config('localization.available_locales')[config('localization.locale')]['locale'], 
            \NumberFormatter::CURRENCY
        );

        if (config('localization.currency') != 'USD') {
            $response = \Illuminate\Support\Facades\Http::get('https://openexchangerates.org/api/latest.json', [
                'app_id' => 'a2abe01e55644e90b996e1f6a9575e0b',
                'base' => 'USD',
            ]);

            $currency = config('localization.currency');

            $rates = json_decode($response)->rates;

            // VERIFY THAT THE CURRENCY EXISTS ON THE EXCHANGE
            if (!\Illuminate\Support\Arr::exists((array) $rates, $currency)) {
                // SET THE CURRENCY BACK TO DEFAULT
                session(['currency' => 'USD']);
                
                throw new Exception("The currency {$currency} does not exist in this API", 1);
            }

            return $fmt->formatCurrency($price * $rates->$currency, config('localization.currency'));
        }

        return $fmt->formatCurrency($price, config('localization.currency'));
    }
}
