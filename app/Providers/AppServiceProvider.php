<?php

namespace App\Providers;

use App\Models\VersionesIso;
use Carbon\Carbon;
// use Doctrine\DBAL\Types\Type;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Passport::ignoreRoutes();
        // if (! Type::hasType('enum')) {
        //     Type::addType('enum', 'Doctrine\DBAL\Types\StringType');
        // }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //https now working by nginx
        // if (env('APP_ENV') === 'production') {
        //     $this->app['request']->server->set('HTTPS', 'on'); // Force HTTPS

        //     URL::forceScheme('https');
        // }

        // Carbon::setLocale(config('app.locale'));
        Paginator::useBootstrap();

        Session::extend('Custom', function ($app) {
            $files = new \Illuminate\Filesystem\Filesystem('/s');
            $minutes = Config::get('session.lifetime');
            $path = Config::get('session.path');

            return new \App\Extensions\CustomSessionHandler($files, $path, $minutes);
        });

        $version_iso = VersionesIso::getFirst()->version_historico ?? null;
        view()->composer('*', function ($view) use ($version_iso) {
            $view->with('version_iso', $version_iso);
        });
    }
}
