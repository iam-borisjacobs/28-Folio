<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Activity;
use App\Models\Lead;
use App\Models\Project;
use App\Models\Post;
use App\Services\AnalyticsService;

class CustomDashboardWidget extends Widget
{
    protected static string $view = 'filament.pages.dashboard';
    protected int | string | array $columnSpan = 'full';

    public array $stats = [];
    public array $recent_projects = [];
    public array $recentLeads = [];
    public array $activities = [];
    public int $totalLeads = 0;
    public int $newLeads = 0;

    public function mount(): void
    {
        $analytics = app(AnalyticsService::class);
        $this->totalLeads = Lead::count();
        $this->newLeads = Lead::where('status', 'new')->count();
        $this->recentLeads = Lead::latest()->take(5)->get()->toArray();

        $this->stats = [
            'views' => $analytics->count('page_view'), 
            'projects' => Project::count(),
            'posts' => Post::count(),
            'leads' => $this->totalLeads,
        ];
        $recent_projects_data = Project::latest()->take(3)->get();
        $this->recent_projects = [];
        foreach($recent_projects_data as $proj) {
            $this->recent_projects[] = [
                'title' => $proj->title,
                'subtitle' => $proj->categories->first()->name ?? 'No Category',
                'image' => $proj->featured_image ? \Illuminate\Support\Facades\Storage::url($proj->featured_image) : null,
                'tags' => $proj->tags->pluck('name')->take(3)->toArray(),
                'views' => $analytics->countForSubject('project_view', $proj),
            ];
        }

        $this->activities = Activity::with('subject')->latest()->take(5)->get()->toArray();
    }
}
