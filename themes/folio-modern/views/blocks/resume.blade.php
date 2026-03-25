<section class="section" id="resume">
    <div class="container">
        <div class="grid grid-cols-2 gap-8"
            style="gap: 4rem; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
            <div>
                <h2 class="h2 mb-8" style="margin-bottom: 2rem;">{{ $blockData['education_title'] ?? 'Education' }}</h2>
                <div class="timeline">
                    @if (isset($blockData['education']) && count($blockData['education']) > 0)
                        @foreach ($blockData['education'] as $edu)
                            <div class="timeline-item">
                                <span class="timeline-marker"></span>
                                <span class="timeline-date">{{ $edu['date'] ?? '' }}</span>
                                <h4 class="timeline-title">{{ $edu['degree'] ?? '' }}</h4>
                                <p class="timeline-org">{{ $edu['organization'] ?? '' }}</p>
                                @if (isset($edu['description']) && !empty($edu['description']))
                                    <p class="timeline-desc">{{ $edu['description'] }}</p>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div>
                <h2 class="h2 mb-8" style="margin-bottom: 2rem;">{{ $blockData['experience_title'] ?? 'Experience' }}
                </h2>
                <div class="timeline">
                    @if (isset($blockData['experience']) && count($blockData['experience']) > 0)
                        @foreach ($blockData['experience'] as $exp)
                            <div class="timeline-item">
                                <span class="timeline-marker"></span>
                                <span class="timeline-date">{{ $exp['date'] ?? '' }}</span>
                                <h4 class="timeline-title">{{ $exp['role'] ?? '' }}</h4>
                                <p class="timeline-org">{{ $exp['company'] ?? '' }}</p>
                                @if (isset($exp['description']) && !empty($exp['description']))
                                    <p class="timeline-desc">{{ $exp['description'] }}</p>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
