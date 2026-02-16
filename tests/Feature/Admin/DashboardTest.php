<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Lead;
use App\Models\Project;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_can_be_rendered()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard.index');
        $response->assertViewHas(['stats', 'recentLeads', 'recent_projects', 'activities', 'totalLeads', 'newLeads']);
    }

    public function test_dashboard_displays_lead_counts()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create some leads
        Lead::create(['name' => 'Lead 1', 'email' => 'l1@e.com', 'status' => 'new', 'subject' => 's', 'message' => 'm']);
        Lead::create(['name' => 'Lead 2', 'email' => 'l2@e.com', 'status' => 'contacted', 'subject' => 's', 'message' => 'm']);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertViewHas('totalLeads', 2);
        $response->assertViewHas('newLeads', 1);
    }
}
