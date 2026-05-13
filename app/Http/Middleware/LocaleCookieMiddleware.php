<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LocaleCookieMiddleware
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
        $allowedLocales = ['es', 'en'];
        $locale = $request->cookie('locale', app()->getLocale());
        
        if (!in_array($locale, $allowedLocales)) {
            $locale = config('app.locale');
        }

        if ($locale !== app()->getLocale()) {
            app()->setLocale($locale);
        }
        return $next($request);
    }
}