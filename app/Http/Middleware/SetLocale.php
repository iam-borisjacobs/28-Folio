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
        $locale = $request->segment(1);
        $activeLanguages = \App\Models\Language::where('is_active', true)->pluck('code')->toArray();
        $defaultLanguage = \App\Models\Language::where('is_default', true)->value('code') ?? 'en';

        if (in_array($locale, $activeLanguages)) {
            app()->setLocale($locale);
            // Share current locale with all views
            view()->share('currentLocale', $locale);
        } else {
             // If URL doesn't have a valid locale prefix, fall back to default
             // Optionally, you could redirect to /{default_locale}/...
             app()->setLocale($defaultLanguage);
             view()->share('currentLocale', $defaultLanguage);
        }

        return $next($request);
    }
}
