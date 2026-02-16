<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\BlogController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\ProjectController;
use App\Http\Controllers\Public\RobotsController;
use App\Http\Controllers\Public\SitemapController;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home Route
Route::get('/', function () {
    $projects = Project::where('status', 'published')
        ->with(['translations', 'categories', 'tags'])
        ->orderBy('is_featured', 'desc')
        ->latest('published_at')
        ->take(6)
        ->get();

    return theme_view('welcome', compact('projects'));
})->name('home');

// Dashboard Redirect
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Auth Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'verified', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', App\Http\Controllers\Admin\AdminDashboardController::class)->name('dashboard');

    // Projects
    Route::resource('projects/categories', \App\Http\Controllers\Admin\ProjectCategoryController::class, ['as' => 'projects']);
    Route::resource('projects/tags', \App\Http\Controllers\Admin\ProjectTagController::class, ['as' => 'projects']);
    Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class);

    // Content
    Route::get('/pages', [App\Http\Controllers\Admin\AdminController::class, 'pages'])->name('pages.index');

    // Blog (Posts, Categories, Tags)
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::resource('categories', \App\Http\Controllers\Admin\PostCategoryController::class);
        Route::resource('tags', \App\Http\Controllers\Admin\PostTagController::class);
    });
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);

    // Resume Builder
    Route::prefix('resume')->name('resume.')->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.resume.experience.index');
        })->name('index');

        Route::resource('experience', \App\Http\Controllers\Admin\Resume\ExperienceController::class);
        Route::resource('education', \App\Http\Controllers\Admin\Resume\EducationController::class);
        Route::resource('skills', \App\Http\Controllers\Admin\Resume\SkillController::class);
        Route::resource('certifications', \App\Http\Controllers\Admin\Resume\CertificationController::class);
        Route::resource('awards', \App\Http\Controllers\Admin\Resume\AwardController::class);
    });
    // Media Manager
    Route::prefix('media')->name('media.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\MediaController::class, 'index'])->name('index');
        Route::post('/upload', [App\Http\Controllers\Admin\MediaController::class, 'upload'])->name('upload');
        Route::post('/folders', [App\Http\Controllers\Admin\MediaController::class, 'storeFolder'])->name('folders.store');
        Route::delete('/{media}', [App\Http\Controllers\Admin\MediaController::class, 'destroy'])->name('destroy');
        Route::delete('/folders/{folder}', [App\Http\Controllers\Admin\MediaController::class, 'destroyFolder'])->name('folders.destroy');
    });

    // Leads
    Route::resource('leads', \App\Http\Controllers\Admin\LeadController::class)->only(['index', 'show', 'update', 'destroy']);

    // Analytics
    Route::get('/analytics', [App\Http\Controllers\Admin\AdminController::class, 'analytics'])->name('analytics.index');

    // Appearance / Themes
    Route::get('themes', [\App\Http\Controllers\Admin\ThemeController::class, 'index'])->name('themes.index');
    Route::post('themes', [\App\Http\Controllers\Admin\ThemeController::class, 'store'])->name('themes.store');
    Route::post('themes/activate', [\App\Http\Controllers\Admin\ThemeController::class, 'activate'])->name('themes.activate');
    Route::delete('themes/{slug}', [\App\Http\Controllers\Admin\ThemeController::class, 'destroy'])->name('themes.destroy');
    Route::get('/addons', [App\Http\Controllers\Admin\AdminController::class, 'addons'])->name('addons.index');

    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'settings'])->name('index');

        Route::resource('languages', \App\Http\Controllers\Admin\Settings\LanguageSettingsController::class);

        Route::get('/general', [\App\Http\Controllers\Admin\Settings\GeneralSettingsController::class, 'edit'])->name('general');
        Route::post('/general', [\App\Http\Controllers\Admin\Settings\GeneralSettingsController::class, 'update']);

        Route::get('/branding', [\App\Http\Controllers\Admin\Settings\BrandingSettingsController::class, 'edit'])->name('branding');
        Route::post('/branding', [\App\Http\Controllers\Admin\Settings\BrandingSettingsController::class, 'update']);

        Route::get('/seo', [\App\Http\Controllers\Admin\Settings\SeoSettingsController::class, 'edit'])->name('seo');
        Route::post('/seo', [\App\Http\Controllers\Admin\Settings\SeoSettingsController::class, 'update']);

        Route::get('/scripts', [\App\Http\Controllers\Admin\Settings\ScriptSettingsController::class, 'edit'])->name('scripts');
        Route::post('/scripts', [\App\Http\Controllers\Admin\Settings\ScriptSettingsController::class, 'update']);

        Route::get('/contact', [\App\Http\Controllers\Admin\ContactSettingController::class, 'edit'])->name('contact.edit');
        Route::put('/contact', [\App\Http\Controllers\Admin\ContactSettingController::class, 'update'])->name('contact.update');
    });
    Route::get('/license', [App\Http\Controllers\Admin\AdminController::class, 'license'])->name('license.index');
    Route::get('/backups', [App\Http\Controllers\Admin\AdminController::class, 'backups'])->name('backups.index');
});

// Install Routes
Route::prefix('install')->name('install.')->group(function () {
    Route::get('/requirements', [App\Http\Controllers\InstallController::class, 'requirements'])->name('requirements');
    Route::get('/database', [App\Http\Controllers\InstallController::class, 'database'])->name('database');
    Route::post('/database', [App\Http\Controllers\InstallController::class, 'storeDatabase'])->name('database.store');
    Route::get('/admin', [App\Http\Controllers\InstallController::class, 'admin'])->name('admin');
    Route::post('/admin', [App\Http\Controllers\InstallController::class, 'storeAdmin'])->name('admin.store');
    Route::get('/license', [App\Http\Controllers\InstallController::class, 'license'])->name('license');
    Route::post('/license', [App\Http\Controllers\InstallController::class, 'storeLicense'])->name('license.store');
    Route::get('/finish', [App\Http\Controllers\InstallController::class, 'finish'])->name('finish');
});

// Public Routes (Projects, Blog, Contact, Sitemap, Robots)
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [RobotsController::class, 'index'])->name('robots');

// Auth Routes
require __DIR__.'/auth.php';
