<?php

namespace App\Services;

use App\Models\Metric;
use Illuminate\Support\Facades\Cache;

class MetricService
{
    /**
     * Increment a metric value.
     */
    public function increment(string $key, int $amount = 1): int
    {
        $metric = Metric::firstOrCreate(['key' => $key], ['value' => 0]);
        $metric->increment('value', $amount);
        
        Cache::forget("metric.{$key}");

        return $metric->value;
    }

    /**
     * Get a metric value (cached).
     */
    public function get(string $key): int
    {
        return Cache::remember("metric.{$key}", 60, function () use ($key) {
            return Metric::where('key', $key)->value('value') ?? 0;
        });
    }

    /**
     * Set a metric value directly.
     */
    public function set(string $key, int $value): int
    {
        $metric = Metric::updateOrCreate(['key' => $key], ['value' => $value]);
        
        Cache::forget("metric.{$key}");

        return $metric->value;
    }
}
