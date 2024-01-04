<?php

return [
    'gateways' => [
        'gateway1' => [
            'merchant_id' => 6,
            'merchant_key' => "KaTf5tZYHx4v7pgZ",
            'service' => \App\Services\PaymentGateway\PaymentGateway1Service::class,
            'validation' => \App\Http\Requests\PaymentGateway1Request::class,
            'gateway_rate_limit' => 1
        ],
        'gateway2' => [
            'app_id' => 816,
            'app_key' => 'rTaasVHeteGbhwBx',
            'service' => \App\Services\PaymentGateway\PaymentGateway2Service::class,
            'validation' => \App\Http\Requests\PaymentGateway2Request::class,
            'gateway_rate_limit' => 50
        ]
    ],
];
