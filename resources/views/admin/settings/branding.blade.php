@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full px-6">
        
        <!-- Header -->
        <div class="flex flex-col mb-8">
            <h1 class="text-5xl font-bold text-white mb-4">Branding Settings</h1>
            <nav class="flex text-gray-400 text-lg">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <span class="mx-3">&rsaquo;</span>
                <a href="{{ route('admin.settings.index') }}" class="hover:text-white transition-colors">Settings</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Branding</span>
            </nav>
        </div>

        <div class="bg-[#1e293b] rounded-lg shadow-xl overflow-hidden border border-gray-700">
            <form action="{{ route('admin.settings.branding') }}" method="POST">
                @csrf
                
                <div class="p-8 space-y-8">
                    <!-- Logo -->
                    <div>
                        <label class="block text-lg font-medium text-gray-300 mb-3">Website Logo</label>
                        <x-admin.media-picker name="logo_url" :value="$settings['logo_url'] ?? ''" />
                        <p class="mt-2 text-base text-gray-500">Displayed in the header and emails.</p>
                    </div>

                    <!-- Favicon -->
                    <div>
                        <label class="block text-lg font-medium text-gray-300 mb-3">Favicon</label>
                        <x-admin.media-picker name="favicon_url" :value="$settings['favicon_url'] ?? ''" />
                        <p class="mt-2 text-base text-gray-500">Browser tab icon (32x32px recommended).</p>
                    </div>

                    <!-- Default Social Image -->
                    <div>
                        <label class="block text-lg font-medium text-gray-300 mb-3">Default Social Share Image (OG Image)</label>
                        <x-admin.media-picker name="social_image_url" :value="$settings['social_image_url'] ?? ''" />
                        <p class="mt-2 text-base text-gray-500">Used when a page doesn't have a specific featured image.</p>
                    </div>
                </div>

                <div class="bg-gray-800 px-8 py-6 border-t border-gray-700 flex justify-end">
                    <button type="submit" class="inline-flex items-center px-8 py-4 bg-indigo-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Save Branding
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
