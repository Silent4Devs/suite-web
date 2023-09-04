<?php

namespace App\Http\Middleware;

use App\Models\VersionesIso;
use Closure;
use Illuminate\Http\Request;

class VersionIso2022
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $version_iso = VersionesIso::first();
        $version_iso = $version_iso->version_historico;

        if ($version_iso === false) {
            return $next($request);
        }

        return redirect()->back()->with('flash_message', 'No tiene permitido accesar a la version historica');
    }
}
