@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full px-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-5xl font-bold text-white leading-tight">
                {{ __('Projects') }}
            </h2>
            <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-base text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                {{ __('Add Project') }}
            </a>
        </div>

        <!-- Content -->
        <div class="bg-[#1e293b] overflow-hidden shadow-xl sm:rounded-lg border border-gray-700">
            <div class="p-0">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-gray-400 border-b border-gray-700 bg-gray-800/50">
                                <th class="px-8 py-5 font-semibold text-base uppercase tracking-wider">Image</th>
                                <th class="px-8 py-5 font-semibold text-base uppercase tracking-wider">Title</th>
                                <th class="px-8 py-5 font-semibold text-base uppercase tracking-wider">Status</th>
                                <th class="px-8 py-5 font-semibold text-base uppercase tracking-wider">Featured</th>
                                <th class="px-8 py-5 font-semibold text-base uppercase tracking-wider">Published</th>
                                <th class="px-8 py-5 font-semibold text-base uppercase tracking-wider text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @forelse($projects as $project)
                                <tr class="hover:bg-gray-700/50 transition-colors duration-150">
                                    <td class="px-8 py-5 align-middle">
                                        @if($project->featured_image)
                                            <img src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->title }}" class="w-20 h-16 rounded object-cover border border-gray-600">
                                        @else
                                            <div class="w-20 h-16 bg-gray-700 rounded flex items-center justify-center text-gray-500 border border-gray-600">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-8 py-5 font-medium text-white align-middle text-lg">{{ $project->title }}</td>
                                    <td class="px-8 py-5 align-middle">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $project->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst($project->status) }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 align-middle">
                                        @if($project->is_featured)
                                            <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @else
                                            <span class="text-gray-600">-</span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-5 text-base text-gray-400 align-middle">
                                        {{ $project->published_at ? $project->published_at->format('M d, Y') : '-' }}
                                    </td>
                                    <td class="px-8 py-5 text-right align-middle">
                                        <div class="flex items-center justify-end space-x-4">
                                            <a href="{{ route('admin.projects.edit', $project) }}" class="text-indigo-400 hover:text-indigo-300 font-medium transition-colors text-base">Edit</a>
                                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300 font-medium transition-colors text-base">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-16 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-600 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                            <p class="text-xl font-medium text-gray-400">No projects found</p>
                                            <a href="{{ route('admin.projects.create') }}" class="mt-3 text-indigo-400 hover:text-indigo-300 hover:underline text-lg">Create your first project</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-8 py-6 border-t border-gray-700">
                    {{ $projects->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
