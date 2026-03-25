<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

try {
    // Capture the request but change the URI to /admin
    $_SERVER['REQUEST_URI'] = '/admin';
    $_SERVER['REQUEST_METHOD'] = 'GET';
    $request = Illuminate\Http\Request::capture();
    
    // We need to bootstrap first to use Eloquent
    $kernel->bootstrap();

    // Authenticate a user
    $user = \App\Models\User::first();
    \Illuminate\Support\Facades\Auth::login($user);
    $request->setUserResolver(function () use ($user) {
        return $user;
    });

    $t1 = microtime(true);
    $response = $kernel->handle($request);
    $t2 = microtime(true);

    echo "Status: " . $response->status() . "\n";
    echo "Time taken: " . ($t2 - $t1) . " seconds\n";
    
    if ($response->status() >= 500) {
        if (isset($response->exception) && $response->exception) {
            echo "Exception: " . $response->exception->getMessage() . "\n";
            echo "File: " . $response->exception->getFile() . ":" . $response->exception->getLine() . "\n";
        }
    } else {
        echo substr($response->getContent(), 0, 500);
    }
} catch (\Exception $e) {
    echo "Fatal Error: " . $e->getMessage() . "\n";
}
