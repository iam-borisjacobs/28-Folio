<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Services\SettingService;
use Illuminate\Http\Request;

class GeneralSettingsController extends Controller
{
    protected $settings;

    public function __construct(SettingService $settings)
    {
        $this->settings = $settings;
    }

    public function edit()
    {
        return view('admin.settings.general', [
            'settings' => $this->settings->all(),
        ]);
    }

    public function update(Request $request)
    {
        // Manual Security Check (Temporary fix for Middleware issue)
        if (! $request->user() || ! $request->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'primary_email' => 'required|email|max:255',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string|max:1000',
            'hero_image' => 'nullable|image|max:2048', // 2MB Max
        ]);

        // Handle File Upload
        if ($request->hasFile('hero_image')) {
            $path = $request->file('hero_image')->store('settings', 'public');
            $this->settings->set('hero_image', $path);
        }

        // Remove hero_image from validated array so we don't overwrite the path with the file object loop
        unset($validated['hero_image']);

        foreach ($validated as $key => $value) {
            $this->settings->set($key, $value);
        }

        return back()->with('success', 'General settings updated successfully.');
    }
}
