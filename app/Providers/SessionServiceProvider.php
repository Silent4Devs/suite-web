<?php

namespace App\Providers;

use App\Extensions\CustomSessionHandler;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class SessionServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Session::extend('Custom', function ($app) {
        //     return new CustomSessionHandler;
        // });
    }
}
