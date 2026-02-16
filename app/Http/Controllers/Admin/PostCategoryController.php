<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCategory;

class PostCategoryController extends Controller
{
    public function index()
    {
        $categories = PostCategory::withCount('posts')->latest()->paginate(10);
        return view('admin.posts.categories.index', compact('categories'));
    }

    public function create()
    {
        // Not used, using index for creation or modal (but layout suggests sidebar or separate page)
        // For now, simple return view or just use index if we do split view like projects
        // Design pattern from Projects uses split view in index.
        return redirect()->route('admin.posts.categories.index'); 
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:post_categories',
        ]);

        PostCategory::create($validated);

        return redirect()->route('admin.posts.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(PostCategory $category) // Route binding might need explicit binding in RouteServiceProvider if 'category' vs 'postCategory'
    {
        // We need to be careful with route parameter naming in resources
        return view('admin.posts.categories.edit', compact('category'));
    }

    public function update(Request $request, PostCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:post_categories,slug,' . $category->id,
        ]);

        $category->update($validated);

        return redirect()->route('admin.posts.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(PostCategory $category)
    {
        $category->delete();

        return redirect()->route('admin.posts.categories.index')->with('success', 'Category deleted successfully.');
    }
}
