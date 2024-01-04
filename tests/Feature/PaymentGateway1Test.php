<?php

namespace Tests\Feature;

use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentGateway1Test extends TestCase
{
    use RefreshDatabase;

    private $data = [
        "merchant_id" => 6,
        "payment_id" => 13,
        "status" => "completed",
        "amount" => 500,
        "amount_paid" => 500,
        "timestamp" => 1654103837,
        "sign" => "f027612e0e6cb321ca161de060237eeb97e46000da39d3add08d09074f931728"
    ];

    public function test_successful_payment_processing_by_gateway()
    {
        $response = $this->postJson(route('payment.gateway', ['gateway' => 'gateway1']), $this->data);
        $response->assertSuccessful();

        $this->assertModelExists(Payment::merchant($this->data['merchant_id'])->payment($this->data['payment_id'])->first());
    }

    public function test_gateway_rate_limit()
    {
        $response = $this->postJson(route('payment.gateway', ['gateway' => 'gateway1']), $this->data);
        $response->assertSuccessful();

        $response = $this->postJson(route('payment.gateway', ['gateway' => 'gateway1']), $this->data);
        $response->assertStatus(429);
    }
}
