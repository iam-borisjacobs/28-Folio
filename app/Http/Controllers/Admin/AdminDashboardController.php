<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Activity;
use App\Services\MetricService;

class AdminDashboardController extends Controller
{
    public function __invoke(MetricService $metricService, \App\Services\AnalyticsService $analytics)
    {
        // Real Data
        $totalLeads = \App\Models\Lead::count();
        $newLeads = \App\Models\Lead::where('status', 'new')->count();
        $recentLeads = \App\Models\Lead::latest()->take(5)->get();

        $stats = [
            'views' => $analytics->count('page_view'), 
            'projects' => \App\Models\Project::count(),
            'posts' => \App\Models\Post::count(),
            'leads' => $totalLeads,
        ];

        $recent_projects_data = \App\Models\Project::latest()->take(3)->get();
        $recent_projects = [];
        
        foreach($recent_projects_data as $proj) {
            $recent_projects[] = [
                'title' => $proj->title,
                'subtitle' => $proj->categories->first()->name ?? 'No Category',
                'image' => $proj->featured_image ? \Illuminate\Support\Facades\Storage::url($proj->featured_image) : 'https://ui-avatars.com/api/?name=' . urlencode($proj->title) . '&background=random',
                'tags' => $proj->tags->pluck('name')->take(3)->toArray(),
                'views' => $analytics->countForSubject('project_view', $proj),
            ];
        }

        $activities = Activity::with('subject')->latest()->take(5)->get();

        return view('admin.dashboard.index', compact('stats', 'recentLeads', 'recent_projects', 'activities', 'totalLeads', 'newLeads'));
    }
}
