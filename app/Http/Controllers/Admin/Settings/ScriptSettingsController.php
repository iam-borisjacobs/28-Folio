<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SettingService;

class ScriptSettingsController extends Controller
{
    protected $settings;

    public function __construct(SettingService $settings)
    {
        $this->settings = $settings;
    }

    public function edit()
    {
        return view('admin.settings.scripts', [
            'settings' => $this->settings->all(),
        ]);
    }

    public function update(Request $request)
    {
        // No strict validation on scripts as admins might paste complex JS
        // But we should ensuring they are strings.
        $validated = $request->validate([
            'scripts_head' => 'nullable|string',
            'scripts_body_start' => 'nullable|string',
            'scripts_body_end' => 'nullable|string',
        ]);

        foreach ($validated as $key => $value) {
            $this->settings->set($key, $value);
        }

        return back()->with('success', 'Script settings updated successfully.');
    }
}
