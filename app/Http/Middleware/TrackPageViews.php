<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\AnalyticsService;

class TrackPageViews
{
    private $analyticsService;

    public function __construct(AnalyticsService $analyticsService)
    {
        $this->analyticsService = $analyticsService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only track GET requests that are not AJAX and not assets
        if ($request->isMethod('GET') && !$request->ajax()) {
            // Exclude admin, api, and debugbar explicitly if needed (though middleware group placement handles most)
            if (!$request->is('admin/*') && !$request->is('api/*') && !$request->is('livewire/*')) {
                $this->analyticsService->track('page_view');
            }
        }

        return $next($request);
    }
}
