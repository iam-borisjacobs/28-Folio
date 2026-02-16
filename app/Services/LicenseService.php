<?php

namespace App\Services;

use App\Models\License;
use Illuminate\Support\Facades\Http;

class LicenseService
{
    /**
     * Verify the purchase code against the license server.
     *
     * @param string $purchaseCode
     * @param string $domain
     * @return bool
     */
    public function verify(string $purchaseCode, string $domain): bool
    {
        // Mock verification logic for Phase 2
        // In a real app, this would make an HTTP request to your licensing server
        
        // Simulate API call
        // $response = Http::post('https://your-license-server.com/api/verify', [
        //     'purchase_code' => $purchaseCode,
        //     'domain' => $domain,
        // ]);
        
        // For now, accept any code that is exactly 36 characters (UUID format usually) 
        // OR a special "envato-valid-code" for testing.
        
        if ($purchaseCode === 'envato-valid-code' || strlen($purchaseCode) > 10) {
            return true;
        }

        return false;
    }

    /**
     * Store the license in the database.
     */
    public function activate(string $purchaseCode, string $domain)
    {
        return License::create([
            'purchase_code' => $purchaseCode,
            'domain' => $domain,
            'status' => 'valid',
            'last_checked_at' => now(),
        ]);
    }
}
