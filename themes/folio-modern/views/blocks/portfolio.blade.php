@php
    $limit = $blockData['limit'] ?? 4;
    $projects = \App\Models\Project::where('status', 'published')
        ->with(['translations', 'categories', 'tags'])
        ->orderBy('is_featured', 'desc')
        ->latest('published_at')
        ->take($limit)
        ->get();
@endphp
<section class="section" id="portfolio">
    <div class="container">
        <div class="flex justify-between items-center section-header">
            <div>
                <h2 class="section-title">{{ $blockData['title'] ?? 'Featured Projects' }}</h2>
                <p class="section-subtitle">{{ $blockData['subtitle'] ?? 'check out some of my latest work.' }}</p>
            </div>
            @if (isset($blockData['button_text']) && !empty($blockData['button_text']))
                <a href="{{ $blockData['button_link'] ?? route('projects.index') }}"
                    class="btn btn-primary">{!! $blockData['button_text'] !!}</a>
            @endif
        </div>

        <div class="grid grid-cols-2 gap-8" style="gap: 2rem;">
            @forelse($projects as $project)
                <div class="project-card">
                    <div class="project-image">
                        <a href="{{ route('projects.show', $project) }}">
                            @if ($project->featured_image)
                                <img src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->title }}">
                            @else
                                <div
                                    style="width:100%; height:100%; background: #232323; display: flex; align-items: center; justify-content: center; color: #555;">
                                    No Image</div>
                            @endif
                        </a>
                    </div>
                    <div class="project-content">
                        <div class="project-meta">
                            {{ $project->categories->first()->name ?? 'Development' }}
                        </div>
                        <a href="{{ route('projects.show', $project) }}">
                            <h3 class="project-title">{{ $project->title }}</h3>
                        </a>
                        <p class="project-excerpt">{{ Str::limit($project->description, 100) }}</p>
                    </div>
                </div>
            @empty
                <div class="text-muted">No projects found. Add some in the admin panel!</div>
            @endforelse
        </div>
    </div>
</section>
