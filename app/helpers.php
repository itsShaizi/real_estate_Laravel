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

        return $fmt->formatCurrency($price, config('localization.currency'));
    }
}
