<footer class="site-footer">
    <div class="container">
        <div class="flex flex-col items-center justify-center text-center">
            
            <!-- Brand -->
            <div class="brand mb-4" style="margin-bottom: 1.5rem;">
                <span class="brand-bracket">&lt;/&gt;</span>
                {{ setting('site_name', 'James.dev') }}
            </div>

            <!-- Nav -->
            <nav class="mb-6" style="margin-bottom: 2rem;">
                <ul class="flex gap-4 justify-center" style="gap: 2rem; flex-wrap: wrap;">
                   <li><a href="{{ route('home') }}" class="text-muted hover:text-white">Home</a></li>
                   <li><a href="{{ route('projects.index') }}" class="text-muted hover:text-white">Portfolio</a></li>
                   <li><a href="{{ route('blog.index') }}" class="text-muted hover:text-white">Blog</a></li>
                   <li><a href="{{ route('contact') }}" class="text-muted hover:text-white">Contact</a></li>
                </ul>
            </nav>

            <!-- Copyright -->
            <p class="text-muted text-sm">
                &copy; {{ date('Y') }} {{ setting('site_name', 'James.dev') }}. All rights reserved.
            </p>
        </div>
    </div>
</footer>
