<?php

namespace App\Http\Requests;

use App\Enums\Gateway1Status;
use App\Models\Payment;
use Illuminate\Validation\Rule;

class PaymentGateway1Request extends PaymentGatewayRequest
{
    public function authorize(): bool
    {
        $inputs = $this->only([
            "merchant_id",
            "payment_id",
            "status",
            "amount",
            "amount_paid",
            "timestamp",
        ]);

        ksort($inputs);

        $inputs = implode(':', $inputs);
        $inputs .= config('payment.gateways.gateway1.merchant_key');

        return $this->input('sign') === hash("SHA256", $inputs);
    }

    public function rules(): array
    {
        return [
            'merchant_id' => ['required', 'integer'],
            'payment_id' => ['required', 'integer'],
            'status' => ['required', 'string', Rule::enum(Gateway1Status::class)],
            'amount' => ['required', 'integer'],
            'amount_paid' => ['required', 'integer'],
            'timestamp' => ['required', 'integer'],
            'sign' => ['required', 'string'],
        ];
    }
}
