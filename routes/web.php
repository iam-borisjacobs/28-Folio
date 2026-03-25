<?php

Route::any('/debug-test', function () {
    dd('DEBUG ROUTE HIT', [
        'Method' => request()->method(),
        'Url' => request()->url(),
        'Input' => request()->all(),
    ]);
})->name('debug.post');

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\BlogController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\ProjectController;
use App\Http\Controllers\Public\RobotsController;
use App\Http\Controllers\Public\SitemapController;
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

// The home route is now handled dynamically by the fallback `/{slug?}` route at the bottom of this file.

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

// Admin Routes (Now handled directly by Filament Resources)

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
Route::get('/lang/{locale}', [\App\Http\Controllers\Public\LanguageController::class, 'switch'])->name('lang.switch');

// Auth Routes
require __DIR__.'/auth.php';

// Dynamic Page Builder Route (Must be last)
Route::get('/{slug?}', [\App\Http\Controllers\PageController::class, 'show'])
    ->where('slug', '.*')
    ->name('page.show');
