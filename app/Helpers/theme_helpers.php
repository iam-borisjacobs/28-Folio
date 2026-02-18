<?php

use App\Services\ThemeService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

if (! function_exists('theme_path')) {
    function theme_path(string $path = ''): string
    {
        $themeService = app(ThemeService::class);
        $activeTheme = $themeService->getActiveTheme();

        return base_path('themes/'.$activeTheme->slug.($path ? DIRECTORY_SEPARATOR.$path : ''));
    }
}

if (! function_exists('theme_view')) {
    function theme_view(string $view, array $data = [], array $mergeData = [])
    {
        $themeService = app(ThemeService::class);
        $activeTheme = $themeService->getActiveTheme();

        // Check if the view exists in the theme
        $themeView = 'themes.'.$activeTheme->slug.'.'.$view;

        // Register the theme namespace on the fly if needed, or rely on a standard convention
        // For now, let's assume we add a namespace 'theme' that points to the active theme
        // But a cleaner way is to manually check file existence or just double check paths

        // However, standard Laravel View::addLocation or View::addNamespace is better done in ServiceProvider
        // But we want this dynamic.

        // Let's try adding the namespace dynamically if it's not set, or just use the path
        // Actually, we can just register 'themes' directory as a namespace 'themes' in the Provider
        // And then return view("themes::{$activeTheme->slug}.{$view}", ...)

        // But the user constraint says:
        // "Instead of view('projects.show') Use theme_view('projects.show')"
        // "Custom helper resolves: themes/{active}/views/projects/show.blade.php"

        // So we need to return a View factory instance

        $factory = app(\Illuminate\View\Factory::class);

        // Try theme specific view first
        // We will register a namespace 'active_theme' in the ThemeServiceProvider that points to the active theme's view folder
        // So we can just return view("active_theme::{$view}")

        if ($factory->exists("active_theme::{$view}")) {
            return $factory->make("active_theme::{$view}", $data, $mergeData);
        }

        // Fallback to default theme-less view if needed, or explicitly fail?
        // User said "Fallback to default theme if file missing."

        if ($activeTheme->slug !== 'default') {
            if ($factory->exists("default_theme::{$view}")) {
                return $factory->make("default_theme::{$view}", $data, $mergeData);
            }
        }

        // Last resort fallback to standard resource/views
        return $factory->make($view, $data, $mergeData);
    }
}

if (! function_exists('theme_asset')) {
    function theme_asset(string $path): string
    {
        $themeService = app(ThemeService::class);
        $activeTheme = $themeService->getActiveTheme();

        // This assumes assets are published to public/themes/{slug}
        // or served via a route (less efficient)
        // User requirement: "Themes store assets in: themes/{slug}/assets"
        // And "Returns proper URL."

        // We will likely need a symlink or a route. Symlink is better for performance.
        // For now, let's assume we maintain a symlink public/themes -> themes/
        // OR public/themes/{slug} -> themes/{slug}/assets

        return asset("themes/{$activeTheme->slug}/{$path}");
    }
}
