<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Restrict who can embed this site without restricting its external video/map embeds.
        // Append a separate policy so existing application policies remain in effect.
        $response->headers->set('Content-Security-Policy', "frame-ancestors 'self'", false);

        return $response;
    }
}