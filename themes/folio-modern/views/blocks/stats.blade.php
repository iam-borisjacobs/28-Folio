<section class="stats-section">
    <div class="stats-grid">
        @if (isset($blockData['stat_items']) && count($blockData['stat_items']) > 0)
            @foreach ($blockData['stat_items'] as $index => $stat)
                <div class="stat-item">
                    <div class="stat-icon">
                        @if (isset($stat['icon_svg']) && !empty($stat['icon_svg']))
                            @if(str_starts_with(trim($stat['icon_svg']), '<svg'))
                                {!! $stat['icon_svg'] !!}
                            @else
                                <img src="{{ Storage::url($stat['icon_svg']) }}" alt="Stat Icon" style="width: 22px; height: 22px; object-fit: contain; filter: invert(1); opacity: 0.8;" />
                            @endif
                        @else
                            <!-- Fallback icon -->
                            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17l-6.2 4.3 2.4-7.4L2 9.4h7.6z" />
                            </svg>
                        @endif
                    </div>
                    <div class="stat-number">{{ $stat['number'] ?? '0' }}<span
                            class="stat-plus">{{ $stat['symbol'] ?? '+' }}</span></div>
                    <div class="stat-label">{{ $stat['label_prefix'] ?? '' }} <span
                            class="stat-highlight">{{ $stat['label_highlight'] ?? '' }}</span></div>
                </div>

                @if (!$loop->last)
                    <div class="stat-divider"></div>
                @endif
            @endforeach
        @endif
    </div>
</section>
