<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::include('Includes.inputDetails', 'inputDetails');
        Blade::include('Includes.Buttons.primaryButton', 'primaryButton');
        Blade::include('Includes.cssLinks', 'cssLinks');
        Blade::component('Includes.modal', 'modal');
        Blade::include('Includes.Form.form', 'form');
        Blade::include('Includes.Form.formGroup', 'formGroup');
        Blade::include('Includes.Form.radioBtn', 'radioBtn');
    }
}
