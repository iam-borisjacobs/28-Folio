@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full px-6">
        
        <!-- Header -->
        <div class="flex flex-col mb-8">
            <h1 class="text-5xl font-bold text-white mb-4">General Settings</h1>
        </div>

        <div class="bg-[#1e293b] rounded-lg shadow-xl overflow-hidden border border-gray-700">
            <form action="{{ route('admin.settings.general') }}" method="POST">
                @csrf
                
                <div class="p-8 space-y-8">
                    <!-- Site Name -->
                    <div>
                        <label for="site_name" class="block text-lg font-medium text-gray-300 mb-3">Site Name</label>
                        <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $settings['site_name'] ?? '') }}" 
                            class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                        @error('site_name') <span class="text-red-500 text-base mt-2">{{ $message }}</span> @enderror
                    </div>

                    <!-- Tagline -->
                    <div>
                        <label for="site_tagline" class="block text-lg font-medium text-gray-300 mb-3">Site Tagline</label>
                        <input type="text" name="site_tagline" id="site_tagline" value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}" 
                            class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                        @error('site_tagline') <span class="text-red-500 text-base mt-2">{{ $message }}</span> @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="site_description" class="block text-lg font-medium text-gray-300 mb-3">Site Description</label>
                        <textarea name="site_description" id="site_description" rows="3" 
                            class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
                        <p class="mt-2 text-base text-gray-500">Used for meta description if no specific SEO description is set.</p>
                        @error('site_description') <span class="text-red-500 text-base mt-2">{{ $message }}</span> @enderror
                    </div>

                    <!-- Primary Email -->
                    <div>
                        <label for="primary_email" class="block text-lg font-medium text-gray-300 mb-3">Primary Email</label>
                        <input type="email" name="primary_email" id="primary_email" value="{{ old('primary_email', $settings['primary_email'] ?? '') }}" 
                            class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                        @error('primary_email') <span class="text-red-500 text-base mt-2">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-800 px-8 py-6 border-t border-gray-700 flex justify-end">
                    <button type="submit" class="inline-flex items-center px-8 py-4 bg-indigo-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
