@extends('active_theme::layouts.app')

@section('content')
<div class="bg-gray-50 py-16 sm:py-24">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">From the Blog</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">
                Insights, thoughts, and tutorials on web development and design.
            </p>
        </div>
        
        <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            @forelse($posts as $post)
                <article class="flex flex-col items-start justify-between">
                    <div class="relative w-full">
                        @if($post->featured_image)
                            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->translated('title') }}" class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
                        @else
                            <div class="aspect-[16/9] w-full rounded-2xl bg-gray-200 flex items-center justify-center text-gray-400 sm:aspect-[2/1] lg:aspect-[3/2]">
                                <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                    </div>
                    <div class="max-w-xl">
                        <div class="mt-8 flex items-center gap-x-4 text-xs">
                            <time datetime="{{ $post->published_at->format('Y-m-d') }}" class="text-gray-500">{{ $post->published_at->format('M d, Y') }}</time>
                            @if($post->categories->isNotEmpty())
                                <a href="#" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">{{ $post->categories->first()->name }}</a>
                            @endif
                            <span class="text-gray-500">{{ $post->reading_time }} min read</span>
                        </div>
                        <div class="group relative">
                            <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                <a href="{{ route('blog.show', $post->translated('slug')) }}">
                                    <span class="absolute inset-0"></span>
                                    {{ $post->translated('title') }}
                                </a>
                            </h3>
                            <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">{{ $post->translated('excerpt') }}</p>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500 text-lg">No posts found. Check back later!</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
