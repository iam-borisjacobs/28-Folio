<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $dashboard = app(App\Filament\Pages\Dashboard::class);
    $reflection = new \ReflectionMethod($dashboard, 'getViewData');
    $reflection->setAccessible(true);
    $data = $reflection->invoke($dashboard);
    
    // Add missing filament properties (page properties usually injected by Livewire)
    // Actually, we might need a Livewire component context.
    // Let's just try to render it simply.
    
    $user = \App\Models\User::first();
    \Illuminate\Support\Facades\Auth::login($user);

    $t1 = microtime(true);
    $html = view('filament.pages.dashboard', $data)->render();
    $t2 = microtime(true);
    
    echo "View rendered successfully!\n";
    echo "Time taken: " . ($t2 - $t1) . " seconds\n";
    echo "HTML length: " . strlen($html) . " bytes\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
