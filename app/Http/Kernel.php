<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        \Illuminate\Http\Middleware\HandleCors::class,
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\Cors::class,
        //\App\Http\Middleware\XFrameHeadersMiddleware::class,
    ];

    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \App\Http\Middleware\RedirectIfAuthenticated::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            // \App\Http\Middleware\LazyLoadImages::class,
            \App\Http\Middleware\AuthGates::class,
            \App\Http\Middleware\SetLocale::class,
            //laravel-page-speed
            \RenatoMarinho\LaravelPageSpeed\Middleware\InlineCss::class,
            // //\RenatoMarinho\LaravelPageSpeed\Middleware\ElideAttributes::class,
            \RenatoMarinho\LaravelPageSpeed\Middleware\InsertDNSPrefetch::class,
            // \RenatoMarinho\LaravelPageSpeed\Middleware\RemoveComments::class,
            //\RenatoMarinho\LaravelPageSpeed\Middleware\CollapseWhitespace::class,
            //\RenatoMarinho\LaravelPageSpeed\Middleware\DeferJavascript::class,
        ],
        'api' => [
            'throttle:60,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\AuthGates::class,
        ],
        'universal' => [],
    ];

    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'active' => \App\Http\Middleware\ActiveUser::class,
        'isActive' => \App\Http\Middleware\IsActiveUser::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'admin' => \App\Http\Middleware\IsAdmin::class,
        '2fa' => \App\Http\Middleware\TwoFactorMiddleware::class,
        'cors' => \App\Http\Middleware\Cors::class,
        'primeros.pasos' => \App\Http\Middleware\PrimerosPasos::class,
        'version_iso_2013' => \App\Http\Middleware\VersionIso2013::class,
        'version_iso_2022' => \App\Http\Middleware\VersionIso2022::class,
        'doNotCacheResponse' => \Spatie\ResponseCache\Middlewares\DoNotCacheResponse::class,
        'cacheResponse' => \Spatie\ResponseCache\Middlewares\CacheResponse::class,
        // 'XssSanitization' => \App\Http\Middleware\XssSanitization::class,
    ];

    protected $middlewareAliases = [
        //'doNotCacheResponse' => \Spatie\ResponseCache\Middlewares\DoNotCacheResponse::class,
    ];
}
