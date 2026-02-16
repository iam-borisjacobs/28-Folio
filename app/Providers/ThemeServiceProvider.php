<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ThemeService; // Added this import
use Illuminate\Support\Facades\View; // Added this import

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\Log::info('ThemeServiceProvider booting...');
        $themeService = $this->app->make(ThemeService::class);
        $activeTheme = $themeService->getActiveTheme();
        
        // Register Active Theme Views
        $activePath = $themeService->getThemeViewPath();
        
        if (is_dir($activePath)) {
            $this->app['view']->addNamespace('active_theme', $activePath);
        }
        
        // Register Default Theme Views (Fallback)
        $defaultPath = $themeService->getThemeViewPath('default');
        if (is_dir($defaultPath)) {
            $this->app['view']->addNamespace('default_theme', $defaultPath);
        }
    }
}
