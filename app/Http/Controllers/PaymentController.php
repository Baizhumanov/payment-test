<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentGatewayRequest;
use App\Services\PaymentGateway\PaymentGatewayService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\RateLimiter;

class PaymentController extends Controller
{
    public function processGateway(PaymentGatewayRequest $request, PaymentGatewayService $service): JsonResponse
    {
        $request->validated();

        $service->handle($request->input());

        RateLimiter::hit($request->route("gateway"));

        return response()->json(['success' => true]);
    }
}
