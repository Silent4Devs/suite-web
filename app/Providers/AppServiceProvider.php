<?php

namespace App\Providers;

use App\Extensions\CustomSessionHandler;
use App\Models\VersionesIso;
use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use App\Models\Escuela\Lesson;
use App\Models\Escuela\Section;
use App\Observers\LessonObserver;
use App\Observers\SectionObserver;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
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
        Passport::ignoreRoutes();
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

        view()->composer('*', function ($view) {
            $version_historico = VersionesIso::first();
            $version_iso = $version_historico->version_historico;
            $view->with('version_iso', $version_iso);
        });

        Lesson::observe(LessonObserver::class);
        Section::observe(SectionObserver::class);
    }
}
