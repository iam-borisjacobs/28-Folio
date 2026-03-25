<section class="stats-section" id="services">
    <div class="services-card-wrapper">
        <div class="services-container stats-grid-style">
            <div class="services-header text-center">
                <div class="services-pre-title">
                    {{ $blockData['pre_title'] ?? '• Cooperation' }}
                </div>
                <h2 class="services-title">
                    {!! $blockData['title'] ?? 'Designing solutions <br><span>customized to meet your requirements</span>' !!}
                </h2>
            </div>

            <div class="services-grid">
                @if (isset($blockData['services']) && count($blockData['services']) > 0)
                    @foreach ($blockData['services'] as $service)
                        <div class="service-card-dark">
                            <div class="service-icon-dark">
                                @if (!empty($service['icon']))
                                    @if (str_starts_with(trim($service['icon']), '<svg'))
                                        {!! $service['icon'] !!}
                                    @else
                                        <img src="{{ Storage::url($service['icon']) }}" alt="Service Icon"
                                            class="w-10 h-10 object-contain block" />
                                    @endif
                                @endif
                            </div>
                            <h3 class="service-title-dark">{{ $service['title'] ?? 'Service' }}</h3>
                            <p class="service-desc-dark">{{ $service['description'] ?? 'Description' }}</p>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="services-footer text-left mt-16 text-gray-400">
                <div class="footer-rich-text">
                    {!! $blockData['footer_text'] ??
                        '<p>Excited to take on new projects and collaborate.</p><p><a href="#contact">Let\'s chat about your ideas. Reach out!</a></p>' !!}
                </div>
            </div>
        </div>
    </div>
</section>
