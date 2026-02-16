<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SettingService;

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
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'primary_email' => 'required|email|max:255',
        ]);

        foreach ($validated as $key => $value) {
            $this->settings->set($key, $value);
        }

        return back()->with('success', 'General settings updated successfully.');
    }
}
