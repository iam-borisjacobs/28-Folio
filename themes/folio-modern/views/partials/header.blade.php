<header class="site-header" x-data="{ mobileMenuOpen: false }">
    <div class="header-inner">
        <!-- Left Section: Brand -->
        <div class="header-left">
            <a href="{{ route('home') }}" class="brand">
                <span class="brand-bracket">&lt;/&gt;</span>
                {{ setting('site_name', 'James.dev') }}
            </a>
        </div>

        <!-- Center Section: Navigation (Desktop) -->
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
            <!-- Mobile Menu Toggle (Square Button) -->
            <button class="menu-toggle" @click="mobileMenuOpen = true" aria-label="Open Menu">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>

            <!-- Theme Toggle -->
            <button class="theme-toggle" id="theme-toggle" aria-label="Toggle Dark Mode">
                <svg class="sun-icon" width="20" height="20" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
            </button>

            <!-- Desktop Language & Socials (Hidden on Mobile via CSS) -->
            <div class="desktop-controls">
                <div class="lang-switch" x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open" class="lang-btn">
                        <span>{{ app()->getLocale() == 'en' ? '🇺🇸 English' : strtoupper(app()->getLocale()) }}</span>
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"
                            :class="{ 'rotate-180': open }">
                            <path d="M7 10l5 5 5-5z" />
                        </svg>
                    </button>
                    <!-- Dropdown Content Omitted for Brevity - preserved in desktop-controls -->
                </div>
            </div>
        </div>
    </div>

    <!-- MOBILE DRAWER -->
    <div class="mobile-drawer" x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="transform translate-x-full" x-transition:enter-end="transform translate-x-0"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="transform translate-x-0"
        x-transition:leave-end="transform translate-x-full" style="display: none;">

        <div class="drawer-header">
            <a href="{{ route('home') }}" class="brand">
                <span class="brand-bracket">&lt;/&gt;</span>
                {{ setting('site_name', 'James.dev') }}
            </a>
            <button class="close-btn" @click="mobileMenuOpen = false">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <nav class="drawer-nav">
            <a href="{{ route('home') }}" class="drawer-link">Home <span class="arrow">&gt;</span></a>
            <a href="#services" class="drawer-link">Services <span class="arrow">&gt;</span></a>
            <a href="{{ route('projects.index') }}" class="drawer-link">Portfolio <span
                    class="arrow">&gt;</span></a>
            <a href="#resume" class="drawer-link">Pricing <span class="arrow">&gt;</span></a>
            <a href="{{ route('blog.index') }}" class="drawer-link">Blog <span class="arrow">&gt;</span></a>
            <a href="{{ route('contact') }}" class="drawer-link">Contact <span class="arrow">&gt;</span></a>
        </nav>

        <div class="drawer-footer">
            <!-- Mobile Language Switch -->
            <div class="drawer-lang">
                <button class="lang-btn-mobile">
                    🇺🇸 English <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 10l5 5 5-5z" />
                    </svg>
                </button>
            </div>

            <!-- Mobile Socials -->
            <div class="social-links mobile-socials">
                <a href="#" class="social-link"><svg width="18" height="18" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                    </svg></a>
                <a href="#" class="social-link"><svg width="18" height="18" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                    </svg></a>
                <a href="#" class="social-link"><svg width="18" height="18" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                        <rect x="2" y="9" width="4" height="12"></rect>
                        <circle cx="4" cy="4" r="2"></circle>
                    </svg></a>
            </div>
        </div>
    </div>
</header>
