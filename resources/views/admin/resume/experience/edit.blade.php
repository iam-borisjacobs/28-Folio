@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full px-6">
        
        <!-- Header & Breadcrumbs -->
        <div class="flex flex-col mb-8">
            <h1 class="text-5xl font-bold text-white mb-4">Edit Experience</h1>
            <nav class="flex text-gray-400 text-lg">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Resume</span>
                <span class="mx-3">&rsaquo;</span>
                <a href="{{ route('admin.resume.experience.index') }}" class="hover:text-white transition-colors">Experience</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Edit</span>
            </nav>
        </div>

        <div class="bg-[#1e293b] rounded-lg shadow-xl overflow-hidden border border-gray-700">
            <form action="{{ route('admin.resume.experience.update', $experience) }}" method="POST" x-data="{ isCurrent: {{ old('is_current', $experience->is_current) ? 'true' : 'false' }} }">
                @csrf
                @method('PUT')
                
                <div class="p-8 space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Job Title -->
                        <div class="col-span-1">
                            <label for="job_title" class="block text-lg font-medium text-gray-300 mb-3">Job Title</label>
                            <input type="text" id="job_title" name="job_title" value="{{ old('job_title', $experience->job_title) }}" required autofocus
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                                placeholder="e.g. Senior Software Engineer">
                            <x-input-error :messages="$errors->get('job_title')" class="mt-2" />
                        </div>

                         <!-- Company -->
                         <div class="col-span-1">
                            <label for="company" class="block text-lg font-medium text-gray-300 mb-3">Company</label>
                            <input type="text" id="company" name="company" value="{{ old('company', $experience->company) }}" required
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                                placeholder="e.g. Acme Corp">
                            <x-input-error :messages="$errors->get('company')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Location -->
                    <div>
                         <label for="location" class="block text-lg font-medium text-gray-300 mb-3">Location</label>
                        <input type="text" id="location" name="location" value="{{ old('location', $experience->location) }}"
                            class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                            placeholder="e.g. San Francisco, CA (Remote)">
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    <!-- Dates -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                         <!-- Start Date -->
                         <div class="col-span-1">
                            <label for="start_date" class="block text-lg font-medium text-gray-300 mb-3">Start Date</label>
                            <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $experience->start_date->format('Y-m-d')) }}" required
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>

                         <!-- End Date -->
                         <div class="col-span-1" x-show="!isCurrent">
                            <label for="end_date" class="block text-lg font-medium text-gray-300 mb-3">End Date</label>
                            <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $experience->end_date ? $experience->end_date->format('Y-m-d') : '') }}"
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>

                        <!-- Current Toggle -->
                        <div class="col-span-1 pt-12">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_current" value="1" class="rounded border-gray-700 bg-gray-900 text-indigo-600 shadow-sm focus:ring-indigo-500 h-6 w-6" x-model="isCurrent">
                                <span class="ml-3 text-lg text-gray-300">I currently work here</span>
                            </label>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-lg font-medium text-gray-300 mb-3">Description</label>
                        <div class="rounded-md border border-gray-700 bg-gray-900 overflow-hidden">
                            <textarea id="description" name="description" rows="6"
                                class="block w-full border-0 bg-transparent text-gray-300 focus:ring-0 text-lg px-5 py-4"
                                placeholder="Describe your responsibilities and achievements...">{{ old('description', $experience->description) }}</textarea>
                        </div>
                         <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Sort Order -->
                    <div>
                         <label for="sort_order" class="block text-lg font-medium text-gray-300 mb-3">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $experience->sort_order) }}"
                            class="block w-40 rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                        <p class="mt-2 text-base text-gray-500">Higher numbers appear last.</p>
                        <x-input-error :messages="$errors->get('sort_order')" class="mt-2" />
                    </div>
                </div>

                <div class="bg-gray-800 px-8 py-6 border-t border-gray-700 flex justify-end space-x-4">
                    <a href="{{ route('admin.resume.experience.index') }}" class="inline-flex items-center px-8 py-4 border border-gray-600 rounded-md shadow-sm text-sm font-bold text-gray-300 uppercase tracking-widest bg-transparent hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 focus:ring-offset-gray-900 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center px-8 py-4 bg-indigo-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Update Experience
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
