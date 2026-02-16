<header class="site-header">
    <div class="container">
        <div class="header-inner">
            <a href="{{ route('home') }}" class="logo">
                @if(setting('site_logo'))
                    <img src="{{ Storage::url(setting('site_logo')) }}" alt="{{ setting('site_name') }}">
                @else
                    <span class="text-xl font-bold">{{ setting('site_name', 'Folio') }}</span>
                @endif
            </a>
            
            <nav class="main-nav">
                <ul>
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('projects.index') }}" class="{{ request()->routeIs('projects.*') ? 'active' : '' }}">Projects</a></li>
                    <li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a></li>
                    <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                </ul>
            </nav>
            
            <div class="header-actions">
                <a href="#contact" class="btn btn-sm">Let's Talk</a>
            </div>
        </div>
    </div>
</header>

<style>
.site-header {
    padding: 20px 0;
    position: sticky;
    top: 0;
    z-index: 100;
    background-color: rgba(16, 16, 26, 0.9);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid var(--border-color);
}
.header-inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.logo img {
    height: 40px;
}
.logo span {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--text-main);
}
.main-nav ul {
    display: flex;
    gap: 30px;
    list-style: none;
    padding: 0;
    margin: 0;
}
.main-nav a {
    font-weight: 500;
    font-size: 0.95rem;
    color: var(--text-muted);
}
.main-nav a:hover, .main-nav a.active {
    color: var(--primary);
}
@media (max-width: 768px) {
    .main-nav { display: none; } /* Mobile menu simplified for now */
}
</style>
