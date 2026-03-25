<section class="section" id="contact">
    <div class="container">
        <div class="cta-box"
            style="background: var(--glass-bg); border: 1px solid var(--glass-border); border-radius: 24px; padding: 4rem 2rem; text-align: center;">
            <h2 class="h1" style="color: var(--text-primary);">{{ $blockData['title'] ?? 'Have a project in mind?' }}
            </h2>
            <p class="section-subtitle" style="margin: 1rem auto 2.5rem; max-width: 600px;">
                {{ $blockData['subtitle'] ?? 'I am available for freelance work. Connect with me via email or phone.' }}
            </p>
            @if (isset($blockData['button_text']) && !empty($blockData['button_text']))
                <a href="{{ $blockData['button_link'] ?? route('contact') }}" class="btn"
                    style="background: var(--accent-primary); color: white; padding: 1rem 2.5rem; border-radius: 999px; font-weight: 600; border: none; display: inline-block;">{{ $blockData['button_text'] }}</a>
            @endif
        </div>
    </div>
</section>
