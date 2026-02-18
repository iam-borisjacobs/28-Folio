<header class="site-header">
    <div class="header-inner">
        <!-- Left Section: Menu + Brand -->
        <div class="header-left">
            <button class="menu-toggle" aria-label="Toggle Menu">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>

            <a href="{{ route('home') }}" class="brand">
                <span class="brand-bracket">&lt;/&gt;</span>
                {{ setting('site_name', 'James.dev') }}
            </a>
        </div>

        <!-- Center Section: Navigation -->
        <nav class="header-center">
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}"
                        class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="#services" class="nav-link">Services</a></li>
                <li><a href="{{ route('projects.index') }}"
                        class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}">Portfolio</a></li>
                <li><a href="#resume" class="nav-link">Pricing</a></li>
                <li><a href="{{ route('blog.index') }}"
                        class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a></li>
                <li><a href="{{ route('contact') }}"
                        class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
            </ul>
        </nav>

        <!-- Right Section: Controls -->
        <div class="header-right">
            <!-- Language -->
            <div class="lang-switch" x-data="{ open: false }" @click.away="open = false">
                <button @click="open = !open" class="lang-btn">
                    <span>
                        @switch(app()->getLocale())
                            @case('es')
                                🇪🇸 Español
                            @break

                            @case('fr')
                                🇫🇷 Français
                            @break

                            @case('de')
                                🇩🇪 Deutsch
                            @break

                            @case('vi')
                                🇻🇳 Tiếng Việt
                            @break

                            @case('ar')
                                🇸🇦 Arabic
                            @break

                            @default
                                🇺🇸 English
                        @endswitch
                    </span>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"
                        :class="{ 'rotate-180': open }" style="transition: transform 0.2s;">
                        <path d="M7 10l5 5 5-5z" />
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95" class="lang-dropdown" style="display: none;">
                    @foreach (\App\Models\Language::where('is_active', true)->orderBy('sort_order')->get() as $lang)
                        <a href="{{ route('lang.switch', $lang->code) }}"
                            class="lang-item {{ app()->getLocale() == $lang->code ? 'active' : '' }}">
                            <span class="lang-flag">
                                @switch($lang->code)
                                    @case('es')
                                        🇪🇸
                                    @break

                                    @case('fr')
                                        🇫🇷
                                    @break

                                    @case('de')
                                        🇩🇪
                                    @break

                                    @case('vi')
                                        🇻🇳
                                    @break

                                    @case('ar')
                                        🇸🇦
                                    @break

                                    @default
                                        🇺🇸
                                @endswitch
                            </span>
                            <span class="lang-name">{{ $lang->name }}</span>
                            @if (app()->getLocale() == $lang->code)
                                <svg class="check-icon" width="12" height="12" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="3">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Socials -->
            <!-- Socials -->
            <div class="social-links">
                @if (setting('social_facebook'))
                    <a href="{{ setting('social_facebook') }}" class="social-link" title="Facebook" target="_blank"
                        rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M9.101 23.691v-7.98H6.627v-3.667h2.474v-1.58c0-4.085 1.848-5.978 5.858-5.978.401 0 .955.042 1.468.103a8.68 8.68 0 0 1 1.141.195v3.325a8.623 8.623 0 0 0-.653-.036c-2.148 0-2.971.956-2.971 3.594v.376h3.617l-.571 3.667h-3.046v7.98h-4.844Z" />
                        </svg>
                    </a>
                @endif

                @if (setting('social_twitter'))
                    <a href="https://twitter.com/{{ setting('social_twitter') }}" class="social-link"
                        title="X (Twitter)" target="_blank" rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                        </svg>
                    </a>
                @endif

                @if (setting('social_youtube'))
                    <a href="{{ setting('social_youtube') }}" class="social-link" title="YouTube" target="_blank"
                        rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                        </svg>
                    </a>
                @endif

                @if (setting('social_linkedin'))
                    <a href="{{ setting('social_linkedin') }}" class="social-link" title="LinkedIn" target="_blank"
                        rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                        </svg>
                    </a>
                @endif

                @if (setting('social_instagram'))
                    <a href="{{ setting('social_instagram') }}" class="social-link" title="Instagram"
                        target="_blank" rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </a>
                @endif
            </div>

            <!-- Theme Toggle -->
            <button class="theme-toggle" id="theme-toggle" aria-label="Toggle Dark Mode">
                <svg class="sun-icon" width="20" height="20" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
            </button>
        </div>
    </div>
</header>
