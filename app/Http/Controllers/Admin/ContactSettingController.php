<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use Illuminate\Http\Request;

class ContactSettingController extends Controller
{
    public function edit()
    {
        $settings = ContactSetting::current();
        return view('admin.settings.contact', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'notification_email' => 'required|email',
            'success_message' => 'required|string',
            'auto_reply_enabled' => 'nullable|boolean',
            'auto_reply_message' => 'nullable|string',
        ]);

        // Fix checkbox handling
        $validated['auto_reply_enabled'] = $request->has('auto_reply_enabled');

        $settings = ContactSetting::current();
        $settings->update($validated);

        return redirect()->route('admin.settings.contact.edit')->with('success', 'Contact settings updated.');
    }
}
