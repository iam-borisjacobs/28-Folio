<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectTag;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = ProjectCategory::all();
        $tags = ProjectTag::all();
        $languages = \App\Models\Language::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.projects.create', compact('categories', 'tags', 'languages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:draft,published',
            'is_featured' => 'boolean',
            'project_url' => 'nullable|url',
            'featured_image' => 'nullable|image|max:5120',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:project_categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:project_tags,id',
            
            // Translations
            'translations' => 'required|array',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.slug' => 'nullable|string|max:255',
            'translations.*.description' => 'nullable|string',
            'translations.*.content' => 'nullable|string',
            'translations.*.seo_meta' => 'nullable|array',
        ]);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('projects', 'public');
            $validated['featured_image'] = $path;
        }

        if ($validated['status'] === 'published' && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        // Set main project attributes (fallbacks or shared fields)
        // Taking first translation as default for main table columns if needed, although we moved translatable fields to translations table.
        // We should check if we kept title/slug on main table. If so, we populate them from default language.
        // Assuming we kept them for backward compatibility or simple querying.
        
        $defaultLocale = app(\App\Services\LanguageService::class)->getDefaultLanguage()->code;
        $mainTranslation = $validated['translations'][$defaultLocale] ?? reset($validated['translations']);

        $projectData = [
            'status' => $validated['status'],
            'is_featured' => $request->boolean('is_featured'),
            'project_url' => $validated['project_url'],
            'featured_image' => $validated['featured_image'] ?? null,
            'published_at' => $validated['published_at'] ?? null,
            // Fallback content for main table
            'title' => $mainTranslation['title'],
            'slug' => $mainTranslation['slug'] ?? \Illuminate\Support\Str::slug($mainTranslation['title']),
            'short_description' => $mainTranslation['description'] ?? null,
            'full_description' => $mainTranslation['content'] ?? null,
            'seo_meta' => $mainTranslation['seo_meta'] ?? null,
        ];

        $project = Project::create($projectData);

        // Save Translations
        foreach ($validated['translations'] as $locale => $transData) {
            $project->translations()->create([
                'locale' => $locale,
                'title' => $transData['title'],
                'slug' => $transData['slug'] ?: \Illuminate\Support\Str::slug($transData['title']),
                'description' => $transData['description'],
                'content' => $transData['content'],
                'seo_meta' => $transData['seo_meta'] ?? null,
            ]);
        }

        if (isset($validated['categories'])) {
            $project->categories()->attach($validated['categories']);
        }

        if (isset($validated['tags'])) {
            $project->tags()->attach($validated['tags']);
        }

        // Handle Gallery Images (if any)
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('projects/gallery', 'public');
                $project->images()->create(['image_path' => $path]);
            }
        }

        \App\Models\Activity::create([
            'user_id' => auth()->id(),
            'action' => 'created project',
            'subject_type' => Project::class,
            'subject_id' => $project->id,
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Project $project)
    {
        $categories = ProjectCategory::all();
        $tags = ProjectTag::all();
        $languages = \App\Models\Language::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.projects.edit', compact('project', 'categories', 'tags', 'languages'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'status' => 'required|in:draft,published',
            'is_featured' => 'boolean',
            'project_url' => 'nullable|url',
            'featured_image' => 'nullable|image|max:5120',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:project_categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:project_tags,id',
            
            // Translations
            'translations' => 'required|array',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.slug' => 'nullable|string|max:255',
            'translations.*.description' => 'nullable|string',
            'translations.*.content' => 'nullable|string',
            'translations.*.seo_meta' => 'nullable|array',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($project->featured_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($project->featured_image);
            }
            $path = $request->file('featured_image')->store('projects', 'public');
            $validated['featured_image'] = $path;
        }

        if ($validated['status'] === 'published' && !$project->published_at) {
            $validated['published_at'] = now();
        }
        
        $validated['is_featured'] = $request->has('is_featured');

        // Update main table with default language content (optional - keeping sync)
        $defaultLocale = app(\App\Services\LanguageService::class)->getDefaultLanguage()->code;
        $mainTranslation = $validated['translations'][$defaultLocale] ?? reset($validated['translations']);

        $project->update(array_merge($validated, [
            'title' => $mainTranslation['title'],
            'slug' => $mainTranslation['slug'] ?? \Illuminate\Support\Str::slug($mainTranslation['title']),
            'short_description' => $mainTranslation['description'] ?? null,
            'full_description' => $mainTranslation['content'] ?? null,
            'seo_meta' => $mainTranslation['seo_meta'] ?? null,
        ]));

        // Update or Create Translations
        foreach ($validated['translations'] as $locale => $transData) {
            $project->translations()->updateOrCreate(
                ['locale' => $locale],
                [
                    'title' => $transData['title'],
                    'slug' => $transData['slug'] ?: \Illuminate\Support\Str::slug($transData['title']),
                    'description' => $transData['description'],
                    'content' => $transData['content'],
                    'seo_meta' => $transData['seo_meta'] ?? null,
                ]
            );
        }

        if (isset($validated['categories'])) {
            $project->categories()->sync($validated['categories']);
        } else {
             $project->categories()->detach();
        }

        if (isset($validated['tags'])) {
            $project->tags()->sync($validated['tags']);
        } else {
            $project->tags()->detach();
        }

        // Handle Gallery Images (Append)
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('projects/gallery', 'public');
                $project->images()->create(['image_path' => $path]);
            }
        }

        \App\Models\Activity::create([
            'user_id' => auth()->id(),
            'action' => 'updated project',
            'subject_type' => Project::class,
            'subject_id' => $project->id,
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        // Delete featured image
        if ($project->featured_image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($project->featured_image);
        }

        // Delete gallery images
        foreach ($project->images as $image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($image->image_path);
        }
        
        $projectId = $project->id;
        $projectTitle = $project->title;

        $project->delete();

        \App\Models\Activity::create([
            'user_id' => auth()->id(),
            'action' => 'deleted project',
            'subject_type' => Project::class, // subject_id will point to non-existent record but acceptable for historical log or use null
            'subject_id' => $projectId, 
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
