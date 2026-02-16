<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstallController extends Controller
{
    public function requirements()
    {
        $requirements = [
            'PHP >= 8.2' => version_compare(PHP_VERSION, '8.2.0', '>='),
            'bcmath' => extension_loaded('bcmath'),
            'ctype' => extension_loaded('ctype'),
            'json' => extension_loaded('json'),
            'mbstring' => extension_loaded('mbstring'),
            'openssl' => extension_loaded('openssl'),
            'pdo' => extension_loaded('pdo'),
            'tokenizer' => extension_loaded('tokenizer'),
            'xml' => extension_loaded('xml'),
            'curl' => extension_loaded('curl'),
        ];

        $permissions = [
            'storage/app' => is_writable(storage_path('app')),
            'storage/framework' => is_writable(storage_path('framework')),
            'storage/logs' => is_writable(storage_path('logs')),
            'bootstrap/cache' => is_writable(base_path('bootstrap/cache')),
        ];

        return view('install.requirements', compact('requirements', 'permissions'));
    }

    public function database() { return view('install.database'); }
    public function storeDatabase(\Illuminate\Http\Request $request, \App\Services\EnvWriterService $envWriter)
    {
        $request->validate([
            'db_host' => 'required',
            'db_port' => 'required',
            'db_database' => 'required',
            'db_username' => 'required',
        ]);

        try {
            // Test connection
            $pdo = new \PDO(
                "mysql:host={$request->db_host};port={$request->db_port};dbname={$request->db_database}",
                $request->db_username,
                $request->db_password
            );
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            return back()->withErrors(['connection' => 'Could not connect to database: ' . $e->getMessage()])->withInput();
        }

        // Update .env
        $envWriter->update([
            'DB_HOST' => $request->db_host,
            'DB_PORT' => $request->db_port,
            'DB_DATABASE' => $request->db_database,
            'DB_USERNAME' => $request->db_username,
            'DB_PASSWORD' => $request->db_password,
        ]);

        // Run migrations
        try {
            \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        } catch (\Exception $e) {
            return back()->withErrors(['migration' => 'Migration failed: ' . $e->getMessage()])->withInput();
        }

        return redirect()->route('install.admin');
    }
    public function admin() { return view('install.admin'); }
    public function storeAdmin(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'admin',
        ]);

        $user->markEmailAsVerified();

        \Illuminate\Support\Facades\Auth::login($user);

        return redirect()->route('install.license');
    }
    public function license() { return view('install.license'); }
    public function storeLicense(\Illuminate\Http\Request $request, \App\Services\LicenseService $licenseService)
    {
        $request->validate([
            'purchase_code' => 'required|string',
        ]);

        $domain = $request->getHost();

        if (! $licenseService->verify($request->purchase_code, $domain)) {
            return back()->withErrors(['purchase_code' => 'Invalid purchase code or license already in use.'])->withInput();
        }

        $licenseService->activate($request->purchase_code, $domain);

        return redirect()->route('install.finish');
    }

    public function finish()
    {
        // 1. Create installed file
        file_put_contents(storage_path('app/installed'), 'INSTALLED ON ' . now());

        // 2. Seed database (if not already done)
        try {
            \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
        } catch (\Exception $e) {
            // Seeding might fail if already seeded, but we proceed
        }

        return redirect()->route('admin.dashboard');
    }
}
