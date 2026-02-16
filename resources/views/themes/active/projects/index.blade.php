@extends('themes.active.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-extrabold text-white mb-8">Our Projects</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($projects as $project)
            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                <a href="{{ route('projects.show', $project->translated('slug')) }}">
                    @if($project->featured_image)
                        <img src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->translated('title') }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-700 flex items-center justify-center text-gray-500">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif
                </a>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                         @if($project->categories->count() > 0)
                            <span class="text-xs font-semibold text-indigo-400 uppercase tracking-wider">
                                {{ $project->categories->first()->name }}
                            </span>
                        @endif
                        @if($project->is_featured)
                             <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full">Featured</span>
                        @endif
                    </div>
                   
                    <a href="{{ route('projects.show', $project->translated('slug')) }}" class="block">
                        <h2 class="text-xl font-bold text-white mb-2 hover:text-indigo-400 transition-colors">{{ $project->translated('title') }}</h2>
                    </a>
                    
                    <p class="text-gray-400 text-sm mb-4 line-clamp-3">
                        {{ $project->translated('short_description') }}
                    </p>
                    
                    <div class="flex flex-wrap gap-2 mt-4">
                        @foreach($project->tags as $tag)
                            <span class="bg-gray-700 text-gray-300 text-xs px-2 py-1 rounded">#{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-gray-400">
                <p class="text-xl">No projects found.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $projects->links() }}
    </div>
</div>
@endsection
