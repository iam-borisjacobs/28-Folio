@extends('active_theme::layouts.app')

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
        <header style="margin-bottom: 40px; text-align: center;">
            <div style="font-size: 0.9rem; color: var(--primary); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px;">
                {{ $post->published_at->format('F d, Y') }} &bull; {{ $post->reading_time ?? '5 min' }} read
            </div>
            <h1 style="font-size: 3rem; line-height: 1.2; margin-bottom: 30px;">{{ $post->title }}</h1>
            
            @if($post->featured_image)
                <div style="border-radius: var(--radius-lg); overflow: hidden; margin-bottom: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" style="width: 100%;">
                </div>
            @endif
        </header>

        <!-- Content -->
        <div class="prose" style="font-size: 1.15rem; line-height: 1.8; color: #ccc;">
            {!! Str::markdown($post->content) !!}
        </div>

        <!-- Footer -->
        <footer style="margin-top: 80px; padding-top: 40px; border-top: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('blog.index') }}" class="btn btn-outline">&larr; Back to Writing</a>
            
            <div style="display: flex; gap: 10px;">
                <!-- Social Share placeholders -->
                <a href="#" style="color: var(--text-muted);">Share</a>
            </div>
        </footer>
    </div>
</article>

<style>
/* Simple typography styles for blog content */
.prose h2 { font-size: 2rem; margin-top: 2em; margin-bottom: 0.8em; color: var(--text-main); }
.prose h3 { font-size: 1.5rem; margin-top: 1.5em; margin-bottom: 0.8em; color: var(--text-main); }
.prose p { margin-bottom: 1.5em; }
.prose ul, .prose ol { margin-bottom: 1.5em; padding-left: 1.5em; }
.prose li { margin-bottom: 0.5em; }
.prose blockquote { border-left: 4px solid var(--primary); padding-left: 1em; margin-left: 0; font-style: italic; color: var(--text-muted); }
.prose pre { background: #0d0d12; padding: 20px; border-radius: var(--radius-md); overflow-x: auto; margin-bottom: 1.5em; }
.prose code { background: rgba(255,255,255,0.1); padding: 2px 6px; border-radius: 4px; font-size: 0.9em; }
.prose pre code { background: transparent; padding: 0; }
.prose img { border-radius: var(--radius-md); margin: 2em 0; }
.prose a { color: var(--primary); text-decoration: underline; }
</style>
@endsection
