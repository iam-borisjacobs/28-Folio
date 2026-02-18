@extends('active_theme::layouts.theme_layout')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <!-- Removed .container to allow hero-grid to match header width -->
        <div class="hero-grid">
            <div class="hero-content">
                <div class="hero-pre-title font-mono text-pink">
                    <span class="code-tag">&lt;span&gt;</span><span
                        class="text-main">{{ setting('hero_subtitle', "Hey, I'm James") }}</span><span
                        class="code-tag">&lt;/span&gt;</span>
                </div>
                <h1 class="h1">
                    {!! setting(
                        'hero_title',
                        'Senior <span class="hero-brackets">{</span><span class="hero-highlight">Full Stack</span><span class="hero-brackets">}</span><br>Web & App <br>developer<span class="cursor">_</span>',
                    ) !!}
                </h1>
                <p class="hero-description">
                    <span class="code-tag">&lt;p&gt;</span>
                    {!! setting(
                        'hero_description',
                        'With expertise in cutting-edge technologies such as <span class="text-pink">NodeJS</span>, <span class="text-pink">React</span>, <span class="text-pink">Angular</span>, and <span class="text-pink">Laravel</span>... I deliver web solutions that are both innovative and robust.',
                    ) !!}
                    <span class="code-tag">&lt;/p&gt;</span>
                </p>

                <div class="hero-icons mb-8" style="margin-bottom: 2.5rem;">
                    <div class="icon-track">
                        <!-- First Row -->
                        <div class="icon-row">
                            <div class="tech-icon-img"><img src="{{ theme_asset('img/1.png') }}" alt="Tech 1"></div>
                            <div class="tech-icon-img"><img src="{{ theme_asset('img/2.png') }}" alt="Tech 2"></div>
                            <div class="tech-icon-img"><img src="{{ theme_asset('img/3.png') }}" alt="Tech 3"></div>
                            <div class="tech-icon-img"><img src="{{ theme_asset('img/4.png') }}" alt="Tech 4"></div>
                            <div class="tech-icon-img"><img src="{{ theme_asset('img/5.png') }}" alt="Tech 5"></div>
                        </div>
                        <!-- Second Row (Duplicate for Loop) -->
                        <div class="icon-row">
                            <div class="tech-icon-img"><img src="{{ theme_asset('img/1.png') }}" alt="Tech 1"></div>
                            <div class="tech-icon-img"><img src="{{ theme_asset('img/2.png') }}" alt="Tech 2"></div>
                            <div class="tech-icon-img"><img src="{{ theme_asset('img/3.png') }}" alt="Tech 3"></div>
                            <div class="tech-icon-img"><img src="{{ theme_asset('img/4.png') }}" alt="Tech 4"></div>
                            <div class="tech-icon-img"><img src="{{ theme_asset('img/5.png') }}" alt="Tech 5"></div>
                        </div>
                    </div>
                </div>

                <div class="hero-actions">
                    <a href="{{ theme_asset('cv.pdf') }}" class="btn text-green font-mono"
                        style="padding-left: 0; background: transparent; border: none; box-shadow: none;">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="margin-right: 0.5rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download My CV
                    </a>
                </div>
            </div>

            <div class="hero-image">
                <div class="profile-hex">
                    @if (setting('hero_image'))
                        <img src="{{ Storage::url(setting('hero_image')) }}" alt="Profile">
                    @else
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?fit=crop&w=800&q=80"
                            alt="Profile Placeholder">
                    @endif

                    <!-- Floating Badge -->
                    <div
                        style="position: absolute; bottom: -20px; left: 50%; transform: translateX(-50%); background: #a855f7; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #fff; box-shadow: 0 0 20px rgba(168, 85, 247, 0.5);">
                        &lt;/&gt;
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services / About -->
    <section class="section" id="services">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">What I do</h2>
                <p class="section-subtitle">I help ambitious companies and people build digital products.</p>
            </div>

            <div class="grid grid-cols-3 gap-8"
                style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                <div class="service-card">
                    <div class="service-icon">💻</div>
                    <h3>Web Development</h3>
                    <p class="text-muted">High-performance websites using Laravel, Vue, and React.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">📱</div>
                    <h3>Mobile Apps</h3>
                    <p class="text-muted">Cross-platform mobile applications using React Native.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🎨</div>
                    <h3>UI/UX Design</h3>
                    <p class="text-muted">Designing intuitive and beautiful user interfaces.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Projects -->
    <section class="section" id="portfolio">
        <div class="container">
            <div class="flex justify-between items-center section-header">
                <div>
                    <h2 class="section-title">Featured Projects</h2>
                    <p class="section-subtitle">check out some of my latest work.</p>
                </div>
                <a href="{{ route('projects.index') }}" class="btn btn-primary">View All &rarr;</a>
            </div>

            <div class="grid grid-cols-2 gap-8" style="gap: 2rem;">
                @forelse($projects->take(4) as $project)
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

    <!-- Resume -->
    <section class="section" id="resume">
        <div class="container">
            <div class="grid grid-cols-2 gap-8" style="gap: 4rem;">
                <div>
                    <h2 class="h2 mb-8" style="margin-bottom: 2rem;">Education</h2>
                    <div class="timeline">
                        <div class="timeline-item">
                            <span class="timeline-marker"></span>
                            <span class="timeline-date">2018 - 2022</span>
                            <h4 class="timeline-title">B.S. Computer Science</h4>
                            <p class="timeline-org">University of Technology</p>
                            <p class="timeline-desc">Specialized in Software Engineering.</p>
                        </div>
                        <div class="timeline-item">
                            <span class="timeline-marker"></span>
                            <span class="timeline-date">2016 - 2018</span>
                            <h4 class="timeline-title">High School Degree</h4>
                            <p class="timeline-org">City High School</p>
                        </div>
                    </div>
                </div>
                <div>
                    <h2 class="h2 mb-8" style="margin-bottom: 2rem;">Experience</h2>
                    <div class="timeline">
                        <div class="timeline-item">
                            <span class="timeline-marker"></span>
                            <span class="timeline-date">2022 - Present</span>
                            <h4 class="timeline-title">Senior Developer</h4>
                            <p class="timeline-org">Tech Solutions Inc.</p>
                            <p class="timeline-desc">Leading a team of developers.</p>
                        </div>
                        <div class="timeline-item">
                            <span class="timeline-marker"></span>
                            <span class="timeline-date">2020 - 2022</span>
                            <h4 class="timeline-title">Junior Developer</h4>
                            <p class="timeline-org">Web Agency</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA -->
    <section class="section" id="contact">
        <div class="container">
            <div class="cta-box">
                <h2 class="h1">Have a project in mind?</h2>
                <p class="section-subtitle" style="margin: 1rem auto 2.5rem; max-width: 600px;">
                    I am available for freelance work. Connect with me via email or phone.
                </p>
                <a href="{{ route('contact') }}" class="btn"
                    style="background: var(--accent-primary); color: white; padding: 1rem 2rem;">Contact Me</a>
            </div>
        </div>
    </section>
@endsection
