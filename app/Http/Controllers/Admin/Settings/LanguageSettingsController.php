<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageSettingsController extends Controller
{
    public function index()
    {
        $languages = Language::orderBy('sort_order')->get();
        return view('admin.settings.languages.index', compact('languages'));
    }

    public function create()
    {
        return view('admin.settings.languages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|size:2|unique:languages,code',
            'is_default' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        if ($request->is_default) {
            Language::where('is_default', true)->update(['is_default' => false]);
        }

        Language::create($validated);
        
        app(\App\Services\LanguageService::class)->clearCache();

        return redirect()->route('admin.settings.languages.index')->with('success', 'Language created successfully.');
    }

    public function edit(Language $language)
    {
        return view('admin.settings.languages.edit', compact('language'));
    }

    public function update(Request $request, Language $language)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|size:2|unique:languages,code,' . $language->id,
            'is_default' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        if ($request->is_default) {
            Language::where('is_default', true)->update(['is_default' => false]);
        }
        
        // Prevent disabling default language
        if ($language->is_default && !$request->is_active) {
            return back()->with('error', 'The default language cannot be disabled.');
        }

        $language->update($validated);

        app(\App\Services\LanguageService::class)->clearCache();

        return redirect()->route('admin.settings.languages.index')->with('success', 'Language updated successfully.');
    }

    public function destroy(Language $language)
    {
        if ($language->is_default) {
            return back()->with('error', 'The default language cannot be deleted.');
        }

        $language->delete();

        app(\App\Services\LanguageService::class)->clearCache();

        return redirect()->route('admin.settings.languages.index')->with('success', 'Language deleted successfully.');
    }
}
