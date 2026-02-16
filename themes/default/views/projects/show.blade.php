@extends('active_theme::layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    
    <div class="mb-8">
        <a href="{{ route('projects.index') }}" class="text-indigo-400 hover:text-indigo-300 flex items-center mb-4">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Projects
        </a>
        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4">{{ $project->translated('title') }}</h1>
        
        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-400">
            <span>{{ $project->published_at ? $project->published_at->format('M d, Y') : '' }}</span>
            @foreach($project->categories as $category)
                <span class="text-indigo-400">{{ $category->name }}</span>
            @endforeach
        </div>
    </div>

    @if($project->featured_image)
        <div class="rounded-xl overflow-hidden shadow-2xl mb-12">
            <img src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->translated('title') }}" class="w-full h-auto">
        </div>
    @endif

    <div class="prose prose-invert max-w-none mb-12">
        @if($project->translated('full_description'))
            {!! nl2br(e($project->translated('full_description'))) !!}
        @else
            <p>{{ $project->translated('short_description') }}</p>
        @endif
    </div>

    @if($project->project_url)
        <div class="mb-12">
            <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Visit Project Site
                <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
        </div>
    @endif

    @if($project->images->count() > 0)
        <h2 class="text-2xl font-bold text-white mb-6">Gallery</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($project->images as $image)
                <div class="rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ Storage::url($image->image_path) }}" alt="Gallery Image" class="w-full h-auto cursor-pointer hover:opacity-90 transition-opacity">
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-12 pt-8 border-t border-gray-800">
        <h3 class="text-lg font-medium text-white mb-4">Tags</h3>
        <div class="flex flex-wrap gap-2">
            @foreach($project->tags as $tag)
                <span class="bg-gray-800 text-gray-300 px-3 py-1 rounded-full text-sm">#{{ $tag->name }}</span>
            @endforeach
        </div>
    </div>

</div>
@endsection
