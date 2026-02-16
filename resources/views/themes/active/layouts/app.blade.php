@inject('seoService', 'App\Services\SeoService')
@php
    $seo = $seoService->generate(View::getShared()['seo'] ?? []);
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $seo['title'] }}</title>
    <meta name="description" content="{{ $seo['description'] }}">
    <link rel="canonical" href="{{ $seo['url'] }}">
    <meta name="robots" content="{{ $seo['robots'] }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ $seo['type'] }}">
    <meta property="og:url" content="{{ $seo['url'] }}">
    <meta property="og:title" content="{{ $seo['title'] }}">
    <meta property="og:description" content="{{ $seo['description'] }}">
    <meta property="og:image" content="{{ $seo['image'] }}">
    <meta property="og:site_name" content="{{ $seo['site_name'] }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ $seo['url'] }}">
    <meta property="twitter:title" content="{{ $seo['title'] }}">
    <meta property="twitter:description" content="{{ $seo['description'] }}">
    <meta property="twitter:image" content="{{ $seo['image'] }}">
    @if($seo['twitter_handle'])
        <meta name="twitter:site" content="{{ $seo['twitter_handle'] }}">
    @endif

    <!-- Alternates -->
    @if(isset($seo['alternates']))
        @foreach($seo['alternates'] as $langCode => $url)
            <link rel="alternate" hreflang="{{ $langCode }}" href="{{ $url }}">
        @endforeach
    @endif

    <!-- Custom Scripts (Head) -->
    {!! $seoService->getScripts('head') !!}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-900 text-gray-100">
    <!-- Custom Scripts (Body Start) -->
    {!! $seoService->getScripts('body_start') !!}

    <div class="min-h-screen">
        <header class="bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <a href="{{ url('/') }}" class="text-xl font-bold text-white">
                    {{ $seo['site_name'] }}
                </a>
                <nav class="flex items-center space-x-4">
                    <a href="{{ route('projects.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Projects</a>
                    <a href="{{ route('blog.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Blog</a>
                    
                    <!-- Language Switcher -->
                    @if(isset($seo['alternates']) && count($seo['alternates']) > 1)
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex items-center">
                                <span class="uppercase">{{ app()->getLocale() }}</span>
                                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                @foreach($seo['alternates'] as $code => $url)
                                    <a href="{{ $url }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 uppercase {{ app()->getLocale() === $code ? 'font-bold' : '' }}">
                                        {{ $code }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
                    @endauth
                </nav>
            </div>
        </header>

        <main>
            @yield('content')
        </main>
        
        <footer class="bg-gray-800 mt-12 py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-400">
                &copy; {{ date('Y') }} {{ $seo['site_name'] }}. All rights reserved.
            </div>
        </footer>
    </div>

    <!-- Custom Scripts (Body End) -->
    {!! $seoService->getScripts('body_end') !!}
</body>
</html>
