<?php

namespace App\Providers;

use App\Http\Requests\PaymentGatewayRequest;
use App\Services\PaymentGateway\PaymentGatewayService;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class PaymentGatewayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentGatewayService::class, function (Application $application) {
            $gateway = request()->route('gateway');
            $serviceClass = config("payment.gateways.{$gateway}.service");

            if (!isset($serviceClass) || !class_exists($serviceClass)) {
                throw new \RuntimeException("Payment service class for gateway '{$gateway}' is not configured or does not exist.", 404);
            }

            return $application->make($serviceClass);
        });

        $this->app->bind(PaymentGatewayRequest::class, function (Application $application) {
            $gateway = request()->route('gateway');
            $validationClass = config("payment.gateways.{$gateway}.validation");

            if (!isset($validationClass) || !class_exists($validationClass)) {
                throw new \RuntimeException("Payment validation class for gateway '{$gateway}' is not configured or does not exist.", 404);
            }

            return $application->make($validationClass);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
