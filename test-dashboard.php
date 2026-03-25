<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $t1 = microtime(true);
    $dashboard = app()->make(App\Filament\Pages\Dashboard::class);
    $reflection = new \ReflectionMethod($dashboard, 'getViewData');
    $reflection->setAccessible(true);
    $data = $reflection->invoke($dashboard);
    $t2 = microtime(true);
    
    echo "Dashboard getViewData success!\n";
    echo "Time taken: " . ($t2 - $t1) . " seconds\n";
    echo "Keys returned: " . implode(', ', array_keys($data)) . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
