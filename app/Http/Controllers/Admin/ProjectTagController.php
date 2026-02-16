<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectTag;

class ProjectTagController extends Controller
{
    public function index()
    {
        $tags = ProjectTag::latest()->paginate(10);
        return view('admin.projects.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.projects.tags.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:project_tags',
            'slug' => 'nullable|string|max:255|unique:project_tags',
        ]);

        ProjectTag::create($validated);

        return redirect()->route('admin.projects.tags.index')->with('success', 'Tag created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(ProjectTag $tag)
    {
        return view('admin.projects.tags.edit', compact('tag'));
    }

    public function update(Request $request, ProjectTag $tag)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:project_tags,name,' . $tag->id,
            'slug' => 'nullable|string|max:255|unique:project_tags,slug,' . $tag->id,
        ]);

        $tag->update($validated);

        return redirect()->route('admin.projects.tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy(ProjectTag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.projects.tags.index')->with('success', 'Tag deleted successfully.');
    }
}
