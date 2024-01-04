<?php

namespace App\Services\PaymentGateway;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;

class PaymentGateway2Service extends PaymentGatewayService
{
    public function handle(array $data): Model
    {
        return Payment::updateOrCreate(
            ['payment_id' => $data['invoice']],
            [
                'merchant_id' => $data['project'],
                'status' => $data['status'],
                'amount' => $data['amount'],
                'amount_paid' => $data['amount_paid'],
                'signature' => $data['rand'],
            ]
        );
    }
}
