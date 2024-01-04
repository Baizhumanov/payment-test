<?php

namespace App\Services\PaymentGateway;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;

class PaymentGateway1Service extends PaymentGatewayService
{
    public function handle(array $data): Model
    {
        return Payment::updateOrCreate(
            ['payment_id' => $data['payment_id']],
            [
                'merchant_id' => $data['merchant_id'],
                'status' => $data['status'],
                'amount' => $data['amount'],
                'amount_paid' => $data['amount_paid'],
                'signature' => $data['sign'],
            ]
        );
    }
}
