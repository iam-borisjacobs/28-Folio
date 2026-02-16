<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureApplicationIsInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $installed = file_exists(storage_path('app/installed'));

        // If app is installed, block access to installer routes
        if ($installed && $request->is('install*')) {
            return redirect()->route('admin.dashboard');
        }

        // If app is NOT installed, force redirect to installer (except for installer routes)
        if (! $installed && ! $request->is('install*')) {
            return redirect()->route('install.requirements');
        }

        return $next($request);
    }
}
