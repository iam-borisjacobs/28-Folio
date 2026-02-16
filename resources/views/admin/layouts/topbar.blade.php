<div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-transparent bg-transparent px-4 shadow-none sm:gap-x-6 sm:px-6">
    <button type="button" class="-m-2.5 p-2.5 text-gray-700 dark:text-gray-200 lg:hidden" @click="sidebarOpen = true">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>

    <div class="h-6 w-px bg-gray-200 dark:bg-gray-700 lg:hidden" aria-hidden="true"></div>
    <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
        <div class="flex flex-1 items-center">
            @if(setting('logo_url'))
                <img src="{{ Storage::url(setting('logo_url')) }}" alt="{{ setting('site_name', 'Folio') }}" class="lg:hidden h-8 w-auto ml-4">
            @else
                <span class="lg:hidden text-gray-900 dark:text-white text-lg font-bold ml-4">{{ setting('site_name', 'Folio') }}</span>
            @endif
        </div>
        <div class="flex items-center gap-x-4 lg:gap-x-6">
            
            <!-- Create New Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" type="button" class="-m-2.5 p-2.5 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                    <span class="sr-only">Create New</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
                <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white dark:bg-gray-800 py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none" style="display: none;">
                    <!-- Placeholder items -->
                    <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">New Project</a>
                    <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">New Post</a>
                </div>
            </div>

            <div class="h-6 w-px bg-gray-200 dark:bg-gray-700" aria-hidden="true"></div>

            <!-- Profile Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" type="button" class="-m-1.5 flex items-center p-1.5">
                    <span class="sr-only">Open user menu</span>
                    <div class="h-8 w-8 rounded-full bg-gray-500 flex items-center justify-center text-white font-bold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <span class="hidden lg:flex lg:items-center">
                        <span class="ml-4 text-sm font-semibold leading-6 text-gray-900 dark:text-white" aria-hidden="true">{{ auth()->user()->name }}</span>
                        <svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
                <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white dark:bg-gray-800 py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none" style="display: none;">
                    <a href="{{ route('profile.edit') }}" class="block px-3 py-1 text-sm leading-6 text-gray-900 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">Your Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-1 text-sm leading-6 text-gray-900 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">Sign out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
