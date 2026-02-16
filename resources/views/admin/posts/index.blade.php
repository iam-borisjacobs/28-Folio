@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full px-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-5xl font-bold text-white leading-tight">
                {{ __('Posts') }}
            </h2>
            <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-base text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                {{ __('Add Post') }}
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
                                <th class="px-8 py-5 font-semibold text-base uppercase tracking-wider">Reading Time</th>
                                <th class="px-8 py-5 font-semibold text-base uppercase tracking-wider">Published</th>
                                <th class="px-8 py-5 font-semibold text-base uppercase tracking-wider text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @forelse($posts as $post)
                                <tr class="hover:bg-gray-700/50 transition-colors duration-150">
                                    <td class="px-8 py-5 align-middle">
                                        @if($post->featured_image)
                                            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-20 h-16 rounded object-cover border border-gray-600">
                                        @else
                                            <div class="w-20 h-16 bg-gray-700 rounded flex items-center justify-center text-gray-500 border border-gray-600">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-8 py-5 font-medium text-white align-middle text-lg">{{ $post->title }}</td>
                                    <td class="px-8 py-5 align-middle">
                                        @php
                                            $statusClasses = [
                                                'published' => 'bg-green-100 text-green-800',
                                                'draft' => 'bg-gray-100 text-gray-800',
                                                'scheduled' => 'bg-yellow-100 text-yellow-800',
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusClasses[$post->status] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst($post->status) }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-base text-gray-400 align-middle">
                                        {{ $post->reading_time }} min
                                    </td>
                                    <td class="px-8 py-5 text-base text-gray-400 align-middle">
                                        {{ $post->published_at ? $post->published_at->format('M d, Y') : '-' }}
                                    </td>
                                    <td class="px-8 py-5 text-right align-middle">
                                        <div class="flex items-center justify-end space-x-4">
                                            <a href="{{ route('admin.posts.edit', $post) }}" class="text-indigo-400 hover:text-indigo-300 font-medium transition-colors text-base">Edit</a>
                                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
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
                                            <svg class="w-16 h-16 text-gray-600 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                            <p class="text-xl font-medium text-gray-400">No posts found</p>
                                            <a href="{{ route('admin.posts.create') }}" class="mt-3 text-indigo-400 hover:text-indigo-300 hover:underline text-lg">Create your first post</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-8 py-6 border-t border-gray-700">
                    {{ $posts->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
