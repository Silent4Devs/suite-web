<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\Frontend\OrganizacionController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    //return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    Route::get('/', function () {
        return view('frontend.home');
    });

    Route::resource('organizacions', OrganizacionController::class);
    Route::get('portal-comunicacion/reportes', 'PortalComunicacionController@reportes')->name('portal-comunicacion.reportes');
    Route::resource('portal-comunicacion', 'PortalComunicacionController');
    // Organizacions
    /*Route::delete('organizacions/destroy', 'OrganizacionController@massDestroy')->name('organizacions.massDestroy');
    Route::post('organizacions/media', 'OrganizacionController@storeMedia')->name('organizacions.storeMedia');
    Route::post('organizacions/ckmedia', 'OrganizacionController@storeCKEditorImages')->name('organizacions.storeCKEditorImages');
    Route::resource('organizacions', 'OrganizacionController');*/
});
