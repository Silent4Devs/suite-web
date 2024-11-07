<?php

use App\Http\Controllers\Tenant as Controllers;
use App\Http\Middleware\CheckSubscription;
use App\Http\Middleware\OwnerOnly;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Features\UserImpersonation;
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

Route::middleware('tenant', PreventAccessFromCentralDomains::class)->name('tenant.')->group(function () {
    Route::redirect('/', '/home');

    Route::get('/impersonate/{token}', function ($token) {
        return UserImpersonation::makeResponse($token);
    })->name('impersonate');

    Route::post('/ploi/webhook/certificateIssued', [Controllers\PloiWebhookController::class, 'certificateIssued'])->name('ploi.certificate.issued');
    Route::post('/ploi/webhook/certificateRevoked', [Controllers\PloiWebhookController::class, 'certificateRevoked'])->name('ploi.certificate.revoked');

    Route::middleware(['auth', CheckSubscription::class])->group(function () {
        Route::redirect('/home', '/posts')->name('home');

        Route::get('/posts', [Controllers\PostController::class, 'index'])->name('posts.index');
        Route::post('/posts', [Controllers\PostController::class, 'store'])->name('posts.store');
        Route::get('/posts/create', [Controllers\PostController::class, 'create'])->name('posts.create');
        Route::get('/posts/{post}', [Controllers\PostController::class, 'show'])->name('posts.show');

        Route::get('/settings/user', [Controllers\UserSettingsController::class, 'show'])->name('settings.user');
        Route::post('/settings/user/personal', [Controllers\UserSettingsController::class, 'personal'])->name('settings.user.personal');
        Route::post('/settings/user/password', [Controllers\UserSettingsController::class, 'password'])->name('settings.user.password');

        Route::middleware(OwnerOnly::class)->group(function () {
            Route::get('/settings/application', [Controllers\ApplicationSettingsController::class, 'show'])->name('settings.application');
            Route::post('/settings/application/configuration', [Controllers\ApplicationSettingsController::class, 'storeConfiguration'])->name('settings.application.configuration');
            Route::get('/settings/application/invoice/{id}/download', Controllers\DownloadInvoiceController::class)->name('invoice.download');
        });
    });

    Route::namespace('App\\Http\\Controllers\\Tenant')->group(function () {
        Auth::routes();
    });
});
