@extends('active_theme::layouts.theme_layout')

@section('content')

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-grid">
            <div class="hero-content">
                <h3>Hello, I am</h3>
                <h1>{{ setting('site_name', 'Your Name') }} <br>
                    <span class="highlight">{{ setting('hero_title_suffix', 'Developer') }}</span>
                </h1>
                <p class="hero-subtitle">
                    {{ setting('site_description', 'I build exceptional digital experiences that are fast, accessible, and visually stunning.') }}
                </p>
                
                <div class="hero-actions">
                    <a href="#projects" class="btn">View My Work</a>
                    <a href="#contact" class="btn btn-outline" style="margin-left: 15px;">Contact Me</a>
                </div>

                <div class="hero-stats">
                    <div class="stat-item">
                        <h3>{{ $years_experience ?? '5+' }}</h3>
                        <p>Years Experience</p>
                    </div>
                    <div class="stat-item">
                        <h3>{{ $completed_projects ?? '50+' }}</h3>
                        <p>Projects Done</p>
                    </div>
                </div>
            </div>
            
            <div class="hero-image">
                <div class="profile-hex">
                    @if(setting('profile_image'))
                         <img src="{{ Storage::url(setting('profile_image')) }}" alt="Profile">
                    @else
                        <!-- Placeholder -->
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(setting('site_name')) }}&background=10101a&color=ff3c3c&size=512" alt="Profile">
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About / Services -->
<section class="section" id="about">
    <div class="container">
        <div class="section-header" style="margin-bottom: 50px;">
            <h2 style="font-size: 2.5rem; margin-bottom: 10px;">What I Do</h2>
            <p class="text-muted" style="color: var(--text-muted); max-width: 600px;">
                Designing solutions customized to meet your requirements.
            </p>
        </div>

        <div class="grid grid-3">
             <!-- Services would ideally come from a database, using placeholders for now -->
             <div class="service-card">
                <div class="service-icon">💻</div>
                <h3>Web Development</h3>
                <p>Building fast, responsive, and secure websites using modern technologies.</p>
             </div>
             <div class="service-card">
                <div class="service-icon">📱</div>
                <h3>App Development</h3>
                <p>Creating seamless mobile experiences for iOS and Android platforms.</p>
             </div>
             <div class="service-card">
                <div class="service-icon">🎨</div>
                <h3>UI/UX Design</h3>
                <p>Crafting intuitive and beautiful interfaces that users love.</p>
             </div>
        </div>
    </div>
</section>

<!-- Recent Projects -->
<section class="section" id="projects">
    <div class="container">
        <div class="section-header" style="margin-bottom: 50px; display: flex; justify-content: space-between; align-items: end;">
            <div>
                <h2 style="font-size: 2.5rem; margin-bottom: 10px;">Recent Works</h2>
                <p class="text-muted" style="color: var(--text-muted);">
                    A selection of my latest successful projects.
                </p>
            </div>
            <a href="{{ route('projects.index') }}" class="btn btn-outline">View All Projects</a>
        </div>

        <div class="grid grid-2">
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
                    <a href="{{ route('projects.show', $project) }}" style="margin-top: auto; color: var(--primary); font-weight: 600;">View Details &rarr;</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Resume / Skills -->
<section class="section" style="background: var(--bg-card);">
    <div class="container">
        <div class="grid grid-2" style="gap: 80px;">
            <div>
                <h2 style="font-size: 2.5rem; margin-bottom: 40px;">Education</h2>
                <div class="timeline">
                    <!-- Placeholder Data if empty -->
                    <div class="timeline-item">
                        <span class="timeline-marker"></span>
                        <span class="timeline-date">2018 - 2022</span>
                        <h4 class="timeline-title">B.S. Computer Science</h4>
                        <p class="timeline-org">University of Technology</p>
                        <p class="timeline-desc">Specialized in Software Engineering and Artificial Intelligence.</p>
                    </div>
                </div>
            </div>
            <div>
                <h2 style="font-size: 2.5rem; margin-bottom: 40px;">Experience</h2>
                <div class="timeline">
                     <!-- Placeholder Data if empty -->
                    <div class="timeline-item">
                        <span class="timeline-marker"></span>
                        <span class="timeline-date">2022 - Present</span>
                        <h4 class="timeline-title">Senior Developer</h4>
                        <p class="timeline-org">Tech Solutions Inc.</p>
                        <p class="timeline-desc">Leading a team of developers in building scalable web applications.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA -->
<section class="section" id="contact">
    <div class="container">
        <div style="background: var(--bg-card); padding: 60px; border-radius: 20px; border: 1px solid var(--border-color); text-align: center;">
            <h2 style="font-size: 3rem; margin-bottom: 20px;">Let's work together!</h2>
            <p style="font-size: 1.2rem; color: var(--text-muted); margin-bottom: 40px; max-width: 600px; margin-left: auto; margin-right: auto;">
                I'm currently available for freelance projects. Have a project in mind? Let's discuss it.
            </p>
            <a href="{{ route('contact') }}" class="btn">Get In Touch</a>
        </div>
    </div>
</section>

@endsection
