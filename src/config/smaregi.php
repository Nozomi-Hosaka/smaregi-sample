<?php

return [
    'sandbox' => [
        'host' => env('SMAREGI_SB_ID_HOST', ''),
        'client_id' => env('SMAREGI_SB_CLIENT_ID', ''),
        'client_secret' => env('SMAREGI_SB_CLIENT_SECRET', ''),
    ],
    'webhook' => [
        'key' => env('WEBHOOK_HEADER_KEY', ''),
        'value' => env('WEBHOOK_HEADER_VALUE', ''),
    ],
];
