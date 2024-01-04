<?php

namespace Tests\Feature;

use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentGateway2Test extends TestCase
{
    use RefreshDatabase;

    public function test_successful_payment_processing_by_gateway()
    {
        $data = [
            "project" => 816,
            "invoice" => 73,
            "status" => "completed",
            "amount" => 700,
            "amount_paid" => 700,
            "rand" => "SNuHufEJ",
        ];

        $response = $this->post(
            route('payment.gateway', ['gateway' => 'gateway2']),
            $data,
            [
                'Authorization' => 'd84eb9036bfc2fa7f46727f101c73c73',
                'Content-Type' => 'multipart/form-data',
            ],
        );

        $response->assertSuccessful();
        $this->assertModelExists(Payment::merchant($data['project'])->payment($data['invoice'])->first());
    }
}
