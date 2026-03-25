<section class="hero-section">
    <div class="hero-grid">
        <div class="hero-content">
            <div class="hero-pre-title font-mono text-pink flex items-center justify-start gap-2"
                style="{{ !empty($blockData['pre_title_color']) ? 'color: ' . $blockData['pre_title_color'] . ';' : '' }}">
                <span class="code-tag">&lt;span&gt;</span>{{ $blockData['pre_title'] ?? "Hey, I'm James" }}<span
                    class="code-tag">&lt;/span&gt;</span>
            </div>
            @php
                // Clean the title from rich text tags and decode html entities (like &nbsp;)
                $title = $blockData['title'] ?? 'Digital Experiences';
                $cleanTitle = html_entity_decode(strip_tags($title), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $highlight = $blockData['highlight_text'] ?? '';

                if (!empty($highlight) && str_contains($cleanTitle, $highlight)) {
                    $highlightColor = $blockData['highlight_color'] ?? 'var(--accent-green)';
                    $cleanTitle = str_replace(
                        $highlight,
                        '<span class="hero-highlight" style="color: ' .
                            $highlightColor .
                            ' !important; -webkit-text-fill-color: ' .
                            $highlightColor .
                            ' !important;">' .
                            $highlight .
                            '</span>',
                        $cleanTitle,
                    );
                }

                // Use the cleaned and modified title
                $title = $cleanTitle;
            @endphp
            @php
                $cursorColor = $blockData['title_cursor_color'] ?? 'var(--accent-primary)';
            @endphp
            <h1 class="h1 font-mono">
                {!! $title !!}<span class="cursor"
                    style="animation-duration: 2.5s !important; color: {{ $cursorColor }};">_</span>
            </h1>
            <p class="hero-description">
                <span class="code-tag">&lt;p&gt;</span>{!! $blockData['description'] ?? 'Short Biography Here.' !!}<span class="cursor"
                    style="animation-duration: 2.7s !important;">|</span><span class="code-tag">&lt;/p&gt;</span>

            </p>

            @if (isset($blockData['tech_stack']) && count($blockData['tech_stack']) > 0)
                <div class="hero-icons mb-8" style="margin-bottom: 2.5rem;">
                    <div class="icon-track">
                        <!-- First Row -->
                        <div class="icon-row">
                            @foreach ($blockData['tech_stack'] as $tech)
                                @php
                                    $icon = $tech['icon_url'] ?? '';
                                    $iconSrc = str_starts_with($icon, 'http')
                                        ? $icon
                                        : (str_starts_with($icon, 'tech-icons/')
                                            ? Storage::url($icon)
                                            : theme_asset('img/' . $icon));
                                @endphp
                                <div class="tech-icon-img"><img src="{{ $iconSrc }}" alt="Tech Icon"></div>
                            @endforeach
                        </div>
                        <!-- Second Row (Duplicate for Loop) -->
                        <div class="icon-row">
                            @foreach ($blockData['tech_stack'] as $tech)
                                @php
                                    $icon = $tech['icon_url'] ?? '';
                                    $iconSrc = str_starts_with($icon, 'http')
                                        ? $icon
                                        : (str_starts_with($icon, 'tech-icons/')
                                            ? Storage::url($icon)
                                            : theme_asset('img/' . $icon));
                                @endphp
                                <div class="tech-icon-img"><img src="{{ $iconSrc }}" alt="Tech Icon"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            @php
                $btnStyle = '';
                if (!empty($blockData['button_text_color'])) {
                    $btnStyle .= 'color: ' . $blockData['button_text_color'] . ' !important; ';
                }
                if (!empty($blockData['button_bg_color'])) {
                    $btnStyle .=
                        'background-color: ' .
                        $blockData['button_bg_color'] .
                        ' !important; border-color: ' .
                        $blockData['button_bg_color'] .
                        ' !important;';
                }
            @endphp
            <div class="hero-actions">
                <a href="{{ $blockData['button_link'] ?? '#' }}" class="btn btn-cv font-mono"
                    style="{{ $btnStyle }}">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        style="margin-right: 0.5rem;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    {{ $blockData['button_text'] ?? 'Download CV' }}
                </a>
            </div>
        </div>

        <div class="hero-image">
            <div class="profile-hex">
                @if (isset($blockData['profile_image']))
                    <img src="{{ Storage::url($blockData['profile_image']) }}" alt="Profile">
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
