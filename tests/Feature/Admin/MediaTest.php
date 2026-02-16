<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\MediaFolder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MediaTest extends TestCase
{
    use RefreshDatabase;

    public function test_media_page_can_be_rendered()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($admin)->get(route('admin.media.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.media.index');
        $response->assertViewHas(['folders', 'files', 'currentFolder', 'breadcrumbs']);
    }

    public function test_media_folder_navigation()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $folder = MediaFolder::create(['name' => 'Test Folder']);

        $response = $this->actingAs($admin)->get(route('admin.media.index', ['folder_id' => $folder->id]));

        $response->assertStatus(200);
        $response->assertViewHas('currentFolder', function ($viewFolder) use ($folder) {
            return $viewFolder->id === $folder->id;
        });
    }

    public function test_media_file_rendering()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $folder = MediaFolder::create(['name' => 'File Folder']);
        
        // Manual creation since factory is missing
        $media = \App\Models\Media::create([
            'filename' => 'test-image.jpg',
            'path' => 'media/test-image.jpg',
            'mime_type' => 'image/jpeg',
            'size' => 1024,
            'disk' => 'public',
            'folder_id' => $folder->id,
        ]);

        $response = $this->actingAs($admin)->get(route('admin.media.index', ['folder_id' => $folder->id]));

        $response->assertStatus(200);
        $response->assertSee('test-image.jpg');
    }
}
