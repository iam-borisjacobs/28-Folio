<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserFlowTest extends TestCase
{
    use RefreshDatabase;
    public function test_guest_cannot_access_admin_dashboard()
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_admin_can_login_and_access_dashboard()
    {
        $user = \App\Models\User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/admin/dashboard');

        $response = $this->actingAs($user)->get('/admin/dashboard');
        $response->assertStatus(200);
    }

    public function test_non_admin_cannot_access_dashboard()
    {
        $user = \App\Models\User::factory()->create([
            'role' => 'user',
        ]);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    public function test_admin_can_access_settings_page()
    {
        $user = \App\Models\User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)->get('/admin/settings/general');

        $response->assertStatus(200);
        $response->assertSee('General Settings');
    }
}
