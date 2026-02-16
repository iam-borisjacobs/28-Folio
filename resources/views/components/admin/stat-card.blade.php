@props(['label', 'value', 'color' => 'blue', 'icon' => null])

@php
    $colors = [
        'blue' => [
            'icon_bg' => 'bg-blue-500',
            'icon_text' => 'text-white',
            'value_text' => 'text-blue-400',
        ],
        'green' => [
            'icon_bg' => 'bg-emerald-500',
            'icon_text' => 'text-white',
            'value_text' => 'text-emerald-400',
        ],
        'purple' => [
            'icon_bg' => 'bg-violet-500',
            'icon_text' => 'text-white',
            'value_text' => 'text-violet-400',
        ],
        'orange' => [
            'icon_bg' => 'bg-orange-500',
            'icon_text' => 'text-white',
            'value_text' => 'text-orange-400',
        ],
        'yellow' => [
            'icon_bg' => 'bg-yellow-500',
            'icon_text' => 'text-white',
            'value_text' => 'text-yellow-400',
        ],
    ];

    $theme = $colors[$color] ?? $colors['blue'];
@endphp

<div class="bg-gray-800 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-600 transition-colors">
    <div class="flex flex-col h-full justify-between">
        <!-- Icon -->
        <div class="mb-4">
            <div class="w-12 h-12 rounded-lg flex items-center justify-center {{ $theme['icon_bg'] }} {{ $theme['icon_text'] }} shadow-lg shadow-{{ $color }}-500/20">
                {{ $icon }}
            </div>
        </div>
        
        <!-- Label -->
        <div class="text-lg font-medium text-gray-400 mb-1">
            {{ $label }}
        </div>
        
        <!-- Value -->
        <!-- Value -->
        <div class="text-5xl font-bold {{ $theme['value_text'] }} tracking-tight mt-auto" style="text-shadow: 0 0 15px currentColor, 0 0 30px currentColor;">
            {{ $value }}
        </div>

        @if(isset($slot) && $slot->isNotEmpty())
        <div class="mt-4">
            {{ $slot }}
        </div>
        @endif
    </div>
</div>
