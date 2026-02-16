<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::published()
            ->with(['translations', 'categories', 'tags']) // Eager load
            ->latest('published_at')
            ->paginate(9); // 9 per page

        return theme_view('blog.index', compact('posts'));
    }

    public function show($slug, \App\Services\AnalyticsService $analytics)
    {
        $locale = app()->getLocale();
        
        $post = Post::published()
            ->where(function ($query) use ($slug, $locale) {
                $query->where('slug', $slug)
                      ->orWhereHas('translations', function ($q) use ($slug, $locale) {
                          $q->where('locale', $locale)->where('slug', $slug);
                      });
            })
            ->with(['translations', 'categories', 'tags'])
            ->firstOrFail();
            
        $analytics->track('post_view', $post);
            
        // Calculate related posts based on categories
        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->whereHas('categories', function ($query) use ($post) {
                $query->whereIn('id', $post->categories->pluck('id'));
            })
            ->limit(3)
            ->get();

        // Generate alternates
        $alternates = [];
        $activeLanguages = \App\Models\Language::active()->get();
        foreach ($activeLanguages as $lang) {
            $transSlug = $post->translated('slug', $lang->code);
            if ($transSlug) {
                $alternates[$lang->code] = route('blog.show', ['slug' => $transSlug, 'locale' => $lang->code]);
            }
        }

        view()->share('seo', [
            'title' => $post->translated('title'),
            'description' => $post->translated('excerpt'),
            'image' => $post->featured_image,
            'type' => 'article',
            'alternates' => $alternates,
        ]);

        return theme_view('blog.show', compact('post', 'relatedPosts'));
    }
}
