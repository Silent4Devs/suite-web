<?php

namespace App\Providers;

use App\Extensions\CustomSessionHandler;
use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') === 'production') {
            $this->app['request']->server->set('HTTPS', 'on'); // Force HTTPS

            URL::forceScheme('https');
        }

        // Carbon::setLocale(config('app.locale'));
        Paginator::useBootstrap();
        Session::extend('Custom', function ($app) {
            $files = new Filesystem('/s');
            $minutes = Config::get('session.lifetime');
            $path = Config::get('session.path');

            return new CustomSessionHandler($files, $path, $minutes);
        });
    }
}
