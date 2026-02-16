<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\User;
use App\Services\MetricService;
use Illuminate\Database\Seeder;

class DashboardSeeder extends Seeder
{
    public function run(MetricService $metricService): void
    {
        // 1. Seed Metrics
        $metricService->set('portfolio_views', 1250);
        $metricService->set('total_projects', 0);
        $metricService->set('total_posts', 0);
        $metricService->set('total_leads', 0);

        // 2. Seed Fake Activities
        $admin = User::first(); // Assuming admin exists

        if ($admin) {
            Activity::create([
                'user_id' => $admin->id,
                'action' => 'logged_in',
                'created_at' => now()->subMinutes(5),
            ]);

            Activity::create([
                'user_id' => $admin->id,
                'action' => 'updated_profile',
                'created_at' => now()->subHours(2),
            ]);

            Activity::create([
                'user_id' => $admin->id,
                'action' => 'installed_system',
                'created_at' => now()->subDay(),
            ]);
        }
    }
}
