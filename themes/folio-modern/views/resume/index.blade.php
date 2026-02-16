@extends('active_theme::layouts.app')

@section('content')
<section class="section" style="padding-top: 120px;">
    <div class="container">
        <div class="grid" style="grid-template-columns: 1fr 2fr; gap: 60px;">
            <!-- Sidebar -->
            <div style="position: sticky; top: 120px; align-self: start;">
                 <h1 style="font-size: 3rem; margin-bottom: 20px; line-height: 1;">Resume</h1>
                 <p style="color: var(--text-muted); margin-bottom: 40px;">
                     A comprehensive look at my professional experience, education, and skills.
                 </p>
                 
                 <a href="#" class="btn btn-outline" style="width: 100%; margin-bottom: 20px;">Download PDF</a>
                 
                 <div style="margin-top: 40px;">
                     <h3 style="font-size: 1.2rem; margin-bottom: 15px;">Connect</h3>
                     <ul style="list-style: none; padding: 0;">
                         <li style="margin-bottom: 10px;"><a href="#" style="color: var(--text-muted); hover:var(--primary);">LinkedIn</a></li>
                         <li style="margin-bottom: 10px;"><a href="#" style="color: var(--text-muted); hover:var(--primary);">GitHub</a></li>
                         <li style="margin-bottom: 10px;"><a href="#" style="color: var(--text-muted); hover:var(--primary);">Twitter</a></li>
                     </ul>
                 </div>
            </div>

            <!-- Content -->
            <div>
                <!-- Experience -->
                <div style="margin-bottom: 60px;">
                    <h2 style="font-size: 2rem; margin-bottom: 30px; padding-bottom: 10px; border-bottom: 1px solid var(--border-color);">Experience</h2>
                    
                    <div class="timeline">
                        <!-- Placeholder items, in real app loop through $experiences -->
                        <div class="timeline-item">
                            <span class="timeline-marker"></span>
                            <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 5px;">
                                <h4 class="timeline-title" style="margin: 0;">Senior Full Stack Developer</h4>
                                <span class="timeline-date" style="font-size: 0.85rem;">2022 - Present</span>
                            </div>
                            <p class="timeline-org" style="color: var(--primary); margin-bottom: 10px;">Tech Solutions Inc.</p>
                            <p class="timeline-desc">
                                Spearheaded the migration of legacy systems to modern microservices architecture.
                                Mentored junior developers and introduced automated testing pipelines.
                            </p>
                        </div>

                        <div class="timeline-item">
                            <span class="timeline-marker"></span>
                            <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 5px;">
                                <h4 class="timeline-title" style="margin: 0;">Web Developer</h4>
                                <span class="timeline-date" style="font-size: 0.85rem;">2019 - 2022</span>
                            </div>
                            <p class="timeline-org" style="color: var(--primary); margin-bottom: 10px;">Creative Agency</p>
                            <p class="timeline-desc">
                                Developed award-winning websites for high-profile clients. worked closely with designers to ensure pixel-perfect implementation.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Education -->
                <div style="margin-bottom: 60px;">
                    <h2 style="font-size: 2rem; margin-bottom: 30px; padding-bottom: 10px; border-bottom: 1px solid var(--border-color);">Education</h2>
                    
                    <div class="timeline">
                        <div class="timeline-item">
                            <span class="timeline-marker"></span>
                            <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 5px;">
                                <h4 class="timeline-title" style="margin: 0;">BS Computer Science</h4>
                                <span class="timeline-date" style="font-size: 0.85rem;">2015 - 2019</span>
                            </div>
                            <p class="timeline-org" style="color: var(--primary); margin-bottom: 10px;">University of Technology</p>
                        </div>
                    </div>
                </div>

                <!-- Skills -->
                <div>
                     <h2 style="font-size: 2rem; margin-bottom: 30px; padding-bottom: 10px; border-bottom: 1px solid var(--border-color);">Skills</h2>
                     
                     <div style="margin-bottom: 30px;">
                         <h4 style="margin-bottom: 15px;">Frontend</h4>
                         <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                             <span style="background: var(--bg-card); padding: 8px 16px; border-radius: var(--radius-md); border: 1px solid var(--border-color);">Vue.js</span>
                             <span style="background: var(--bg-card); padding: 8px 16px; border-radius: var(--radius-md); border: 1px solid var(--border-color);">Tailwind CSS</span>
                             <span style="background: var(--bg-card); padding: 8px 16px; border-radius: var(--radius-md); border: 1px solid var(--border-color);">JavaScript (ES6+)</span>
                             <span style="background: var(--bg-card); padding: 8px 16px; border-radius: var(--radius-md); border: 1px solid var(--border-color);">HTML5/CSS3</span>
                         </div>
                     </div>

                     <div style="margin-bottom: 30px;">
                         <h4 style="margin-bottom: 15px;">Backend</h4>
                         <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                             <span style="background: var(--bg-card); padding: 8px 16px; border-radius: var(--radius-md); border: 1px solid var(--border-color);">Laravel</span>
                             <span style="background: var(--bg-card); padding: 8px 16px; border-radius: var(--radius-md); border: 1px solid var(--border-color);">PHP 8</span>
                             <span style="background: var(--bg-card); padding: 8px 16px; border-radius: var(--radius-md); border: 1px solid var(--border-color);">MySQL</span>
                             <span style="background: var(--bg-card); padding: 8px 16px; border-radius: var(--radius-md); border: 1px solid var(--border-color);">Redis</span>
                         </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
