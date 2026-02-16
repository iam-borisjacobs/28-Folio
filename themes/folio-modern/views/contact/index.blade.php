@extends('active_theme::layouts.app')

@section('content')
<section class="section" style="padding-top: 120px;">
    <div class="container">
        <div class="grid grid-2" style="gap: 60px; align-items: start;">
            <div>
                <h1 style="font-size: 3.5rem; margin-bottom: 20px;">Get in Touch</h1>
                <p style="font-size: 1.2rem; color: var(--text-muted); margin-bottom: 40px;">
                    Have a project in mind or just want to say hi? I'd love to hear from you.
                </p>

                <div style="margin-bottom: 40px;">
                    <div style="margin-bottom: 20px; display: flex; align-items: center; gap: 15px;">
                        <div style="width: 40px; height: 40px; background: var(--bg-card); display: flex; align-items: center; justify-content: center; border-radius: 50%; color: var(--primary);">
                            ✉️
                        </div>
                        <div>
                            <span style="display: block; font-size: 0.9rem; color: var(--text-muted);">Email</span>
                            <strong>{{ setting('contact_email', 'hello@example.com') }}</strong>
                        </div>
                    </div>
                    <!-- Add more contact info here if needed -->
                </div>
            </div>

            <div style="background: var(--bg-card); padding: 40px; border-radius: var(--radius-lg); border: 1px solid var(--border-color);">
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name" style="display: block; margin-bottom: 8px; font-weight: 500;">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email" style="display: block; margin-bottom: 8px; font-weight: 500;">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="message" style="display: block; margin-bottom: 8px; font-weight: 500;">Message</label>
                        <textarea name="message" id="message" rows="5" class="form-control" required></textarea>
                    </div>
                    
                    <!-- Honeypot -->
                    <div style="display:none;">
                        <input type="text" name="honeypot" value="">
                    </div>

                    <button type="submit" class="btn" style="width: 100%;">Send Message</button>
                    
                    @if(session('success'))
                        <div style="margin-top: 20px; padding: 15px; background: rgba(0, 255, 0, 0.1); color: #4ade80; border-radius: var(--radius-md); text-align: center;">
                            {{ session('success') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
