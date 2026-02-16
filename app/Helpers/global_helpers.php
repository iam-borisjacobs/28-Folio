<?php
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (! function_exists('setting')) {
    function setting($key = null, $default = null)
    {
        if (is_null($key)) {
            return new \App\Services\SettingService();
        }

        if (is_array($key)) {
            $settingService = app(\App\Services\SettingService::class);
            foreach ($key as $k => $v) {
                $settingService->set($k, $v);
            }
            Cache::forget('settings'); // Clear the cache
            return true;
        }

        $settings = Cache::rememberForever('settings', function () {
            return Setting::all()->pluck('value', 'key');
        });

        return $settings->get($key, $default);
    }
}

if (! function_exists('activity')) {
    function activity()
    {
        return new \App\Services\ActivityService();
    }
}
