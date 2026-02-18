<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('locale')) {
            $locale = session('locale');
        } else {
            $locale = config('app.locale');
        }

        $activeLanguages = \App\Models\Language::where('is_active', true)->pluck('code')->toArray();

        if (in_array($locale, $activeLanguages)) {
            app()->setLocale($locale);
        } else {
            app()->setLocale(config('app.fallback_locale'));
        }
        
        // Share current locale with all views
        view()->share('currentLocale', app()->getLocale());

        return $next($request);
    }
}
