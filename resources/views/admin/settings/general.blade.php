@extends('admin.layouts.app')

@section('content')
    <div class="py-6">
        <div class="w-full px-6">

            <!-- Header -->
            <div class="flex flex-col mb-8">
                <h1 class="text-5xl font-bold text-white mb-4">General Settings</h1>
            </div>

            <form action="{{ route('admin.settings.general.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-[#1e293b] rounded-lg shadow-xl overflow-hidden border border-gray-700">

                    <div class="p-8 space-y-8">
                        <!-- Site Name -->
                        <div>
                            <label for="site_name" class="block text-lg font-medium text-gray-300 mb-3">Site Name</label>
                            <input type="text" name="site_name" id="site_name"
                                value="{{ old('site_name', $settings['site_name'] ?? '') }}"
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                            @error('site_name')
                                <span class="text-red-500 text-base mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tagline -->
                        <div>
                            <label for="site_tagline" class="block text-lg font-medium text-gray-300 mb-3">Site
                                Tagline</label>
                            <input type="text" name="site_tagline" id="site_tagline"
                                value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}"
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                            @error('site_tagline')
                                <span class="text-red-500 text-base mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="site_description" class="block text-lg font-medium text-gray-300 mb-3">Site
                                Description</label>
                            <textarea name="site_description" id="site_description" rows="3"
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
                            <p class="mt-2 text-base text-gray-500">Used for meta description if no specific SEO description
                                is set.</p>
                            @error('site_description')
                                <span class="text-red-500 text-base mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Primary Email -->
                        <div>
                            <label for="primary_email" class="block text-lg font-medium text-gray-300 mb-3">Primary
                                Email</label>
                            <input type="email" name="primary_email" id="primary_email"
                                value="{{ old('primary_email', $settings['primary_email'] ?? '') }}"
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                            @error('primary_email')
                                <span class="text-red-500 text-base mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Hero Section -->
                <div class="bg-[#1e293b] rounded-lg shadow-xl overflow-hidden border border-gray-700 mt-8">
                    <div class="p-8 space-y-8">
                        <h3 class="text-2xl font-bold text-white mb-6 border-b border-gray-700 pb-4">Hero Section Defaults
                        </h3>

                        <!-- Hero Title -->
                        <div>
                            <label for="hero_title" class="block text-lg font-medium text-gray-300 mb-3">Hero Title</label>
                            <input type="text" name="hero_title" id="hero_title"
                                value="{{ old('hero_title', $settings['hero_title'] ?? 'Senior {Full Stack} Web & App developer_') }}"
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                            @error('hero_title')
                                <span class="text-red-500 text-base mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Hero Subtitle -->
                        <div>
                            <label for="hero_subtitle" class="block text-lg font-medium text-gray-300 mb-3">Hero Subtitle /
                                Suffix</label>
                            <input type="text" name="hero_subtitle" id="hero_subtitle"
                                value="{{ old('hero_subtitle', $settings['hero_subtitle'] ?? 'Hey, I\'m 28-Folio') }}"
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                            @error('hero_subtitle')
                                <span class="text-red-500 text-base mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Hero Description -->
                        <div>
                            <label for="hero_description" class="block text-lg font-medium text-gray-300 mb-3">Hero
                                Description</label>
                            <textarea name="hero_description" id="hero_description" rows="3"
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">{{ old('hero_description', $settings['hero_description'] ?? 'With expertise in cutting-edge technologies such as NodeJS, React, Angular, and Laravel... I deliver web solutions that are both innovative and robust.') }}</textarea>
                            @error('hero_description')
                                <span class="text-red-500 text-base mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Hero Image -->
                        <div>
                            <label class="block text-lg font-medium text-gray-300 mb-3">Hero Image</label>
                            <div class="flex items-center space-x-6">
                                <div class="shrink-0">
                                    @if (isset($settings['hero_image']))
                                        <img class="h-32 w-32 object-cover rounded-full border-4 border-gray-700"
                                            src="{{ Storage::url($settings['hero_image']) }}" alt="Current Hero Image">
                                    @else
                                        <div
                                            class="h-32 w-32 rounded-full bg-gray-800 flex items-center justify-center border-4 border-gray-700">
                                            <span class="text-gray-500">No Image</span>
                                        </div>
                                    @endif
                                </div>
                                <label class="block">
                                    <span class="sr-only">Choose profile photo</span>
                                    <input type="file" name="hero_image"
                                        class="block w-full text-sm text-gray-400
                                        file:mr-4 file:py-3 file:px-6
                                        file:rounded-md file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-indigo-600 file:text-white
                                        file:cursor-pointer hover:file:bg-indigo-700
                                    " />
                                </label>
                                @error('hero_image')
                                    <span class="text-red-500 text-base mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="bg-gray-800 px-8 py-6 border-t border-gray-700 flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-8 py-4 bg-indigo-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Save Changes
                        </button>
                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
