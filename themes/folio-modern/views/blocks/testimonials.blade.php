<section class="section" id="testimonials">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">{{ $blockData['title'] ?? 'Client Testimonials' }}</h2>
            <p class="section-subtitle">{{ $blockData['subtitle'] ?? 'What people are saying about my work.' }}</p>
        </div>

        <div class="grid grid-cols-2 gap-8"
            style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
            @if (isset($blockData['testimonials']) && count($blockData['testimonials']) > 0)
                @foreach ($blockData['testimonials'] as $testimonial)
                    <div class="testimonial-card"
                        style="background: var(--glass-bg); border: 1px solid var(--glass-border); border-radius: 20px; padding: 2rem;">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="var(--accent-primary)"
                            style="opacity: 0.5; margin-bottom: 1rem;">
                            <path
                                d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                        </svg>
                        <p class="text-muted" style="font-style: italic; margin-bottom: 1.5rem; line-height: 1.8;">
                            "{{ $testimonial['quote'] ?? '' }}"</p>
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div
                                style="width: 40px; height: 40px; border-radius: 50%; background: var(--bg-card); display: flex; align-items: center; justify-content: center; font-weight: bold; color: var(--text-primary); border: 1px solid var(--glass-border);">
                                {{ substr($testimonial['name'] ?? 'C', 0, 1) }}
                            </div>
                            <div>
                                <h4 style="margin: 0; font-size: 1rem; color: var(--text-primary);">
                                    {{ $testimonial['name'] ?? '' }}</h4>
                                <span class="text-muted"
                                    style="font-size: 0.875rem;">{{ $testimonial['role'] ?? '' }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
