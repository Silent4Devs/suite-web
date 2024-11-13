<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // Check if the language should be changed via the request
        if (request('change_language')) {
            session()->put('language', request('change_language'));
            $language = request('change_language');
        } elseif (session('language')) {
            // Use the session language if available
            $language = session('language');
        } elseif (config('panel.primary_language')) {
            // Use the primary language configured in the settings
            $language = config('panel.primary_language');
        }

        // Ensure $language is set; if not, fall back to a default language
        $language = $language ?? config('app.fallback_locale', 'en'); // 'en' is the default

        // Set the application locale
        app()->setLocale($language);

        // Continue to the next middleware
        return $next($request);
    }
}
