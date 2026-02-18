<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingService
{
    /**
     * Get a setting value by key.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        // Cache settings forever (or until updated)
        return Cache::rememberForever("setting.{$key}", function () use ($key, $default) {
            $setting = Setting::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set a setting value by key.
     *
     * @param string $key
     * @param mixed $value
     * @return Setting
     */
    public function set(string $key, $value)
    {
        $setting = Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        // Clear cache for this key
        Cache::forget("setting.{$key}");
        // Clear global settings cache
        Cache::forget('settings');

        return $setting;
    }

    /**
     * Forget a setting (delete it).
     *
     * @param string $key
     * @return bool
     */
    public function forget(string $key)
    {
        Cache::forget("setting.{$key}");
        Cache::forget('settings');
        return Setting::where('key', $key)->delete();
    }
    
    /**
     * Get all settings as key-value pairs.
     * Useful for clearing cache or debugging.
     */
    public function all()
    {
         return Setting::all()->pluck('value', 'key');
    }
}
