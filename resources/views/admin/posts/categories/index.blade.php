@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full">
        
        <!-- Header & Breadcrumbs -->
        <div class="flex flex-col mb-8">
            <h1 class="text-5xl font-bold text-white mb-4">Blog Categories</h1>
            <nav class="flex text-gray-400 text-lg">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <span class="mx-3">&rsaquo;</span>
                <a href="{{ route('admin.posts.index') }}" class="hover:text-white transition-colors">Posts</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Categories</span>
            </nav>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Create Form -->
            <div class="lg:col-span-1">
                <div class="bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-700 sticky top-6">
                    <div class="p-6 border-b border-gray-700">
                        <h3 class="text-xl font-bold text-white">Create Category</h3>
                    </div>
                    <form action="{{ route('admin.posts.categories.store') }}" method="POST" class="p-6 space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-400 mb-2">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                                class="block w-full rounded-lg border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3"
                                placeholder="e.g. Tutorials">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <label for="slug" class="block text-sm font-medium text-gray-400 mb-2">
                                Slug <span class="text-gray-500 font-normal ml-1">(Optional)</span>
                            </label>
                            <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
                                class="block w-full rounded-lg border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3"
                                placeholder="auto-generated">
                            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                        </div>

                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-gray-800 transition-colors">
                            Create Category
                        </button>
                    </form>
                </div>
            </div>

            <!-- List -->
            <div class="lg:col-span-2">
                <div class="bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-700">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-900/50 border-b border-gray-700 text-gray-400 text-sm uppercase tracking-wider">
                                    <th class="px-6 py-4 font-semibold">Name</th>
                                    <th class="px-6 py-4 font-semibold">Slug</th>
                                    <th class="px-6 py-4 font-semibold text-center">Posts</th>
                                    <th class="px-6 py-4 font-semibold text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @forelse($categories as $category)
                                    <tr class="hover:bg-gray-700/30 transition-colors">
                                        <td class="px-6 py-4 text-white font-medium">{{ $category->name }}</td>
                                        <td class="px-6 py-4 text-gray-400">{{ $category->slug }}</td>
                                        <td class="px-6 py-4 text-gray-400 text-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-700 text-gray-300">
                                                {{ $category->posts_count }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end space-x-3">
                                                <a href="{{ route('admin.posts.categories.edit', $category) }}" class="text-indigo-400 hover:text-indigo-300 font-medium transition-colors">Edit</a>
                                                
                                                <form action="{{ route('admin.posts.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-400 hover:text-red-300 font-medium transition-colors">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                            No categories found. Start by creating one.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 border-t border-gray-700">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
