@extends('active_theme::layouts.theme_layout')

@section('content')
<section class="section" style="padding-top: 120px;">
    <div class="container">
        <div class="section-header text-center">
            <h1 class="h1">Writing</h1>
            <p class="section-subtitle mx-auto">
                Thoughts, tutorials, and insights on development, design, and technology.
            </p>
        </div>

        <div style="max-width: 800px; margin: 0 auto;">
            @forelse($posts as $post)
            <article class="mb-12 pb-12" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                <div class="flex items-center gap-4 mb-4 text-sm">
                    <span class="text-accent font-mono">{{ $post->published_at->format('F d, Y') }}</span>
                    <span class="text-muted">&bull;</span>
                    <span class="text-muted">{{ $post->reading_time ?? '5 min' }} read</span>
                </div>
                
                <h2 class="h2 mb-4">
                    <a href="{{ route('blog.show', $post) }}" class="hover:text-accent transition-colors">
                        {{ $post->title }}
                    </a>
                </h2>
                
                <p class="text-muted mb-6 text-lg">
                    {{ $post->excerpt }}
                </p>
                
                <a href="{{ route('blog.show', $post) }}" class="text-accent font-bold hover:underline">Read Article &rarr;</a>
            </article>
            @empty
            <div class="text-center py-12 card">
                <p class="text-muted">No posts found.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-12 flex justify-center">
            {{ $posts->links() }}
        </div>
    </div>
</section>
@endsection
