<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class XFrameHeadersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // Enumerate headers which you do not want in your application's responses.
    // Great starting point would be to go check out @Scott_Helme's:
    // https://securityheaders.com/
    private $unwantedHeaderList = [
        'X-Powered-By',
        'Server',
    ];

    public function handle($request, Closure $next)
    {
        /*
         * This middleware was created to prevent OWASP warnings, like:
         *
         * The X-Frame-Options header is not set in the HTTP response, meaning the page can potentially be loaded into
         * an attacker-controlled frame. This could lead to clickjacking, where an attacker adds an invisible layer on
         * top of the legitimate page to trick users into clicking on a malicious link or taking a harmful action.
         *
         * The X-Frame-Options allows three values: DENY, SAMEORIGIN and ALLOW-FROM. It is recommended to use DENY,
         * which prevents all domains from framing the page or SAMEORIGIN, which allows framing only by the same site.
         * DENY and SAMEORGIN are supported by all browsers. Using ALLOW-FROM is not recommended because not all browsers support it.
         *
         * For more information, access: https://cheatsheetseries.owasp.org/cheatsheets/Clickjacking_Defense_Cheat_Sheet.html
         *
         */
        $this->removeUnwantedHeaders($this->unwantedHeaderList);
        $response = $next($request);
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');
        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Frame-Options', 'DENY');
        //$response->headers->set('X-Frame-Options', 'SAMEORIGIN', false);
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        //$response->headers->set('Access-Control-Allow-Origin', '*');
        //$response->headers->set('Content-Security-Policy', "style-src 'self'"); // Clearly, you will be more elaborate here.
        return $response;
    }

    private function removeUnwantedHeaders($headerList)
    {
        foreach ($headerList as $header) {
            header_remove($header);
        }
    }
}
