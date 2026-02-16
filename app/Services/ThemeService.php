<?php

namespace App\Services;

use App\DTOs\Theme;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class ThemeService
{
    protected string $themesPath;

    public function __construct()
    {
        $this->themesPath = base_path('themes');
    }

    public function getActiveTheme(): Theme
    {
        $slug = setting('active_theme', 'default');
        
        return $this->getTheme($slug) ?? $this->getTheme('default');
    }

    public function getTheme(string $slug): ?Theme
    {
        $path = $this->themesPath . '/' . $slug;
        $jsonPath = $path . '/theme.json';

        if (!File::exists($jsonPath)) {
            return null;
        }

        $data = json_decode(File::get($jsonPath), true);
        
        return Theme::fromArray($data, $path);
    }

    public function getInstalledThemes(): array
    {
        if (!File::exists($this->themesPath)) {
            return [];
        }

        $themes = [];
        $directories = File::directories($this->themesPath);

        foreach ($directories as $directory) {
            $slug = basename($directory);
            $theme = $this->getTheme($slug);
            
            if ($theme) {
                $themes[] = $theme;
            }
        }

        return $themes;
    }

    public function setActiveTheme(string $slug): bool
    {
        if (!$this->getTheme($slug)) {
            return false;
        }

        setting(['active_theme' => $slug]);
        Cache::forget('theme_paths');
        
        return true;
    }

    public function getThemeViewPath(?string $theme = null): string
    {
        $themeSlug = $theme ?? $this->getActiveTheme()->slug;
        return $this->themesPath . '/' . $themeSlug . '/views';
    }
}
