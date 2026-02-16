@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full px-6">
        
        <!-- Header & Breadcrumbs -->
        <div class="flex flex-col mb-8">
            <h1 class="text-5xl font-bold text-white mb-4">Edit Skill</h1>
            <nav class="flex text-gray-400 text-lg">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Resume</span>
                <span class="mx-3">&rsaquo;</span>
                <a href="{{ route('admin.resume.skills.index') }}" class="hover:text-white transition-colors">Skills</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Edit</span>
            </nav>
        </div>

        <div class="bg-[#1e293b] rounded-lg shadow-xl overflow-hidden border border-gray-700" x-data="{ proficiency: {{ old('proficiency', $skill->proficiency) }} }">
            <form action="{{ route('admin.resume.skills.update', $skill) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="p-8 space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Name -->
                        <div class="col-span-1">
                            <label for="name" class="block text-lg font-medium text-gray-300 mb-3">Skill Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $skill->name) }}" required autofocus
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                                placeholder="e.g. Laravel">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                         <!-- Category -->
                         <div class="col-span-1">
                            <label for="category" class="block text-lg font-medium text-gray-300 mb-3">Category (Optional)</label>
                            <input type="text" id="category" name="category" value="{{ old('category', $skill->category) }}"
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                                placeholder="e.g. Backend">
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Proficiency -->
                    <div>
                         <label for="proficiency" class="block text-lg font-medium text-gray-300 mb-3">Proficiency (<span x-text="proficiency"></span>%)</label>
                        <input type="range" id="proficiency" name="proficiency" min="1" max="100" x-model="proficiency"
                            class="w-full h-3 bg-gray-900 rounded-lg appearance-none cursor-pointer">
                        <div class="flex justify-between text-sm text-gray-400 mt-2">
                            <span>Beginner</span>
                            <span>Expert</span>
                        </div>
                        <x-input-error :messages="$errors->get('proficiency')" class="mt-2" />
                    </div>

                    <!-- Sort Order -->
                    <div>
                         <label for="sort_order" class="block text-lg font-medium text-gray-300 mb-3">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $skill->sort_order) }}"
                            class="block w-40 rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                        <p class="mt-2 text-base text-gray-500">Higher numbers appear last.</p>
                        <x-input-error :messages="$errors->get('sort_order')" class="mt-2" />
                    </div>
                </div>

                <div class="bg-gray-800 px-8 py-6 border-t border-gray-700 flex justify-end space-x-4">
                    <a href="{{ route('admin.resume.skills.index') }}" class="inline-flex items-center px-8 py-4 border border-gray-600 rounded-md shadow-sm text-sm font-bold text-gray-300 uppercase tracking-widest bg-transparent hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 focus:ring-offset-gray-900 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center px-8 py-4 bg-indigo-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Update Skill
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
