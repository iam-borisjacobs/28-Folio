@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full">
        
        <!-- Header & Breadcrumbs -->
        <div class="flex flex-col mb-8">
            <h1 class="text-5xl font-bold text-white mb-4">Edit Category</h1>
            <nav class="flex text-gray-400 text-lg">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <span class="mx-3">&rsaquo;</span>
                <a href="{{ route('admin.posts.index') }}" class="hover:text-white transition-colors">Posts</a>
                <span class="mx-3">&rsaquo;</span>
                <a href="{{ route('admin.posts.categories.index') }}" class="hover:text-white transition-colors">Categories</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Edit Category</span>
            </nav>
        </div>

        <div class="bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-700 max-w-4xl">
            <form action="{{ route('admin.posts.categories.update', $category) }}" method="POST" class="p-8 space-y-8">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-400 mb-2">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required autofocus
                        class="block w-full rounded-lg border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3"
                        placeholder="e.g. Tutorials">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-400 mb-2">
                        Slug <span class="text-gray-500 font-normal ml-1">(Optional)</span>
                    </label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $category->slug) }}"
                        class="block w-full rounded-lg border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3"
                        placeholder="auto-generated">
                    <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-700">
                    <a href="{{ route('admin.posts.categories.index') }}" class="inline-flex items-center px-6 py-3 border border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-300 bg-transparent hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 focus:ring-offset-gray-900 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-gray-900 transition-colors">
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
