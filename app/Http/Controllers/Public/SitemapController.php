<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\Project;
use App\Models\Post;

class SitemapController extends Controller
{
    public function index()
    {
        $posts = Post::published()->get();
        $projects = Project::where('status', 'published')->get();
        $languages = \App\Models\Language::active()->get();

        $content = view('sitemap', [
            'posts' => $posts,
            'projects' => $projects,
            'languages' => $languages,
        ])->render();

        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }
}
