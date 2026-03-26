<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $meta['title'] ?? setting('site_name') }}</title>
    <meta name="description" content="{{ $meta['description'] ?? setting('site_description') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Mono:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ theme_asset('css/variables.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ theme_asset('css/style.css') }}?v={{ time() }}">

    <!-- Custom Head Scripts -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {!! setting('site_head_scripts') !!}
</head>

<body>

    @include('active_theme::partials.header')

    <main>
        @yield('content')
    </main>

    @include('active_theme::partials.footer')

    <!-- Custom Body Scripts -->
    {!! setting('site_body_scripts') !!}
</body>

</html>
