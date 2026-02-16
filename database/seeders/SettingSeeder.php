<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General
            'site_name' => '28 Folio',
            'site_description' => 'A modern portfolio system for creative professionals.',
            'site_tagline' => 'Showcase your work with style',
            'primary_email' => 'hello@example.com',
            
            // Branding (Placeholders)
            'logo_url' => null,
            'favicon_url' => null,
            'social_image_url' => null,

            // SEO
            'meta_title_format' => '%page% | %site%',
            'meta_description_default' => 'Welcome to my portfolio.',
            'allow_indexing' => '0', // Default to noindex until ready

            // Social
            'social_twitter' => '@twitter',
            'social_instagram' => '@instagram',
            'social_linkedin' => '',
            'social_github' => '',

            // Scripts
            'scripts_head' => '',
            'scripts_body_start' => '',
            'scripts_body_end' => '',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
