@extends('active_theme::layouts.theme_layout')

@section('content')

    @if ($page->blocks && is_array($page->blocks))
        @foreach ($page->blocks as $block)
            @php
                // The block type (e.g., 'hero', 'stats')
                $type = $block['type'] ?? '';
                // The actual form data from Filament
                $blockData = $block['data'] ?? [];
            @endphp

            {{-- Dynamically check if the block view exists in the active theme --}}
            @if (View::exists("active_theme::blocks.{$type}"))
                @include("active_theme::blocks.{$type}", ['blockData' => $blockData])
            @else
                <!-- Missing Block View: active_theme::blocks.{{ $type }} -->
            @endif
        @endforeach
    @else
        <div class="container" style="padding: 10rem 0; text-align: center;">
            <h2>Page has no content blocks yet.</h2>
            <p>Edit this page in the admin panel to add sections.</p>
        </div>
    @endif

@endsection
