<?php
return[

    'serverKey' => env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-xxxxxxxxxxxxxxxxxxx'),
    'clientKey' => env('MIDTRANS_CLIENT_KEY', 'SB-Mid-client-06O2KMZui7WkqN23' ),
    'isProduction' => env('MIDTRANS_IS_PRODUCTION',false),
    'isSanitized' => env('MIDTRANS_IS_SANITIZED',true),
    'is3ds' => env('MIDTRANS_IS_3DS',true),

];