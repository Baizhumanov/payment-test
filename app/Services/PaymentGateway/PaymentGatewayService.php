<?php

namespace App\Services\PaymentGateway;

abstract class PaymentGatewayService
{
    abstract public function handle(array $data);
}
