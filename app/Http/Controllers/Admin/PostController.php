<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = PostCategory::all();
        $tags = PostTag::all();
        $languages = \App\Models\Language::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.posts.create', compact('categories', 'tags', 'languages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:draft,published,scheduled',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|max:5120',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:post_categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:post_tags,id',

            // Translations
            'translations' => 'required|array',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.slug' => 'nullable|string|max:255',
            'translations.*.excerpt' => 'nullable|string',
            'translations.*.content' => 'required|string',
            'translations.*.seo_meta' => 'nullable|array',
        ]);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('posts', 'public');
            $validated['featured_image'] = $path;
        }

        if ($validated['status'] === 'published' && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        // Set main post attributes (fallbacks or shared fields)
        $defaultLocale = app(\App\Services\LanguageService::class)->getDefaultLanguage()->code;
        $mainTranslation = $validated['translations'][$defaultLocale] ?? reset($validated['translations']);

        $postData = [
            'status' => $validated['status'],
            'published_at' => $validated['published_at'] ?? null,
            'featured_image' => $validated['featured_image'] ?? null,
            // Fallback content for main table
            'title' => $mainTranslation['title'],
            'slug' => $mainTranslation['slug'] ?? \Illuminate\Support\Str::slug($mainTranslation['title']),
            'excerpt' => $mainTranslation['excerpt'] ?? null,
            'content' => $mainTranslation['content'],
            'seo_meta' => $mainTranslation['seo_meta'] ?? null,
        ];
        
        $post = Post::create($postData);

         // Save Translations
         foreach ($validated['translations'] as $locale => $transData) {
            $post->translations()->create([
                'locale' => $locale,
                'title' => $transData['title'],
                'slug' => $transData['slug'] ?: \Illuminate\Support\Str::slug($transData['title']),
                'excerpt' => $transData['excerpt'],
                'content' => $transData['content'],
                'seo_meta' => $transData['seo_meta'] ?? null,
            ]);
        }

        if (isset($validated['categories'])) {
            $post->categories()->attach($validated['categories']);
        }

        if (isset($validated['tags'])) {
            $post->tags()->attach($validated['tags']);
        }

        \App\Models\Activity::create([
            'user_id' => auth()->id(),
            'action' => 'created post',
            'subject_type' => Post::class,
            'subject_id' => $post->id,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Post $post)
    {
        $categories = PostCategory::all();
        $tags = PostTag::all();
        $languages = \App\Models\Language::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'languages'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'status' => 'required|in:draft,published,scheduled',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|max:5120',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:post_categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:post_tags,id',
            
            // Translations
            'translations' => 'required|array',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.slug' => 'nullable|string|max:255',
            'translations.*.excerpt' => 'nullable|string',
            'translations.*.content' => 'required|string',
            'translations.*.seo_meta' => 'nullable|array',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $path = $request->file('featured_image')->store('posts', 'public');
            $validated['featured_image'] = $path;
        }

        // Update main table with default language content
        $defaultLocale = app(\App\Services\LanguageService::class)->getDefaultLanguage()->code;
        $mainTranslation = $validated['translations'][$defaultLocale] ?? reset($validated['translations']);

        $post->update(array_merge($validated, [
            'title' => $mainTranslation['title'],
            'slug' => $mainTranslation['slug'] ?? \Illuminate\Support\Str::slug($mainTranslation['title']),
            'excerpt' => $mainTranslation['excerpt'] ?? null,
            'content' => $mainTranslation['content'],
            'seo_meta' => $mainTranslation['seo_meta'] ?? null,
        ]));

        // Update or Create Translations
        foreach ($validated['translations'] as $locale => $transData) {
            $post->translations()->updateOrCreate(
                ['locale' => $locale],
                [
                    'title' => $transData['title'],
                    'slug' => $transData['slug'] ?: \Illuminate\Support\Str::slug($transData['title']),
                    'excerpt' => $transData['excerpt'],
                    'content' => $transData['content'],
                    'seo_meta' => $transData['seo_meta'] ?? null,
                ]
            );
        }

        if (isset($validated['categories'])) {
            $post->categories()->sync($validated['categories']);
        } else {
            $post->categories()->detach();
        }

        if (isset($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        } else {
            $post->tags()->detach();
        }

        \App\Models\Activity::create([
            'user_id' => auth()->id(),
            'action' => 'updated post',
            'subject_type' => Post::class,
            'subject_id' => $post->id,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $postId = $post->id;
        $post->delete();

        \App\Models\Activity::create([
            'user_id' => auth()->id(),
            'action' => 'deleted post',
            'subject_type' => Post::class,
            'subject_id' => $postId,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
    }
}
