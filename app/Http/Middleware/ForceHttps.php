<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceHttps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  \next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Set trusted proxies for Railway
        $request->setTrustedProxies(
            [$request->ip()],
            Request::HEADER_X_FORWARDED_FOR |
            Request::HEADER_X_FORWARDED_HOST |
            Request::HEADER_X_FORWARDED_PORT |
            Request::HEADER_X_FORWARDED_PROTO
        );

        // Force HTTPS URLs generation
        \URL::forceScheme('https');

        // Only redirect if not secure and not POST/PUT/PATCH
        if (!$request->secure() && 
            !in_array($request->method(), ['POST', 'PUT', 'PATCH']) &&
            $request->header('X-Forwarded-Proto') !== 'https') {
            return redirect()->secure($request->getRequestUri(), 301);
        }

        return $next($request);
    }
}
