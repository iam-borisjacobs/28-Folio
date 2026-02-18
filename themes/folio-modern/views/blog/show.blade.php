@extends('active_theme::layouts.theme_layout')

@push('meta')
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ $post->excerpt }}">
    @if($post->featured_image)
        <meta property="og:image" content="{{ Storage::url($post->featured_image) }}">
    @endif
@endpush

@section('content')
<article class="section" style="padding-top: 120px;">
    <div class="container" style="max-width: 800px;">
        <!-- Header -->
        <header class="text-center mb-12">
            <div class="flex items-center justify-center gap-4 mb-6 text-sm">
                <span class="text-accent font-mono">{{ $post->published_at->format('F d, Y') }}</span>
                <span class="text-muted">&bull;</span>
                <span class="text-muted">{{ $post->reading_time ?? '5 min' }} read</span>
            </div>
            <h1 class="h1 mb-8">{{ $post->title }}</h1>
            
            @if($post->featured_image)
                <div style="border-radius: var(--border-radius); overflow: hidden; margin-bottom: 3rem; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" style="width: 100%;">
                </div>
            @endif
        </header>

        <!-- Content -->
        <div class="prose text-muted" style="font-size: 1.2rem; line-height: 1.8;">
            {!! Str::markdown($post->content) !!}
        </div>

        <!-- Footer -->
        <footer class="mt-12 pt-8 flex justify-between items-center" style="border-top: 1px solid rgba(255,255,255,0.1);">
            <a href="{{ route('blog.index') }}" class="btn text-muted hover:text-white">&larr; Back to Writing</a>
            
            <div class="flex gap-4">
                <span class="text-muted">Share:</span>
                <a href="#" class="text-muted hover:text-white">Twitter</a>
                <a href="#" class="text-muted hover:text-white">LinkedIn</a>
            </div>
        </footer>
    </div>
</article>

<style>
/* Typography adjustments for readability */
.prose h2 { font-size: 2rem; margin-top: 2em; margin-bottom: 0.8em; color: var(--text-main); font-weight: 700; }
.prose h3 { font-size: 1.5rem; margin-top: 1.5em; margin-bottom: 0.8em; color: var(--text-main); font-weight: 600; }
.prose p { margin-bottom: 1.5em; }
.prose ul, .prose ol { margin-bottom: 1.5em; padding-left: 1.5em; }
.prose li { margin-bottom: 0.5em; }
.prose blockquote { border-left: 4px solid var(--accent-primary); padding-left: 1.5em; margin-left: 0; font-style: italic; color: var(--text-main); font-size: 1.3em; }
.prose pre { background: #111; padding: 1.5rem; border-radius: var(--border-radius); overflow-x: auto; margin-bottom: 2em; border: 1px solid rgba(255,255,255,0.1); }
.prose code { background: rgba(255,255,255,0.1); padding: 0.2em 0.4em; border-radius: 4px; font-family: var(--font-mono); font-size: 0.9em; color: var(--accent-secondary); }
.prose pre code { background: transparent; padding: 0; color: inherit; }
.prose img { border-radius: var(--border-radius); margin: 2em 0; width: 100%; }
.prose a { color: var(--accent-primary); text-decoration: underline; text-underline-offset: 4px; }
.prose strong { color: var(--text-main); font-weight: 700; }
</style>
@endsection
