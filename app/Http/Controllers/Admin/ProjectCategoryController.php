<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectCategory;

class ProjectCategoryController extends Controller
{
    public function index()
    {
        $categories = ProjectCategory::latest()->paginate(10);
        return view('admin.projects.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.projects.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:project_categories',
            'slug' => 'nullable|string|max:255|unique:project_categories',
        ]);

        ProjectCategory::create($validated);

        return redirect()->route('admin.projects.categories.index')->with('success', 'Category created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(ProjectCategory $category)
    {
        return view('admin.projects.categories.edit', compact('category'));
    }

    public function update(Request $request, ProjectCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:project_categories,name,' . $category->id,
            'slug' => 'nullable|string|max:255|unique:project_categories,slug,' . $category->id,
        ]);

        $category->update($validated);

        return redirect()->route('admin.projects.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(ProjectCategory $category)
    {
        $category->delete();
        return redirect()->route('admin.projects.categories.index')->with('success', 'Category deleted successfully.');
    }
}
