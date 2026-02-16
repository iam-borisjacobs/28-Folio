@extends('admin.layouts.app')

@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full px-6">
        
        <!-- Header & Breadcrumbs -->
        <div class="flex flex-col mb-8">
            <h1 class="text-5xl font-bold text-white mb-4">Edit Category</h1>
            <nav class="flex text-gray-400 text-lg">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <span class="mx-3">&rsaquo;</span>
                <a href="{{ route('admin.projects.index') }}" class="hover:text-white transition-colors">Projects</a>
                <span class="mx-3">&rsaquo;</span>
                <a href="{{ route('admin.projects.categories.index') }}" class="hover:text-white transition-colors">Categories</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Edit Category</span>
            </nav>
        </div>

        <div class="bg-[#1e293b] rounded-lg shadow-xl overflow-hidden border border-gray-700 max-w-4xl">
            <form action="{{ route('admin.projects.categories.update', $category) }}" method="POST" class="p-8 space-y-8">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="name" class="block text-lg font-medium text-gray-300 mb-3">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required autofocus
                        class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                        placeholder="e.g. Graphic Design">
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-base" />
                </div>

                <div>
                    <label for="slug" class="block text-lg font-medium text-gray-300 mb-3">
                        Slug <span class="text-gray-500 font-normal ml-1">(Optional)</span>
                    </label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $category->slug) }}"
                        class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                        placeholder="auto-generated">
                    <x-input-error :messages="$errors->get('slug')" class="mt-2 text-base" />
                </div>

                <div class="flex justify-end space-x-4 pt-4 border-t border-gray-700">
                    <a href="{{ route('admin.projects.categories.index') }}" class="inline-flex items-center px-8 py-4 bg-gray-700 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="inline-flex items-center px-8 py-4 bg-indigo-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Update Category') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
