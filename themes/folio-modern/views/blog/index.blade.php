@extends('active_theme::layouts.app')

@section('content')
<section class="section" style="padding-top: 120px;">
    <div class="container">
        <div class="section-header" style="text-align: center; margin-bottom: 60px;">
            <h1 style="font-size: 3.5rem; margin-bottom: 20px;">Writing</h1>
            <p class="text-muted" style="max-width: 600px; margin: 0 auto;">
                Thoughts, tutorials, and insights on development, design, and technology.
            </p>
        </div>

        <div class="blog-list" style="max-width: 800px; margin: 0 auto;">
            @forelse($posts as $post)
            <article style="margin-bottom: 60px; padding-bottom: 60px; border-bottom: 1px solid var(--border-color);">
                <div style="font-size: 0.9rem; color: var(--primary); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px;">
                    {{ $post->published_at->format('F d, Y') }}
                </div>
                
                <h2 style="font-size: 2rem; margin-bottom: 15px;">
                    <a href="{{ route('blog.show', $post) }}" style="color: var(--text-main);">{{ $post->title }}</a>
                </h2>
                
                <p style="color: var(--text-muted); font-size: 1.1rem; margin-bottom: 20px; line-height: 1.6;">
                    {{ $post->excerpt }}
                </p>
                
                <a href="{{ route('blog.show', $post) }}" style="color: var(--primary); font-weight: 600;">Read Article &rarr;</a>
            </article>
            @empty
            <div style="text-align: center; padding: 40px; background: var(--bg-card); border-radius: var(--radius-lg);">
                <p style="color: var(--text-muted);">No posts found.</p>
            </div>
            @endforelse
        </div>

        <div style="margin-top: 60px; text-align: center;">
            {{ $posts->links() }}
        </div>
    </div>
</section>
@endsection
