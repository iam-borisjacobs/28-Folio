@extends('active_theme::layouts.theme_layout')

@section('content')
<section class="section" style="padding-top: 120px;">
    <div class="container">
        <div class="grid grid-cols-3 gap-8" style="grid-template-columns: 1fr 2fr; gap: 4rem;">
            <!-- Sidebar -->
            <aside style="position: sticky; top: 120px; align-self: start;">
                 <h1 class="h1 mb-6">Resume</h1>
                 <p class="text-muted mb-8 text-lg">
                     A comprehensive look at my professional experience, education, and skills.
                 </p>
                 
                 <a href="{{ theme_asset('cv.pdf') }}" class="btn btn-primary w-100 mb-8" style="width: 100%; justify-content: center;">
                    Download PDF
                 </a>
                 
                 <div class="card bg-card p-6">
                     <h3 class="h3 mb-4">Connect</h3>
                     <ul class="flex flex-col gap-2">
                         <li><a href="#" class="text-muted hover:text-accent transition-colors flex items-center gap-2"><div class="service-icon" style="font-size: 1rem; margin-bottom: 0;">LinkedIn</div> LinkedIn</a></li>
                         <li><a href="#" class="text-muted hover:text-accent transition-colors flex items-center gap-2"><div class="service-icon" style="font-size: 1rem; margin-bottom: 0;">GitHub</div> GitHub</a></li>
                         <li><a href="#" class="text-muted hover:text-accent transition-colors flex items-center gap-2"><div class="service-icon" style="font-size: 1rem; margin-bottom: 0;">Twitter</div> Twitter</a></li>
                     </ul>
                 </div>
            </aside>

            <!-- Content -->
            <div>
                <!-- Experience -->
                <div class="mb-12">
                    <h2 class="h2 mb-8 pb-4" style="border-bottom: 1px solid rgba(255,255,255,0.1);">Experience</h2>
                    
                    <div class="timeline">
                        <!-- Placeholder items -->
                        <div class="timeline-item">
                            <span class="timeline-marker"></span>
                            <div class="flex justify-between items-baseline mb-1">
                                <h4 class="timeline-title">Senior Full Stack Developer</h4>
                                <span class="timeline-date">2022 - Present</span>
                            </div>
                            <p class="timeline-org mb-2">Tech Solutions Inc.</p>
                            <p class="timeline-desc">
                                Spearheaded the migration of legacy systems to modern microservices architecture.
                                Mentored junior developers and introduced automated testing pipelines.
                            </p>
                        </div>

                        <div class="timeline-item">
                            <span class="timeline-marker"></span>
                            <div class="flex justify-between items-baseline mb-1">
                                <h4 class="timeline-title">Web Developer</h4>
                                <span class="timeline-date">2019 - 2022</span>
                            </div>
                            <p class="timeline-org mb-2">Creative Agency</p>
                            <p class="timeline-desc">
                                Developed award-winning websites for high-profile clients. Worked closely with designers to ensure pixel-perfect implementation.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Education -->
                <div class="mb-12">
                    <h2 class="h2 mb-8 pb-4" style="border-bottom: 1px solid rgba(255,255,255,0.1);">Education</h2>
                    
                    <div class="timeline">
                        <div class="timeline-item">
                            <span class="timeline-marker"></span>
                            <div class="flex justify-between items-baseline mb-1">
                                <h4 class="timeline-title">BS Computer Science</h4>
                                <span class="timeline-date">2015 - 2019</span>
                            </div>
                            <p class="timeline-org mb-2">University of Technology</p>
                        </div>
                    </div>
                </div>

                <!-- Skills -->
                <div>
                     <h2 class="h2 mb-8 pb-4" style="border-bottom: 1px solid rgba(255,255,255,0.1);">Skills</h2>
                     
                     <div class="mb-8">
                         <h4 class="h3 mb-4">Frontend</h4>
                         <div class="flex flex-wrap gap-2">
                             <span class="px-4 py-2 bg-card rounded border border-white/5">Vue.js</span>
                             <span class="px-4 py-2 bg-card rounded border border-white/5">Tailwind CSS</span>
                             <span class="px-4 py-2 bg-card rounded border border-white/5">JavaScript (ES6+)</span>
                             <span class="px-4 py-2 bg-card rounded border border-white/5">HTML5/CSS3</span>
                         </div>
                     </div>

                     <div class="mb-8">
                         <h4 class="h3 mb-4">Backend</h4>
                         <div class="flex flex-wrap gap-2">
                             <span class="px-4 py-2 bg-card rounded border border-white/5">Laravel</span>
                             <span class="px-4 py-2 bg-card rounded border border-white/5">PHP 8</span>
                             <span class="px-4 py-2 bg-card rounded border border-white/5">MySQL</span>
                             <span class="px-4 py-2 bg-card rounded border border-white/5">Redis</span>
                         </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
