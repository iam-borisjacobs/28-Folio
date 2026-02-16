@extends('admin.layouts.app')

@section('header')
    <h2 class="font-bold text-3xl text-white leading-tight">
        {{ __('Settings') }}
    </h2>
@endsection

@section('content')
<div class="py-6">
    <div class="w-full px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- General -->
        <a href="{{ route('admin.settings.general') }}" class="group block p-6 bg-gray-800 rounded-lg border border-gray-700 hover:border-indigo-500 transition-colors">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-indigo-500/10 text-indigo-500 rounded-lg group-hover:bg-indigo-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /></svg>
                </div>
                <h3 class="ml-4 text-xl font-bold text-white">General</h3>
            </div>
            <p class="text-gray-400">Manage site name, tagline, email, and other core configuration.</p>
        </a>

        <!-- Branding -->
        <a href="{{ route('admin.settings.branding') }}" class="group block p-6 bg-gray-800 rounded-lg border border-gray-700 hover:border-pink-500 transition-colors">
             <div class="flex items-center mb-4">
                <div class="p-3 bg-pink-500/10 text-pink-500 rounded-lg group-hover:bg-pink-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
                <h3 class="ml-4 text-xl font-bold text-white">Branding</h3>
            </div>
            <p class="text-gray-400">Upload logos, favicons, and social share images.</p>
        </a>

        <!-- SEO -->
        <a href="{{ route('admin.settings.seo') }}" class="group block p-6 bg-gray-800 rounded-lg border border-gray-700 hover:border-green-500 transition-colors">
             <div class="flex items-center mb-4">
                <div class="p-3 bg-green-500/10 text-green-500 rounded-lg group-hover:bg-green-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
                <h3 class="ml-4 text-xl font-bold text-white">SEO & Social</h3>
            </div>
            <p class="text-gray-400">Configure meta tags, robots indexing, and social profiles.</p>
        </a>

        <!-- Scripts -->
        <a href="{{ route('admin.settings.scripts') }}" class="group block p-6 bg-gray-800 rounded-lg border border-gray-700 hover:border-yellow-500 transition-colors">
             <div class="flex items-center mb-4">
                <div class="p-3 bg-yellow-500/10 text-yellow-500 rounded-lg group-hover:bg-yellow-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" /></svg>
                </div>
                <h3 class="ml-4 text-xl font-bold text-white">Scripts</h3>
            </div>
            <p class="text-gray-400">Inject custom execution code into head or body (Analytics, etc).</p>
        </a>

        <!-- Contact -->
        <a href="{{ route('admin.settings.contact.edit') }}" class="group block p-6 bg-gray-800 rounded-lg border border-gray-700 hover:border-blue-500 transition-colors">
             <div class="flex items-center mb-4">
                <div class="p-3 bg-blue-500/10 text-blue-500 rounded-lg group-hover:bg-blue-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                </div>
                <h3 class="ml-4 text-xl font-bold text-white">Contact</h3>
            </div>
            <p class="text-gray-400">Manage contact form recipients and auto-reply messages.</p>
        </a>

        <!-- Languages -->
        <a href="{{ route('admin.settings.languages.index') }}" class="group block p-6 bg-gray-800 rounded-lg border border-gray-700 hover:border-cyan-500 transition-colors">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-cyan-500/10 text-cyan-500 rounded-lg group-hover:bg-cyan-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" /></svg>
                </div>
                <h3 class="ml-4 text-xl font-bold text-white">Languages</h3>
            </div>
            <p class="text-gray-400">Manage site languages, translations, and default locale.</p>
        </a>

    </div>
    </div>
</div>
@endsection
