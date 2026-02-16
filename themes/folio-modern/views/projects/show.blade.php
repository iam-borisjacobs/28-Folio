@extends('active_theme::layouts.app')

@section('content')
<section class="section" style="padding-top: 120px;">
    <div class="container">
        <!-- Project Header -->
        <div style="margin-bottom: 40px;">
            <div style="margin-bottom: 20px; font-weight: 600; color: var(--primary); text-transform: uppercase;">
                {{ $project->categories->first()->name ?? 'Portfolio' }}
            </div>
            <h1 style="font-size: 3.5rem; line-height: 1.1; margin-bottom: 30px;">{{ $project->title }}</h1>
            
            @if($project->featured_image)
                <div style="border-radius: var(--radius-lg); overflow: hidden; margin-bottom: 40px; border: 1px solid var(--border-color);">
                    <img src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->title }}" style="width: 100%;">
                </div>
            @endif
        </div>

        <div class="grid" style="grid-template-columns: 2fr 1fr; gap: 60px;">
            <!-- Main Content -->
            <div class="project-body" style="font-size: 1.1rem; color: #ccc;">
                {!! Str::markdown($project->description) !!}
                
                @if($project->gallery_images)
                    <h3 style="margin-top: 40px; margin-bottom: 20px; font-size: 1.8rem; color: white;">Gallery</h3>
                    <div class="grid grid-2" style="gap: 20px;">
                        @foreach($project->gallery_images as $image)
                            <div style="border-radius: var(--radius-md); overflow: hidden;">
                                <img src="{{ Storage::url($image) }}" alt="Gallery Image">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div>
                <div style="background: var(--bg-card); padding: 30px; border-radius: var(--radius-lg); border: 1px solid var(--border-color);">
                    <h3 style="margin-bottom: 20px; font-size: 1.2rem;">Project Details</h3>
                    
                    <div style="margin-bottom: 20px;">
                        <span style="display: block; font-size: 0.9rem; color: var(--text-muted); margin-bottom: 5px;">Client</span>
                        <span style="font-weight: 600;">{{ $project->client ?? 'Confidential' }}</span>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <span style="display: block; font-size: 0.9rem; color: var(--text-muted); margin-bottom: 5px;">Technologies</span>
                        <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                            @foreach($project->tags as $tag)
                                <span style="background: rgba(255,255,255,0.1); padding: 4px 10px; border-radius: 4px; font-size: 0.8rem;">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>

                    @if($project->project_url)
                        <a href="{{ $project->project_url }}" target="_blank" class="btn" style="width: 100%; margin-top: 10px;">Visit Live Site</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
