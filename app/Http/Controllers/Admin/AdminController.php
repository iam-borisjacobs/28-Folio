<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {
        $totalLeads = \App\Models\Lead::count();
        $newLeads = \App\Models\Lead::where('status', 'new')->count();
        $recentLeads = \App\Models\Lead::latest()->take(5)->get();
        return view('admin.dashboard.index', compact('totalLeads', 'newLeads', 'recentLeads'));
    }
    public function pages() { return view('admin.pages.index'); }
    public function projects() { return view('admin.projects.index'); }
    public function blog() { return view('admin.blog.index'); }
    public function resume() { return view('admin.resume.index'); }
    // public function leads() { return view('admin.leads.index'); } // Now handled by LeadController
    public function analytics(\App\Services\AnalyticsService $analytics) {
        $stats = [
            'views' => $analytics->count('page_view'),
            'projects' => $analytics->count('project_view'),
            'posts' => $analytics->count('post_view'),
        ];
        
        $recentEvents = \App\Models\AnalyticsEvent::with('subject')->latest()->take(20)->get();
        
        return view('admin.analytics.index', compact('stats', 'recentEvents'));
    }
    public function themes() { return view('admin.themes.index'); }
    public function addons() { return view('admin.addons.index'); }
    public function settings() { return view('admin.settings.index'); }
    public function license() { return view('admin.license.index'); }
    public function backups() { return view('admin.backups.index'); }
}
