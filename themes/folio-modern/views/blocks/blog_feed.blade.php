@php
    $limit = $blockData['limit'] ?? 3;
    $posts = \App\Models\Post::published()
            ->with(['translations', 'categories'])
            ->latest('published_at')
            ->take($limit)
            ->get();
@endphp

<section class="w-full flex justify-center px-4 lg:px-0" id="blog">
        <div class="w-full relative overflow-hidden rounded-[20px] p-8 md:p-12 lg:p-16 h-full" 
             style="max-width: var(--container-width); margin: 1rem auto 0; background: var(--bg-card); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid var(--glass-border); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3); background-image: linear-gradient(var(--bg-card), var(--bg-card)), radial-gradient(circle, rgba(255, 255, 255, 0.03) 1px, transparent 1px); background-size: auto, 24px 24px;">
            <!-- Centered Dashed Title -->
            <h2 class="text-2xl md:text-3xl font-mono text-center text-gray-300 tracking-wider mb-16 opacity-80" style="text-shadow: 0 0 10px rgba(255,255,255,0.1)">
            -- {!! str_replace('blog', '<span class="text-white font-bold opacity-100">blog</span>', $blockData['title'] ?? 'Recent blog') !!} --
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
                <div class="bg-[#141824] border border-gray-800 rounded-2xl overflow-hidden hover:-translate-y-2 transition-transform duration-300 shadow-xl group">
                    <!-- Image Wrapper -->
                    <div class="relative h-[240px] w-full bg-[#1e2330] overflow-hidden">
                        <a href="{{ route('blog.show', $post) }}" class="block w-full h-full">
                            @if($post->featured_image)
                                <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-600 bg-[#1e2a3b] bg-opacity-20">No Image</div>
                            @endif
                        </a>
                        
                        <!-- Floating Category Badge -->
                        @if($post->categories->count() > 0)
                            <div class="absolute bottom-4 left-4 bg-[#1e2330] bg-opacity-90 backdrop-blur-md border border-gray-700 text-gray-300 text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">
                                {{ $post->categories->first()->name }}
                            </div>
                        @else
                            <div class="absolute bottom-4 left-4 bg-[#1e2330] bg-opacity-90 backdrop-blur-md border border-gray-700 text-gray-300 text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">
                                Article
                            </div>
                        @endif
                    </div>
                    
                    <!-- Content -->
                    <div class="p-6">
                        <a href="{{ route('blog.show', $post) }}">
                            <h3 class="text-white text-lg font-bold mb-4 line-clamp-2 group-hover:text-green-500 transition-colors">
                                {{ $post->title }}
                            </h3>
                        </a>
                        
                        @if($post->excerpt)
                        <p class="text-gray-400 text-sm line-clamp-2 mb-6 opacity-80">{{ $post->excerpt }}</p>
                        @endif
                        
                        <!-- Footer -->
                        <div class="border-t border-gray-800 pt-4 flex items-center text-xs text-gray-500 font-mono">
                            <span class="text-green-500 font-bold">Admin</span>
                            <span class="mx-2">•</span>
                            <span>{{ $post->published_at ? $post->published_at->format('d M, Y') : $post->created_at->format('d M, Y') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 text-gray-500 border border-gray-800 rounded-3xl bg-[#141824]">
                    No blog posts found.
                </div>
            @endforelse
        </div>
        </div>
</section>
