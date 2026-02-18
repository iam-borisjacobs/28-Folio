<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SettingService;

class BrandingSettingsController extends Controller
{
    protected $settings;

    public function __construct(SettingService $settings)
    {
        $this->settings = $settings;
    }

    public function edit()
    {
        return view('admin.settings.branding', [
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
            'logo_url' => 'nullable|string',
            'favicon_url' => 'nullable|string',
            'social_image_url' => 'nullable|string',
        ]);

        foreach ($validated as $key => $value) {
            $this->settings->set($key, $value);
        }

        return back()->with('success', 'Branding settings updated successfully.');
    }
}
