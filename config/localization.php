<?php

return [

    'locale' => 'en',

    'available_locales' => [
        'en' => [
            'title' => 'English',
            'locale' => 'en_EN',
        ],
        'es' => [
            'title' => 'Spanish',
            'locale' => 'es_ES',
        ],
    ],

    'currency' => 'USD',

    'available_currencies' => [
        'USD' => [
            'title' => 'USD (US Dollar)',
        ],
        'BZD' => [
            'title' => 'BZD (Belize Dollar)',
        ],
        'MXN' => [
            'title' => 'MXN (Mexican Pesos)',
        ],
    ],

    'meassure' => 'non-metric',

    'available_meassures' => [
        'non-metric' => [
            'title' => 'Non metric',
            'lot_size_unit' => 'Acre',
            'property_size_unit' => 'Square feets',
        ],
        'metric' => [
            'title' => 'Metric',
            'lot_size_unit' => 'Hectare',
            'property_size_unit' => 'Square meters',
        ],
    ],

];