<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('status', 'published')
            ->with(['translations', 'categories', 'tags'])
            ->orderBy('is_featured', 'desc')
            ->latest('published_at')
            ->paginate(12);
            
        return theme_view('projects.index', compact('projects'));
    }

    public function show($slug, \App\Services\AnalyticsService $analytics)
    {
        $locale = app()->getLocale();
        
        $project = Project::where('status', 'published')
            ->where(function ($query) use ($slug, $locale) {
                $query->where('slug', $slug)
                      ->orWhereHas('translations', function ($q) use ($slug, $locale) {
                          $q->where('locale', $locale)->where('slug', $slug);
                      });
            })
            ->with(['translations', 'images', 'categories', 'tags'])
            ->firstOrFail();
            
        $analytics->track('project_view', $project);

        // Generate alternates
        $alternates = [];
        $activeLanguages = \App\Models\Language::active()->get();
        foreach ($activeLanguages as $lang) {
            $transSlug = $project->translated('slug', $lang->code);
            if ($transSlug) {
                $alternates[$lang->code] = route('projects.show', ['slug' => $transSlug, 'locale' => $lang->code]);
            }
        }

        view()->share('seo', [
            'title' => $project->translated('title'),
            'description' => $project->translated('short_description'),
            'image' => $project->featured_image,
            'alternates' => $alternates,
        ]);
            
        return theme_view('projects.show', compact('project'));
    }
}
