<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostTag;

class PostTagController extends Controller
{
    public function index()
    {
        $tags = PostTag::withCount('posts')->latest()->paginate(10);
        return view('admin.posts.tags.index', compact('tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:post_tags',
        ]);

        PostTag::create($validated);

        return redirect()->route('admin.posts.tags.index')->with('success', 'Tag created successfully.');
    }

    public function edit(PostTag $tag)
    {
        return view('admin.posts.tags.edit', compact('tag'));
    }

    public function update(Request $request, PostTag $tag)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:post_tags,slug,' . $tag->id,
        ]);

        $tag->update($validated);

        return redirect()->route('admin.posts.tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy(PostTag $tag)
    {
        $tag->delete();

        return redirect()->route('admin.posts.tags.index')->with('success', 'Tag deleted successfully.');
    }
}
