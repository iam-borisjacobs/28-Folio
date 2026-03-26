<section class="w-full flex justify-center px-4 lg:px-0" id="skills">
        <div class="w-full relative overflow-hidden rounded-[20px] p-8 md:p-12 lg:p-16 h-full" 
             style="max-width: var(--container-width); margin: 1rem auto 0; background: var(--bg-card); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid var(--glass-border); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3); background-image: linear-gradient(var(--bg-card), var(--bg-card)), radial-gradient(circle, rgba(255, 255, 255, 0.03) 1px, transparent 1px); background-size: auto, 24px 24px;">
            <h2 class="text-3xl font-mono text-white mb-16 text-center tracking-wide heading-glow">
                {!! str_replace('My', '<span class="text-green-500">My</span>', $blockData['title'] ?? 'My Skills') !!}
            </h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <!-- LEFT: Floating Icon Grid -->
            <div class="grid grid-cols-4 gap-4 md:gap-6 w-full max-w-lg mx-auto lg:mx-0">
                @if(!empty($blockData['icons']))
                    @foreach($blockData['icons'] as $icon)
                        <div class="aspect-square bg-[#141824] border border-gray-800 rounded-xl md:rounded-2xl p-4 flex items-center justify-center hover:bg-[#1e2330] hover:border-green-500 hover:shadow-[0_0_20px_rgba(34,197,94,0.1)] transition-all duration-300 group">
                            @if(isset($icon['image']))
                                <img src="{{ Storage::url($icon['image']) }}" alt="{{ $icon['name'] ?? 'Skill' }}" class="w-full h-full object-contain grayscale opacity-60 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-300 transform group-hover:scale-110">
                            @endif
                        </div>
                    @endforeach
                @else
                    <!-- Fallback placehodlers -->
                    @for($i=0; $i<12; $i++)
                        <div class="aspect-square bg-[#141824] border border-gray-800 rounded-2xl flex items-center justify-center p-4">
                            <div class="w-8 h-8 rounded-full bg-gray-800 animate-pulse"></div>
                        </div>
                    @endfor
                @endif
            </div>

            <!-- RIGHT: Skills Bullet List -->
            <div class="w-full">
                @if(!empty($blockData['categories']))
                    <ul class="space-y-8 pl-4 border-l border-gray-800 relative">
                        @foreach($blockData['categories'] as $category)
                            <li class="relative pl-6">
                                <!-- Neon Bullet Point -->
                                <span class="absolute left-[-4.5px] top-1.5 w-2 h-2 bg-green-500 rounded-full shadow-[0_0_8px_rgba(34,197,94,0.8)]"></span>
                                
                                <p class="text-gray-400 text-sm md:text-base leading-relaxed">
                                    <span class="text-white font-bold tracking-wide mr-2">{{ $category['category_name'] ?? 'Category' }}:</span> 
                                    {{ $category['skills_list'] ?? 'HTML, CSS, JavaScript' }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-gray-500 text-sm">Add some skill categories in the admin panel...</div>
                @endif
            </div>

        </div>
        </div>
</section>
