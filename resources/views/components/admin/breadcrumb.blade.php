@props(['items' => []])

<nav class="flex" aria-label="Breadcrumb">
    <ol role="list" class="flex items-center space-x-4">
        <li>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117.414 11H16v5a2 2 0 01-2 2h-4a2 2 0 01-2-2v-5H4.293a1 1 0 01-1.414-1.414l7-7z" clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">Home</span>
                </a>
            </div>
        </li>
        @foreach($items as $label => $link)
            <li>
                <div class="flex items-center">
                    <svg class="h-5 w-5 flex-shrink-0 text-gray-300" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                    </svg>
                    @if($link)
                        <a href="{{ $link }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $label }}</a>
                    @else
                        <span class="ml-4 text-sm font-medium text-gray-500" aria-current="page">{{ $label }}</span>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</nav>
