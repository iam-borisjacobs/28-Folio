<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-900 dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('site_name', 'Folio Admin') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased">
    <div class="min-h-screen bg-gray-900 text-gray-100" x-data="{ sidebarOpen: false }">
        
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <div class="lg:pl-96">
            <!-- Topbar -->
            @include('admin.layouts.topbar')

            <main class="py-10">
                <div class="px-4 sm:px-6 lg:px-8">
                    @include('components.admin.flash-messages')

                    @hasSection('header')
                        <header class="mb-8">
                            @yield('header')
                        </header>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
