<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SettingService;

class SeoSettingsController extends Controller
{
    protected $settings;

    public function __construct(SettingService $settings)
    {
        $this->settings = $settings;
    }

    public function edit()
    {
        return view('admin.settings.seo', [
            'settings' => $this->settings->all(),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'meta_title_format' => 'required|string|max:255',
            'meta_description_default' => 'nullable|string|max:500',
            'allow_indexing' => 'required|boolean',
            'social_twitter' => 'nullable|string|max:255',
            'social_instagram' => 'nullable|string|max:255',
            'social_linkedin' => 'nullable|string|max:255',
            'social_github' => 'nullable|string|max:255',
        ]);

        foreach ($validated as $key => $value) {
            $this->settings->set($key, $value);
        }

        return back()->with('success', 'SEO settings updated successfully.');
    }
}
