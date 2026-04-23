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
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if request is secure or behind HTTPS proxy (Railway SSL termination)
        $isSecure = $request->secure() || $request->header('X-Forwarded-Proto') === 'https';

        if (!$isSecure) {
            return redirect()->secure($request->getRequestUri());
        }

        // Set trusted proxies for Railway
        $request->setTrustedProxies([$request->ip()]);

        return $next($request);
    }
}
