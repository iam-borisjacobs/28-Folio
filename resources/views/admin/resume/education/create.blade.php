@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full px-6">
        
        <!-- Header & Breadcrumbs -->
        <div class="flex flex-col mb-8">
            <h1 class="text-5xl font-bold text-white mb-4">Add Education</h1>
            <nav class="flex text-gray-400 text-lg">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Resume</span>
                <span class="mx-3">&rsaquo;</span>
                <a href="{{ route('admin.resume.education.index') }}" class="hover:text-white transition-colors">Education</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Add New</span>
            </nav>
        </div>

        <div class="bg-[#1e293b] rounded-lg shadow-xl overflow-hidden border border-gray-700">
            <form action="{{ route('admin.resume.education.store') }}" method="POST">
                @csrf
                
                <div class="p-8 space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Institution -->
                        <div class="col-span-1">
                            <label for="institution" class="block text-lg font-medium text-gray-300 mb-3">Institution</label>
                            <input type="text" id="institution" name="institution" value="{{ old('institution') }}" required autofocus
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                                placeholder="e.g. Stanford University">
                            <x-input-error :messages="$errors->get('institution')" class="mt-2" />
                        </div>

                         <!-- Degree -->
                         <div class="col-span-1">
                            <label for="degree" class="block text-lg font-medium text-gray-300 mb-3">Degree</label>
                            <input type="text" id="degree" name="degree" value="{{ old('degree') }}" required
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                                placeholder="e.g. Bachelor of Science">
                            <x-input-error :messages="$errors->get('degree')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Field of Study -->
                    <div>
                         <label for="field_of_study" class="block text-lg font-medium text-gray-300 mb-3">Field of Study</label>
                        <input type="text" id="field_of_study" name="field_of_study" value="{{ old('field_of_study') }}"
                            class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                            placeholder="e.g. Computer Science">
                        <x-input-error :messages="$errors->get('field_of_study')" class="mt-2" />
                    </div>

                    <!-- Dates -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                         <!-- Start Date -->
                         <div class="col-span-1">
                            <label for="start_date" class="block text-lg font-medium text-gray-300 mb-3">Start Date</label>
                            <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>

                         <!-- End Date -->
                         <div class="col-span-1">
                            <label for="end_date" class="block text-lg font-medium text-gray-300 mb-3">End Date (or Expected)</label>
                            <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}"
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-lg font-medium text-gray-300 mb-3">Description</label>
                        <div class="rounded-md border border-gray-700 bg-gray-900 overflow-hidden">
                            <textarea id="description" name="description" rows="4"
                                class="block w-full border-0 bg-transparent text-gray-300 focus:ring-0 text-lg px-5 py-4"
                                placeholder="Activities, societies, etc...">{{ old('description') }}</textarea>
                        </div>
                         <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Sort Order -->
                    <div>
                         <label for="sort_order" class="block text-lg font-medium text-gray-300 mb-3">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}"
                            class="block w-40 rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                        <p class="mt-2 text-base text-gray-500">Higher numbers appear last.</p>
                        <x-input-error :messages="$errors->get('sort_order')" class="mt-2" />
                    </div>
                </div>

                <div class="bg-gray-800 px-8 py-6 border-t border-gray-700 flex justify-end space-x-4">
                    <a href="{{ route('admin.resume.education.index') }}" class="inline-flex items-center px-8 py-4 border border-gray-600 rounded-md shadow-sm text-sm font-bold text-gray-300 uppercase tracking-widest bg-transparent hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 focus:ring-offset-gray-900 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center px-8 py-4 bg-indigo-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Save Education
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
