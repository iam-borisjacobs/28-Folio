<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    // We can instantiate the actual Livewire component for the Dashboard
    \Illuminate\Support\Facades\Auth::loginUsingId(1);
    
    $t1 = microtime(true);
    // Filament Dashboard uses the route name `filament.admin.pages.dashboard`
    // It maps to \Filament\Pages\Dashboard or our custom one.
    // Let's use Livewire to test it!
    $component = \Livewire\Livewire::mount(\App\Filament\Widgets\CustomDashboardWidget::class);
    $t2 = microtime(true);
    
    echo "Livewire component mounted successfully!\n";
    echo "Time taken: " . ($t2 - $t1) . " seconds\n";
    echo "HTML Length: " . strlen($component) . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
