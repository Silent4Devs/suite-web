<?php

namespace App\Http\Middleware\Tabantaj;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // header('Access-Control-Allow-Origin:  *');
        //header('Access-Control-Allow-Origin:  http://localhost:4200');
        // header('Access-Control-Allow-Origin', '*');
        // header('Access-Control-Allow-Methods', '*');
        // header('Access-Control-Allow-Credentials', true);
        // header('Access-Control-Allow-Headers', 'X-Requested-With,Content-Type,X-Token-Auth,Authorization');
        // header('Accept', 'application/json');
        $IlluminateResponse = 'Illuminate\Http\Response';
        $SymfonyResopnse = 'Symfony\Component\HttpFoundation\Response';
        $headers = [
            'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Authorization, Origin',
            // 'Access-Control-Allow-Methods' => 'POST, PUT',
            // 'Access-Control-Allow-Headers' => 'Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Authorization , Access-Control-Request-Headers',
        ];

        if ($request->getMethod() == 'OPTIONS') {
            return response()->json('ok', 200, $headers);
        }

        $response = $next($request);
        if ($response instanceof $IlluminateResponse) {
            foreach ($headers as $key => $value) {
                $response->header($key, $value);
            }

            return $response;
        }

        if ($response instanceof $SymfonyResopnse) {
            foreach ($headers as $key => $value) {
                $response->headers->set($key, $value);
            }

            return $response;
        }

        //return $next($request);
        return $response;
    }
}
