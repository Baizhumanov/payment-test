<?php

namespace App\Http\Requests;

use App\Enums\Gateway2Status;
use App\Models\Payment;
use Illuminate\Validation\Rule;

class PaymentGateway2Request extends PaymentGatewayRequest
{
    public function authorize(): bool
    {
        $inputs = $this->only([
            "project",
            "invoice",
            "status",
            "amount",
            "amount_paid",
            "rand",
        ]);

        ksort($inputs);

        $inputs = implode('.', $inputs);
        $inputs .= config('payment.gateways.gateway2.app_key');
//        var_dump($this->header('Authorization'));
//        var_dump(hash("MD5", $inputs));

        return $this->header('Authorization') === hash("MD5", $inputs);
    }

    public function rules(): array
    {
        return [
            "project" => ['required', 'integer'],
            "invoice" => ['required', 'integer'],
            "status" => ['required', 'string', Rule::enum(Gateway2Status::class)],
            "amount" => ['required', 'integer'],
            "amount_paid" => ['required', 'integer'],
            "rand" => ['required', 'string'],
        ];
    }
}
