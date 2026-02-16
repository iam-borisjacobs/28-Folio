<?php

namespace App\Services;

use App\Models\Language;
use Illuminate\Support\Facades\Cache;

class LanguageService
{
    public function getActiveLanguages()
    {
        return Cache::rememberForever('active_languages', function () {
            return Language::active()->get();
        });
    }

    public function getDefaultLanguage()
    {
        return Cache::rememberForever('default_language', function () {
            return Language::where('is_default', true)->first() ?? new Language(['code' => 'en', 'name' => 'English']);
        });
    }

    public function clearCache()
    {
        Cache::forget('active_languages');
        Cache::forget('default_language');
    }
}
