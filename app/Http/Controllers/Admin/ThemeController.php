<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ThemeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ThemeController extends Controller
{
    protected $themeService;

    public function __construct(ThemeService $themeService)
    {
        $this->themeService = $themeService;
    }

    public function index()
    {
        $themes = $this->themeService->getInstalledThemes();
        $activeTheme = $this->themeService->getActiveTheme();

        return view('admin.themes.index', compact('themes', 'activeTheme'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'theme_zip' => 'required|file|mimes:zip|max:10240', // 10MB max
        ]);

        $zipFile = $request->file('theme_zip');
        $zipPath = $zipFile->store('temp_themes');

        $zip = new ZipArchive;
        if ($zip->open(storage_path('app/' . $zipPath)) === TRUE) {
            // Extract to a temporary folder first to validate
            $tempExtractPath = storage_path('app/temp_themes_extract/' . uniqid());
            $zip->extractTo($tempExtractPath);
            $zip->close();

            // Find theme.json
            // We assume the ZIP contains a folder with the theme name, OR files directly
            // Let's scan the extracted folder
            $files = File::allFiles($tempExtractPath);
            $themeJsonPath = null;
            $themeRoot = null;

            foreach ($files as $file) {
                if ($file->getFilename() === 'theme.json') {
                    $themeJsonPath = $file->getPathname();
                    $themeRoot = $file->getPath();
                    break;
                }
            }

            if (!$themeJsonPath) {
                File::deleteDirectory($tempExtractPath);
                Storage::delete($zipPath);
                return back()->with('error', 'Invalid theme: theme.json not found.');
            }

            // Read theme.json to get slug
            $themeData = json_decode(File::get($themeJsonPath), true);
            $slug = $themeData['slug'] ?? null;

            if (!$slug) {
                File::deleteDirectory($tempExtractPath);
                Storage::delete($zipPath);
                return back()->with('error', 'Invalid theme: slug missing in theme.json.');
            }

            // Move to themes directory
            $destinationPath = base_path('themes/' . $slug);

            if (File::exists($destinationPath)) {
                // For now, prevent overwrite or ask confirmation (simplifying to fail)
                File::deleteDirectory($tempExtractPath);
                Storage::delete($zipPath);
                return back()->with('error', 'Theme with this slug already exists.');
            }

            File::moveDirectory($themeRoot, $destinationPath);
            
            // Cleanup root temp if it was a nested folder
            File::deleteDirectory($tempExtractPath);
            Storage::delete($zipPath);

            return back()->with('success', 'Theme installed successfully.');
        } else {
            return back()->with('error', 'Failed to open ZIP file.');
        }
    }

    public function activate(Request $request)
    {
        $request->validate([
            'slug' => 'required|string',
        ]);

        if ($this->themeService->setActiveTheme($request->slug)) {
            return back()->with('success', 'Theme activated successfully.');
        }

        return back()->with('error', 'Failed to activate theme.');
    }

    public function destroy($slug)
    {
        if ($slug === 'default') {
            return back()->with('error', 'Cannot delete default theme.');
        }

        $activeTheme = $this->themeService->getActiveTheme();
        if ($activeTheme->slug === $slug) {
            return back()->with('error', 'Cannot delete active theme. Please activate another theme first.');
        }

        $themePath = base_path('themes/' . $slug);
        if (File::exists($themePath)) {
            File::deleteDirectory($themePath);
            return back()->with('success', 'Theme deleted successfully.');
        }

        return back()->with('error', 'Theme not found.');
    }
}
