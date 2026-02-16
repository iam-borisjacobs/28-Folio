<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Services\SettingService;

class RobotsController extends Controller
{
    public function index(SettingService $settings)
    {
        $allowIndexing = $settings->get('allow_indexing', '0');
        
        $content = "User-agent: *\n";
        
        if ($allowIndexing == '1') {
            $content .= "Allow: /\n";
            $content .= "Disallow: /admin/\n";
            $content .= "Sitemap: " . url('sitemap.xml');
        } else {
            $content .= "Disallow: /";
        }

        return response($content, 200)
            ->header('Content-Type', 'text/plain');
    }
}
