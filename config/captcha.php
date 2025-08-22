<?php



return [

    'secret' => env('NOCAPTCHA_SECRET'),

    'sitekey' => env('NOCAPTCHA_SITEKEY'),

    'options' => [

        'timeout' => 360,

    ],

    'math' => [
        'length' => 9,
        'width' => 160,
        'height' => 36,
        'quality' => 100,
        'math' => true,
        'lines' => -1,
        'bgColor' => '#ecf2f4',
        'fontColors' => ['#000000'],
    ],
];
