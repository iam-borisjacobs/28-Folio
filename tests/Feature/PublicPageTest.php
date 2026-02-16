<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublicPageTest extends TestCase
{
    use RefreshDatabase;
    public function test_home_page_loads()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee(config('app.name'));
    }

    public function test_projects_page_loads()
    {
        $response = $this->get('/projects');
        $response->assertStatus(200);
    }

    public function test_blog_page_loads()
    {
        $response = $this->get('/blog');
        $response->assertStatus(200);
    }

    public function test_contact_page_loads()
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
    }

    public function test_sitemap_loads()
    {
        $response = $this->get('/sitemap.xml');
        $response->assertStatus(200);
        $this->assertTrue(str_contains(strtolower($response->headers->get('Content-Type')), 'text/xml; charset=utf-8'));
    }

    public function test_robots_loads()
    {
        $response = $this->get('/robots.txt');
        $response->assertStatus(200);
        $this->assertTrue(str_contains(strtolower($response->headers->get('Content-Type')), 'text/plain; charset=utf-8'));
    }
}
