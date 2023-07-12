<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\VersionesIso;

class VersionIso2022
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $version_iso = VersionesIso::first();
        $version_iso = $version_iso->version_historico;

        if($version_iso === false){
            return $next($request);
        }

        return redirect()->back()->with('flash_message', 'No tiene permitido accesar a la version historica');

    }
}
