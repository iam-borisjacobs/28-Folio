@extends('themes.active.layouts.app')

@section('content')
<div class="bg-white py-16 sm:py-24">
    <div class="mx-auto max-w-3xl px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <div class="flex items-center justify-center gap-x-4 text-sm text-gray-500 mb-6">
                <time datetime="{{ $post->published_at->format('Y-m-d') }}">{{ $post->published_at->format('F d, Y') }}</time>
                <span>&bull;</span>
                <span>{{ $post->reading_time }} min read</span>
                @if($post->categories->isNotEmpty())
                    <span>&bull;</span>
                    <span class="text-indigo-600 font-medium">{{ $post->categories->first()->name }}</span>
                @endif
            </div>
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl mb-6">{{ $post->translated('title') }}</h1>
            @if($post->translated('excerpt'))
                <p class="text-xl leading-8 text-gray-600">{{ $post->translated('excerpt') }}</p>
            @endif
        </div>

        <!-- Featured Image -->
        @if($post->featured_image)
            <figure class="mb-16">
                <img class="aspect-video rounded-xl bg-gray-50 object-cover w-full shadow-lg" src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->translated('title') }}">
            </figure>
        @endif

        <!-- Content -->
        <div class="prose prose-lg prose-indigo mx-auto text-gray-600">
            @php
                $parsedContent = Illuminate\Support\Str::markdown($post->translated('content') ?? '');
            @endphp
            {!! $parsedContent !!}
        </div>

        <!-- Tags -->
        @if($post->tags->isNotEmpty())
            <div class="mt-12 flex flex-wrap gap-2">
                @foreach($post->tags as $tag)
                    <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-sm font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">#{{ $tag->name }}</span>
                @endforeach
            </div>
        @endif

        <!-- Share (Placeholder) -->
        <div class="mt-12 border-t border-gray-200 pt-8">
            <h3 class="text-sm font-medium text-gray-900">Share this article</h3>
            <div class="mt-4 flex gap-4">
                <!-- Add actual share links later -->
                <button type="button" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Twitter</span>
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                </button>
            </div>
        </div>

    </div>
</div>

<!-- Related Posts -->
@if($relatedPosts->isNotEmpty())
<div class="bg-gray-50 py-16">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-10">Read Next</h2>
        <div class="grid max-w-2xl grid-cols-1 gap-x-8 gap-y-12 lg:mx-0 lg:max-w-none lg:grid-cols-3">
             @foreach($relatedPosts as $related)
                <article class="flex flex-col items-start">
                    <div class="relative w-full">
                         @if($related->featured_image)
                            <img src="{{ Storage::url($related->featured_image) }}" alt="{{ $related->translated('title') }}" class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
                        @else
                            <div class="aspect-[16/9] w-full rounded-2xl bg-gray-200 flex items-center justify-center text-gray-400">
                                <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                        @endif
                         <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                    </div>
                    <div class="max-w-xl">
                        <div class="mt-4 flex items-center gap-x-4 text-xs">
                             <time datetime="{{ $related->published_at->format('Y-m-d') }}" class="text-gray-500">{{ $related->published_at->format('M d, Y') }}</time>
                        </div>
                        <div class="group relative">
                            <h3 class="mt-2 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                <a href="{{ route('blog.show', $related->translated('slug')) }}">
                                    <span class="absolute inset-0"></span>
                                    {{ $related->translated('title') }}
                                </a>
                            </h3>
                        </div>
                    </div>
                </article>
             @endforeach
        </div>
    </div>
</div>
@endif

@endsection
