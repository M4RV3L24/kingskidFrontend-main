<?php

return [
    'js_url' => env('MIDTRANS_IS_PRODUCTION', false) ? 'https://app.stg.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js',
    'mode' => env('MIDTRANS_IS_PRODUCTION', false),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'server_key' => env('MIDTRANS_SERVER_KEY'),
];