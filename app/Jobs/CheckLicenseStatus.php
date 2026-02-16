<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CheckLicenseStatus implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(\App\Services\LicenseService $licenseService): void
    {
        $license = \App\Models\License::first();

        if (! $license) {
            return; // No license to check
        }

        // Re-verify
        $isValid = $licenseService->verify($license->purchase_code, $license->domain);

        $license->update([
            'status' => $isValid ? 'valid' : 'invalid',
            'last_checked_at' => now(),
        ]);
    }
}
