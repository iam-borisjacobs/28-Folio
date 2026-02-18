@extends('admin.layouts.app')

@section('title', 'Theme Management')

@section('content')
<div class="py-6">
    <div class="w-full px-6">
        
        <!-- Header & Breadcrumbs -->
        <div class="flex flex-col mb-8">
            <h1 class="text-5xl font-bold text-white mb-4">Theme Management</h1>
            <nav class="flex text-gray-400 text-lg">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Themes</span>
            </nav>
        </div>

        <!-- Install Theme Section -->
        <div class="bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-700 mb-8">
            <div class="px-8 py-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-2">
                            Installed Themes
                        </h3>
                        <p class="text-lg text-gray-400">
                            Upload and manage your portfolio themes.
                        </p>
                    </div>
                    
                    <div class="w-full md:w-auto">
                        <form action="{{ route('admin.themes.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-center gap-4">
                            @csrf
                            <input type="file" name="theme_zip" accept=".zip" class="block w-full text-sm text-gray-400
                                file:mr-4 file:py-3 file:px-6
                                file:rounded-lg file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-600 file:text-white
                                hover:file:bg-indigo-700
                                bg-gray-900 rounded-lg border border-gray-700
                                focus:outline-none focus:ring-2 focus:ring-indigo-500
                                cursor-pointer
                            "/>
                            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                Upload Theme
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Themes Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($themes as $theme)
                @php $isActive = $activeTheme->slug === $theme->slug; @endphp
                <div class="flex flex-col bg-gray-800 border border-gray-700 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl hover:border-gray-600 transition-all duration-300 transform hover:-translate-y-1 {{ $isActive ? 'ring-2 ring-indigo-500 border-indigo-500' : '' }}">
                    
                    <!-- Preview Image Area -->
                    <div class="relative aspect-video bg-gray-900 border-b border-gray-700 group">
                        @if($theme->preview_image)
                            <img src="{{ theme_asset($theme->slug . '/' . $theme->preview_image) }}" 
                                 alt="{{ $theme->name }}" 
                                 class="object-cover w-full h-full transition-opacity duration-300"
                                 onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                            <!-- Fallback if image fails to load -->
                            <div class="hidden absolute inset-0 flex flex-col items-center justify-center text-gray-600 bg-gray-900">
                                <svg class="w-12 h-12 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span class="text-xs font-semibold uppercase tracking-wider">Preview Missing</span>
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center w-full h-full text-gray-600 bg-gray-900">
                                <svg class="w-12 h-12 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span class="text-xs font-semibold uppercase tracking-wider">No Preview</span>
                            </div>
                        @endif

                        @if($isActive)
                            <div class="absolute top-4 right-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide bg-indigo-500 text-white shadow-lg">
                                    <svg class="w-2.5 h-2.5 mr-1.5 text-white animate-pulse" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>
                                    Active
                                </span>
                            </div>
                        @endif
                        
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h4 class="text-xl font-bold text-white mb-1 tracking-tight">{{ $theme->name }}</h4>
                                <div class="flex items-center gap-3 text-xs font-medium text-gray-400">
                                    <span class="bg-gray-700/50 px-2 py-0.5 rounded border border-gray-600/50">v{{ $theme->version }}</span>
                                    <span>by {{ $theme->author }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <p class="text-gray-400 text-sm leading-relaxed mb-6 line-clamp-3">
                            {{ $theme->description }}
                        </p>
                        
                        <div class="mt-auto pt-5 border-t border-gray-700 flex gap-3">
                            @if(!$isActive)
                                <form action="{{ route('admin.themes.activate') }}" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="slug" value="{{ $theme->slug }}">
                                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-600 shadow-sm text-sm font-medium rounded-lg text-white bg-gray-800 hover:bg-gray-700 hover:border-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                                        Activate
                                    </button>
                                </form>
                            @else
                                <button disabled class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-indigo-200 bg-indigo-900/40 cursor-not-allowed">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Activated
                                </button>
                            @endif

                            @if($theme->slug !== 'default' && !$isActive)
                                <form action="{{ route('admin.themes.destroy', $theme->slug) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this theme?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex justify-center items-center px-3 py-2 border border-gray-600 shadow-sm text-sm font-medium rounded-lg text-gray-400 bg-gray-800 hover:bg-red-900/30 hover:text-red-400 hover:border-red-900/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all" title="Delete Theme">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
