<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "--- Starting Render Test ---\n";
    
    // Simulate what the controller does: return theme_view('welcome');
    // But theme_view uses the helper.
    
    // We can try to render the known welcome view directly first
    echo "Attempting to render: active_theme::welcome with REAL DATA\n";
    try {
        $realProjects = \App\Models\Project::with('categories')->get();
        echo "Fetched " . $realProjects->count() . " projects.\n";
    } catch (\Exception $e) {
        $realProjects = collect([]);
        echo "Failed to fetch projects: " . $e->getMessage() . "\n";
    }

    $data = [
        'projects' => $realProjects,
        'years_experience' => 5,
        'completed_projects' => 10,
        'meta' => ['title' => 'Debug', 'description' => 'Debug']
    ];
    $view = app('view')->make('active_theme::welcome', $data)->render();
    echo "Render Success! Length: " . strlen($view) . "\n";

    echo "Attempting to render direct: partials.header\n";
    $view2 = app('view')->make('partials.header')->render();
    echo "Partial Render Success! Length: " . strlen($view2) . "\n";
    
} catch (\Throwable $e) {
    echo "!!! EXCEPTION CAUGHT !!!\n";
    echo "Message: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "\nStack Trace:\n";
    echo $e->getTraceAsString();
}
