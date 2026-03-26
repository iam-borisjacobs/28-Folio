<section class="w-full flex justify-center px-4 lg:px-0" id="resume">
        <div class="w-full relative overflow-hidden rounded-[20px] p-8 md:p-12 lg:p-16 h-full text-sm" 
             style="max-width: var(--container-width); margin: 1rem auto 0; background: var(--bg-card); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid var(--glass-border); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3); background-image: linear-gradient(var(--bg-card), var(--bg-card)), radial-gradient(circle, rgba(255, 255, 255, 0.03) 1px, transparent 1px); background-size: auto, 24px 24px;">
            
            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 mb-12">
                <!-- Top Left: Passion & Logos -->
                <div>
                    <h2 class="text-3xl font-mono text-white mb-8 passion-title leading-snug">
                        {!! $blockData['passion_text'] ?? '<span class="text-green-500">+12</span> years of <span class="text-gray-400 font-serif italic">passion</span> <br>for programming techniques' !!}
                    </h2>
                    
                    @if(!empty($blockData['logos']))
                        <div class="flex flex-wrap gap-8 items-center mt-6">
                            @foreach($blockData['logos'] as $logo)
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 flex items-center justify-center bg-[#1e2330] rounded-lg border border-gray-700 p-2">
                                        @if(isset($logo['image']))
                                            <img src="{{ Storage::url($logo['image']) }}" alt="{{ $logo['name'] }}" class="h-full object-contain" />
                                        @endif
                                    </div>
                                    <div>
                                        <div class="text-white font-bold text-sm tracking-wide">{{ $logo['name'] }}</div>
                                        @if(!empty($logo['years']))
                                            <div class="text-xs text-gray-500 font-mono">{{ $logo['years'] }}</div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Top Right: Background Exp -->
                <div>
                    <h3 class="text-green-500 font-mono text-xs tracking-widest uppercase mb-5">Extensive Background Experience</h3>
                    @if(!empty($blockData['background_experience']))
                        <ul class="space-y-4 border-l border-gray-800 pl-4 py-2">
                            @foreach($blockData['background_experience'] as $exp)
                                <li class="flex items-start gap-3 text-gray-400 text-sm leading-relaxed">
                                    <span class="text-green-500 mt-1">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M5 12h14m-4-4l4 4-4 4"></path></svg>
                                    </span>
                                    {!! $exp['title'] !!}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="border-t border-gray-800 my-10 relative"></div>

            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Bottom Left: Education -->
                <div>
                    <h3 class="text-white text-2xl font-bold font-mono mb-8 flex items-center gap-3">
                        <span class="text-green-500">
                            <!-- Education Hat Icon -->
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2.12-1.15V17h2V8.46L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72l5 2.73 5-2.73v3.72z"/></svg>
                        </span>
                        {{ $blockData['education_title'] ?? 'Education' }}
                    </h3>
                    <div class="timeline-dark pl-2 border-l border-gray-800 ml-3">
                        @if (isset($blockData['education']) && count($blockData['education']) > 0)
                            @foreach ($blockData['education'] as $edu)
                                <div class="timeline-item relative pl-8 pb-8">
                                    <span class="absolute left-[-5px] top-1 w-2.5 h-2.5 rounded-full bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.8)]"></span>
                                    <span class="text-green-500 font-mono text-xs block mb-2">{{ $edu['date'] ?? '' }}</span>
                                    <h4 class="text-white text-lg font-bold mb-1">{{ $edu['degree'] ?? '' }}</h4>
                                    <p class="text-gray-400 text-sm mb-2 opacity-80">{{ $edu['organization'] ?? '' }}</p>
                                    @if (isset($edu['description']) && !empty($edu['description']))
                                        <p class="text-gray-500 text-sm leading-relaxed">{{ $edu['description'] }}</p>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Bottom Right: Experience -->
                <div>
                    <h3 class="text-white text-2xl font-bold font-mono mb-8 flex items-center gap-3">
                        <span class="text-green-500">
                            <!-- Experience Briefcase Icon -->
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M20 6h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zM10 4h4v2h-4V4zm10 15H4V8h16v11z"/></svg>
                        </span>
                        {{ $blockData['experience_title'] ?? 'Experience' }}
                    </h3>
                    <div class="timeline-dark pl-2 border-l border-gray-800 ml-3">
                        @if (isset($blockData['experience']) && count($blockData['experience']) > 0)
                            @foreach ($blockData['experience'] as $exp)
                                <div class="timeline-item relative pl-8 pb-8">
                                    <span class="absolute left-[-5px] top-1 w-2.5 h-2.5 rounded-full bg-gray-600"></span>
                                    <span class="text-gray-500 font-mono text-xs block mb-2">{{ $exp['year'] ?? '' }}</span>
                                    <h4 class="text-white text-lg font-bold mb-1">{{ $exp['title'] ?? '' }}</h4>
                                    <p class="text-green-400 text-sm mb-2">{{ $exp['company'] ?? '' }}</p>
                                    @if (isset($exp['description']) && !empty($exp['description']))
                                        <p class="text-gray-500 text-sm leading-relaxed">{{ $exp['description'] }}</p>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
</section>
