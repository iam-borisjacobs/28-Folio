<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;

class PageController extends Controller
{
    public function show($slug = 'home')
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        
        // If the theme supports custom layouts per page, we'd pass it here.
        // For now, we will render a standard view that loops through blocks.
        return theme_view('page', compact('page'));
    }
}
