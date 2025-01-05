<?php
return [
    'paytabs' => [

    'mode' => 'sandbox',
    'sandbox' => [
        'profileID' => '58355',
        'api_token' => 'SZJN9LT2WT-JB2ZZW62KT-L2JJRKNZ26',
        'base_url' => 'https://secure-jordan.paytabs.com/',
    ],
    'production' => [
        'profileID' => '58355',
        'api_token' => 'SZJN9LT2WT-JB2ZZW62KT-L2JJRKNZ26',
        'base_url' => 'https://secure-jordan.paytabs.com/',
    ],
    'successful_callback_route_name' => 'payment.paytabs.result',
    'failed_callback_route_name' => 'payment.paytabs.result',
    ]];
