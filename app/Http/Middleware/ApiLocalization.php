<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiLocalization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->header('lang');
        if ($locale) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
        } else {
            app()->setLocale(config('app.locale'));
        }
        return $next($request);
    }
}
