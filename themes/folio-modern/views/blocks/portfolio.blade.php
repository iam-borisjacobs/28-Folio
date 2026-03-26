@php
    $limit = $blockData['limit'] ?? 4;
    $projects = \App\Models\Project::whereIn('status', ['published', 'active'])
        ->with(['translations', 'categories', 'tags'])
        ->orderBy('is_featured', 'desc')
        ->latest('published_at')
        ->take($limit)
        ->get();
@endphp
<section class="w-full flex justify-center px-4 lg:px-0" id="portfolio">
        <!-- Giant Glass Container (Matches Services/Stats Aesthetic) -->
        <div class="w-full relative overflow-hidden rounded-[20px] p-8 md:p-12 lg:p-16 h-full" 
             style="max-width: var(--container-width); margin: 1rem auto 0; background: var(--bg-card); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid var(--glass-border); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3); background-image: linear-gradient(var(--bg-card), var(--bg-card)), radial-gradient(circle, rgba(255, 255, 255, 0.03) 1px, transparent 1px); background-size: auto, 24px 24px;">
            
            <!-- Section Header (Inside the Glass Container) -->
            <div class="mb-10 text-left relative z-10 w-full">
                <span class="text-green-500 font-mono text-sm tracking-widest mb-3 block flex items-center justify-start gap-2">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full shadow-[0_0_8px_rgba(34,197,94,0.8)]"></span>
                    PROJECTS
                </span>
                <h2 class="text-4xl font-mono text-white font-bold heading-glow">{{ $blockData['title'] ?? 'My Recent Works' }}</h2>
            </div>
            
            @if($projects->count() > 0)
                <!-- Custom Carousel Container -->
                <div class="flex overflow-x-auto snap-x snap-mandatory hide-scrollbar gap-8 pb-6 relative z-10" id="portfolio-slider">
                    @foreach($projects as $project)
                        <!-- Card without its own background, perfectly embedded in the giant box -->
                        <div class="snap-center shrink-0 w-full relative">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-14 items-center h-full">
                                
                                <!-- LEFT: Image -->
                                <div class="w-full bg-[#161a23] rounded-2xl overflow-hidden shadow-inner flex items-center justify-center min-h-[300px] lg:min-h-[400px] h-full border border-gray-800 relative group">
                                    <a href="{{ route('projects.show', $project) }}" class="block w-full h-full relative">
                                        <!-- Overlay gradient for extra dark feel -->
                                        <div class="absolute inset-0 bg-gradient-to-t from-[#0f172a] to-transparent opacity-40 z-10 pointer-events-none"></div>
                                        @if ($project->featured_image)
                                            <img src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out">
                                        @else
                                            <div class="w-full h-full text-gray-600 flex items-center justify-center py-20 text-sm font-mono">No Image Available</div>
                                        @endif
                                    </a>
                                </div>

                                <!-- RIGHT: Details -->
                                <div class="flex flex-col justify-center h-full py-4 lg:pb-4 w-full">
                                    @php
                                        // Try to pull a default category or fallback
                                        $catName = $project->categories->first()->name ?? 'Development';
                                    @endphp
                                    <div class="text-green-500 font-bold text-sm tracking-widest mb-3 uppercase flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.8)] opacity-70"></span>
                                        {{ $catName }}
                                    </div>
                                    
                                    <a href="{{ route('projects.show', $project) }}"><h3 class="text-white text-3xl font-bold font-mono heading-glow mb-4 hover:text-green-400 transition-colors">{{ $project->title }}</h3></a>
                                    <p class="text-gray-400 text-sm leading-relaxed mb-10 border-b border-gray-800/50 pb-8">{{ Str::limit($project->short_description ?? $project->full_description, 180) }}</p>
                                    
                                    <h4 class="text-pink-500 font-mono text-xs uppercase tracking-widest mb-6 flex items-center gap-2">
                                        <span class="w-1 h-1 rounded-full bg-pink-500"></span> Project Info
                                    </h4>
                                    
                                    <ul class="space-y-5 mb-12 w-full pr-0 lg:pr-12">
                                        @if($project->role)
                                        <li class="flex justify-between items-center text-sm border-b border-gray-800/50 pb-3">
                                            <span class="flex items-center gap-2 text-white font-semibold">
                                                <span class="text-green-500 inline-block w-1.5 h-1.5 rounded-full"></span> Role
                                            </span>
                                            <span class="text-gray-400 font-mono text-right">{{ $project->role }}</span>
                                        </li>
                                        @endif
                                        @if($project->client)
                                        <li class="flex justify-between items-center text-sm border-b border-gray-800/50 pb-3">
                                            <span class="flex items-center gap-2 text-white font-semibold">
                                                <span class="text-green-500 inline-block w-1.5 h-1.5 rounded-full"></span> Client
                                            </span>
                                            <span class="text-gray-400 font-mono text-right">{{ $project->client }}</span>
                                        </li>
                                        @endif
                                        @if($project->duration)
                                        <li class="flex justify-between items-center text-sm border-b border-gray-800/50 pb-3">
                                            <span class="flex items-center gap-2 text-white font-semibold">
                                                <span class="text-green-500 inline-block w-1.5 h-1.5 rounded-full"></span> Duration
                                            </span>
                                            <span class="text-gray-400 font-mono text-right">{{ $project->duration }}</span>
                                        </li>
                                        @endif
                                    </ul>

                                    <div class="flex flex-wrap items-center gap-4">
                                        @if($project->project_url)
                                            <a href="{{ $project->project_url }}" target="_blank" class="flex items-center gap-3 bg-transparent hover:bg-white box-border border-2 border-gray-700 hover:border-white transition-all px-6 py-2.5 rounded-full text-white hover:text-black text-sm font-bold group">
                                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" class="transform group-hover:-translate-y-0.5 group-hover:translate-x-0.5 transition-transform"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H7m10 0v10"></path></svg>
                                                Live Demo
                                            </a>
                                        @endif
                                        @if($project->github_url)
                                            <a href="{{ $project->github_url }}" target="_blank" class="flex items-center gap-3 bg-transparent hover:bg-[#1e2330] border-0 px-4 py-2.5 rounded-full text-gray-400 hover:text-white text-sm font-bold transition-colors">
                                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.699-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.831.092-.646.35-1.086.636-1.336-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.026A9.578 9.578 0 0112 6.836c.85.004 1.705.114 2.504.336 1.909-1.295 2.747-1.026 2.747-1.026.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.161 22 16.416 22 12c0-5.523-4.477-10-10-10z"/></svg>
                                                View on GitHub
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Absolute Navigation Arrows (Positioned at bottom right of the entire glass box) -->
                @if($projects->count() > 1)
                <div class="absolute bottom-10 right-10 lg:bottom-12 lg:right-12 flex items-center gap-3 z-20">
                    <button onclick="document.getElementById('portfolio-slider').scrollBy({left: -window.innerWidth * 0.8, behavior: 'smooth'})" class="w-12 h-12 rounded-full bg-gray-800/50 backdrop-blur-sm border border-gray-700 flex items-center justify-center text-gray-300 hover:text-white hover:bg-gray-700 hover:border-green-500 transition-all focus:outline-none shadow-lg">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    </button>
                    <button onclick="document.getElementById('portfolio-slider').scrollBy({left: window.innerWidth * 0.8, behavior: 'smooth'})" class="w-12 h-12 rounded-full bg-gray-800/50 backdrop-blur-sm border border-gray-700 flex items-center justify-center text-gray-300 hover:text-white hover:bg-gray-700 hover:border-green-500 transition-all focus:outline-none shadow-lg">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </button>
                </div>
                @endif

                <style>
                    .hide-scrollbar::-webkit-scrollbar {
                        display: none;
                    }
                    .hide-scrollbar {
                        -ms-overflow-style: none; /* IE and Edge */
                        scrollbar-width: none; /* Firefox */
                    }
                </style>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const slider = document.getElementById('portfolio-slider');
                        if (!slider || slider.children.length <= 1) return;
                        
                        const slideNext = () => {
                            // If scrolled to the end, smoothly return to start
                            if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 10) {
                                slider.scrollTo({ left: 0, behavior: 'smooth' });
                            } else {
                                slider.scrollBy({ left: slider.clientWidth * 0.8, behavior: 'smooth' });
                            }
                        };
                        
                        // Auto-scroll every 4 seconds
                        let autoScrollInterval = setInterval(slideNext, 4000);
                        
                        // Pause moving when the user is hovering over the card
                        slider.parentElement.addEventListener('mouseenter', () => clearInterval(autoScrollInterval));
                        slider.parentElement.addEventListener('mouseleave', () => {
                            clearInterval(autoScrollInterval); // Prevent duplicates
                            autoScrollInterval = setInterval(slideNext, 4000);
                        });
                    });
                </script>

            @else
                <div class="text-muted text-center py-20 border border-gray-800 rounded-3xl bg-[#141824] bg-opacity-50">No projects found. Add some in the admin panel!</div>
            @endif
        </div>
</section>
