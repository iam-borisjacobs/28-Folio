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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ theme_asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ theme_asset('css/style.css') }}">

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
