@extends('active_theme::layouts.theme_layout')

@section('content')
<section class="section" style="padding-top: 120px;">
    <div class="container">
        <!-- Project Header -->
        <div class="mb-8" style="margin-bottom: 3rem;">
            <div class="text-accent font-mono mb-4" style="text-transform: uppercase; letter-spacing: 1px;">
                {{ $project->categories->first()->name ?? 'Portfolio' }}
            </div>
            <h1 class="h1 mb-8">{{ $project->title }}</h1>
            
            @if($project->featured_image)
                <div style="border-radius: var(--border-radius); overflow: hidden; margin-bottom: 3rem; border: 1px solid rgba(255,255,255,0.1);">
                    <img src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->title }}" style="width: 100%;">
                </div>
            @endif
        </div>

        <div class="grid grid-cols-3 gap-8" style="grid-template-columns: 2fr 1fr; gap: 4rem;">
            <!-- Main Content -->
            <div class="project-body">
                <div class="prose text-muted" style="font-size: 1.1rem; line-height: 1.8;">
                    {!! Str::markdown($project->description) !!}
                </div>
                
                @if($project->gallery_images)
                    <h3 class="h2 mt-12 mb-6" style="margin-top: 4rem;">Gallery</h3>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($project->gallery_images as $image)
                            <div style="border-radius: var(--border-radius); overflow: hidden; border: 1px solid rgba(255,255,255,0.1);">
                                <img src="{{ Storage::url($image) }}" alt="Gallery Image" style="transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside>
                <div class="card">
                    <h3 class="h3 mb-6">Project Details</h3>
                    
                    <div class="mb-6">
                        <span class="block text-muted text-sm mb-1 font-mono">Client</span>
                        <span class="font-bold text-lg">{{ $project->client ?? 'Confidential' }}</span>
                    </div>

                    <div class="mb-6">
                        <span class="block text-muted text-sm mb-2 font-mono">Technologies</span>
                        <div class="flex flex-wrap gap-2">
                            @foreach($project->tags as $tag)
                                <span style="background: rgba(255,255,255,0.05); padding: 4px 10px; border-radius: 4px; font-size: 0.85rem; border: 1px solid rgba(255,255,255,0.05);">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>

                    @if($project->project_url)
                        <a href="{{ $project->project_url }}" target="_blank" class="btn btn-primary w-100" style="width: 100%; justify-content: center;">
                            Visit Live Site &rarr;
                        </a>
                    @endif
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection
