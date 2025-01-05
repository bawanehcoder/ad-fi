<?php

return [
    'sandboxMode' => env('SANDBOX_MODE', false),

    'entityIdMada' => env('ENTITY_ID_MADA'),

    'entityIdApplePay' => env('ENTITY_ID_APPLE_PAY'),

    'entityId' => env('ENTITY_ID','8ac9a4c783a8088c0183a8462a3104c6'),

    'access_token' => env('ACCESS_TOKEN','OGFjOWE0Yzc4M2E4MDg4YzAxODNhODQ1YWY3ODA0YmR8eTllNDI4NGZiWQ=='),

    'currency' => env('CURRENCY', 'JOD'),

    'redirect_url' => '/hyperpay/finalize',

    'model' => env('PAYMENT_MODEL', class_exists(App\Models\User::class) ? App\Models\User::class : App\User::class),
    /**
     * if you are using multi-tenant you can create a new model like.
     *
     * use Hyn\Tenancy\Traits\UsesTenantConnection;
     * use Devinweb\LaravelHyperpay\Models\Transaction as ModelsTransaction;
     * class Transaction extends ModelsTransaction {
     *
     *  use UsesTenantConnection;
     *
     * }
     */
    'transaction_model' => 'Devinweb\LaravelHyperpay\Models\Transaction',

    'notificationUrl' => '/hyperpay/webhook',
];
