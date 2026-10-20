<?php

// AdSense credentials are read from the environment so that only the
// developer (with server/.env access) can set or change them. The admin
// panel shows a masked, read-only status and cannot write these values.
return [

    'enabled' => (bool) env('ADSENSE_ENABLED', false),

    'publisher_id' => env('ADSENSE_PUBLISHER_ID', ''),

    'slots' => [
        'header' => env('ADSENSE_AD_SLOT_HEADER', ''),
        'sidebar' => env('ADSENSE_AD_SLOT_SIDEBAR', ''),
        'footer' => env('ADSENSE_AD_SLOT_FOOTER', ''),
    ],

];