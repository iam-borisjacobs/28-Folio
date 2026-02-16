<?php

namespace App\Services;

class EnvWriterService
{
    /**
     * Update the .env file with the given data.
     *
     * @param  array  $data
     * @return void
     */
    public function update(array $data)
    {
        $path = base_path('.env');

        if (! file_exists($path)) {
            return;
        }

        $content = file_get_contents($path);

        foreach ($data as $key => $value) {
            // Wrap value in quotes if it contains spaces and isn't already quoted
            if (str_contains($value, ' ') && ! str_starts_with($value, '"')) {
                $value = '"' . $value . '"';
            }

            // Check if key exists
            if (preg_match("/^{$key}=.*/m", $content)) {
                // Replace existing key
                $content = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $content);
            } else {
                // Append new key
                $content .= "\n{$key}={$value}";
            }
        }

        file_put_contents($path, $content);
    }
}
