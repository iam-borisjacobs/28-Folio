@extends('active_theme::layouts.theme_layout')

@section('content')
<section class="section" style="padding-top: 120px;">
    <div class="container">
        <div class="grid grid-cols-2 gap-8" style="grid-template-columns: 1fr 1fr; gap: 6rem;">
            <!-- Contact Info -->
            <div>
                <h1 class="h1 mb-6">Get in Touch</h1>
                <p class="text-muted mb-12 text-lg">
                    Have a project in mind or just want to say hi? I'm always open to discussing new projects, creative ideas or opportunities to be part of your visions.
                </p>

                <div class="contact-info">
                    <div class="contact-info-item">
                        <div class="contact-icon">📍</div>
                        <div>
                            <h4 class="h3" style="font-size: 1.2rem; margin-bottom: 0.5rem;">Location</h4>
                            <p class="text-muted">{{ setting('contact_address', 'San Francisco, CA') }}</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-icon">📧</div>
                        <div>
                            <h4 class="h3" style="font-size: 1.2rem; margin-bottom: 0.5rem;">Email</h4>
                            <a href="mailto:{{ setting('contact_email', 'hello@james.dev') }}" class="text-accent hover:underline">
                                {{ setting('contact_email', 'hello@james.dev') }}
                            </a>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-icon">📱</div>
                        <div>
                            <h4 class="h3" style="font-size: 1.2rem; margin-bottom: 0.5rem;">Phone</h4>
                            <p class="text-muted">{{ setting('contact_phone', '+1 (555) 123-4567') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div>
                <div class="card bg-card p-8">
                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        
                        @if(session('success'))
                            <div style="background: rgba(46, 213, 115, 0.2); color: #2ed573; padding: 1rem; border-radius: var(--border-radius); margin-bottom: 2rem; border: 1px solid #2ed573;">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="John Doe" required>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="john@example.com" required>
                        </div>

                        <div class="form-group">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Project Inquiry">
                        </div>

                        <div class="form-group">
                            <label for="message" class="form-label">Message</label>
                            <textarea id="message" name="message" class="form-control" placeholder="Tell me about your project..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100" style="width: 100%; justify-content: center;">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
