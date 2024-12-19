<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        \Illuminate\Http\Middleware\HandleCors::class,
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\Tabantaj\TrustProxies::class,
        \App\Http\Middleware\Tabantaj\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\Tabantaj\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\Tabantaj\Cors::class,
        //\App\Http\Middleware\XFrameHeadersMiddleware::class,
    ];

    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\Tabantaj\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \App\Http\Middleware\RedirectIfAuthenticated::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\Tabantaj\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            // \App\Http\Middleware\LazyLoadImages::class,
            \App\Http\Middleware\Tabantaj\SetLocale::class,
            //laravel-page-speed
            // \RenatoMarinho\LaravelPageSpeed\Middleware\InlineCss::class,
            // //\RenatoMarinho\LaravelPageSpeed\Middleware\ElideAttributes::class,
            //\RenatoMarinho\LaravelPageSpeed\Middleware\InsertDNSPrefetch::class,
            // \RenatoMarinho\LaravelPageSpeed\Middleware\RemoveComments::class,
            //\RenatoMarinho\LaravelPageSpeed\Middleware\CollapseWhitespace::class,
            //\RenatoMarinho\LaravelPageSpeed\Middleware\DeferJavascript::class,
            \App\Http\Middleware\Tabantaj\Auth\AuthGates::class,
            \App\Http\Middleware\Tenant\TbTenantMiddleware::class,

        ],
        'api' => [
            'throttle:200,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        'universal' => [],


    ];

    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Tabantaj\Auth\Authenticate::class,
        'active' => \App\Http\Middleware\Tabantaj\User\ActiveUser::class,
        'isActive' => \App\Http\Middleware\Tabantaj\User\IsActiveUser::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\Tabantaj\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'admin' => \App\Http\Middleware\Tabantaj\User\IsAdmin::class,
        '2fa' => \App\Http\Middleware\Tabantaj\TwoFactorMiddleware::class,
        'cors' => \App\Http\Middleware\Tabantaj\Cors::class,
        'primeros.pasos' => \App\Http\Middleware\Tabantaj\User\PrimerosPasos::class,
        'version_iso_2013' => \App\Http\Middleware\Tabantaj\VersionIso2013::class,
        'version_iso_2022' => \App\Http\Middleware\Tabantaj\VersionIso2022::class,
        'doNotCacheResponse' => \Spatie\ResponseCache\Middlewares\DoNotCacheResponse::class,
        'cacheResponse' => \Spatie\ResponseCache\Middlewares\CacheResponse::class,
        'course' => \App\Http\Middleware\Tabantaj\CourseMiddleware::class,
        // 'XssSanitization' => \App\Http\Middleware\XssSanitization::class,
        //milddleware control accesos tenant
        'tenant' => \App\Http\Middleware\Tenant\TBTenantMiddleware::class,
        'Tbcheck.token.expiration' => \App\Http\Middleware\Tenant\TBTenantCheckTokenExpiration::class,
        'general_tabantaj' => \App\Http\Middleware\Tenant\TBTenantGeneralTabantajMiddleware::class,
        'gestion_contractual' => \App\Http\Middleware\Tenant\TBTenantGestionContractualMiddleware::class,
        'gestion_financiera' => \App\Http\Middleware\Tenant\TBTenantGestionFinancieraMiddleware::class,
        'katbol' => \App\Http\Middleware\Tenant\TBTenantKatbolMiddleware::class,
        'silent_4_university' => \App\Http\Middleware\Tenant\TBTenantSilent4UniversityMiddleware::class,
        'gestion_talento' => \App\Http\Middleware\Tenant\TBTenantGestionTalentoMiddleware::class,
        'gestion_normativa' => \App\Http\Middleware\Tenant\TBTenantGestionNormativaMiddleware::class,
        'centro_atencion' => \App\Http\Middleware\Tenant\TBTenantCentroAtencionMiddleware::class,
        'timesheet' => \App\Http\Middleware\Tenant\TBTenantTimesheetMiddleware::class,
        'visitantes' => \App\Http\Middleware\Tenant\TBTenantVisitantesMiddleware::class,
        'planes_trabajo' => \App\Http\Middleware\Tenant\TBTenantPlanesTrabajoMiddleware::class,
        'gestor_documental' => \App\Http\Middleware\Tenant\TBTenantGestorDocumentalMiddleware::class,
    ];

    protected $middlewareAliases = [
        'doNotCacheResponse' => \Spatie\ResponseCache\Middlewares\DoNotCacheResponse::class,
    ];
}
