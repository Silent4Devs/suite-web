<?php

namespace App\Http\Middleware;

use App\Http\Controllers\tbApiPanelControlController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TimesheetMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $estado = true;

        if ($estado) {
            return $next($request);
        }

        return redirect()->back()->with('flash_message', 'No tiene permitido accesar a la version historica');
    }
}
