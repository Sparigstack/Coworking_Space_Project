<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Razorpay\Api\Api;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       
        $this->app->bind(Api::class, function($app){
            return new Api(config('app.payment.razorpay_key') , config('app.payment.razorpay_secret'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
