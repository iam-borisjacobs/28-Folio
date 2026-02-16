@props(['title', 'message', 'action' => null, 'url' => '#', 'icon' => null])

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 text-center border border-dashed border-gray-300">
    @if($icon)
        <div class="mx-auto h-12 w-12 text-gray-400 mb-4">
            {{ $icon }}
        </div>
    @endif
    
    <h3 class="text-lg font-medium text-gray-900">{{ $title }}</h3>
    <p class="mt-1 text-sm text-gray-500">{{ $message }}</p>
    
    @if($action)
        <div class="mt-6">
            <a href="{{ $url }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                {{ $action }}
            </a>
        </div>
    @endif
</div>
