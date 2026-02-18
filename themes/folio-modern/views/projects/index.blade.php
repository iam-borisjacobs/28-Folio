@extends('active_theme::layouts.theme_layout')

@section('content')
<section class="section" style="padding-top: 120px;">
    <div class="container">
        <div class="section-header text-center">
            <h1 class="h1">My Projects</h1>
            <p class="section-subtitle mx-auto">
                Explore a collection of my recent work, showcasing my skills in web and app development.
            </p>
        </div>

        <div class="grid grid-cols-2 gap-8" style="gap: 2rem;">
            @foreach($projects as $project)
            <div class="project-card">
                <div class="project-image">
                    <a href="{{ route('projects.show', $project) }}">
                        @if($project->featured_image)
                            <img src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->title }}">
                        @else
                            <div style="width:100%; height:100%; background: #232323; display: flex; align-items: center; justify-content: center; color: #555;">No Image</div>
                        @endif
                    </a>
                </div>
                <div class="project-content">
                    <div class="project-meta">
                        {{ $project->categories->first()->name ?? 'Project' }}
                    </div>
                    <a href="{{ route('projects.show', $project) }}">
                        <h3 class="project-title">{{ $project->title }}</h3>
                    </a>
                    <p class="project-excerpt">{{ Str::limit($project->description, 100) }}</p>
                    <a href="{{ route('projects.show', $project) }}" style="margin-top: auto; color: var(--accent-primary); font-weight: 600;">View Details &rarr;</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8 flex justify-center">
            {{ $projects->links() }}
        </div>
    </div>
</section>
@endsection
