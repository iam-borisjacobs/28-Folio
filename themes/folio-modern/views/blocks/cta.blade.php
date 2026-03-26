<section class="w-full flex justify-center px-4 lg:px-0" id="contact">
        <div class="w-full relative overflow-hidden rounded-[20px] p-8 md:p-12 lg:p-16 h-full" 
             style="max-width: var(--container-width); margin: 1rem auto 0; background: var(--bg-card); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid var(--glass-border); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3); background-image: linear-gradient(var(--bg-card), var(--bg-card)), radial-gradient(circle, rgba(255, 255, 255, 0.03) 1px, transparent 1px); background-size: auto, 24px 24px;">
            <h2 class="text-3xl font-mono text-white mb-12 heading-glow">
                {!! str_replace('connect', '<span class="text-green-500">connect</span>', strtolower($blockData['title'] ?? 'Let\'s connect')) !!}
            </h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <!-- Left Form -->
            <div>
                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-gray-400 text-sm font-bold">Name <span class="text-green-500">*</span></label>
                            <input type="text" name="name" required class="w-full bg-[#141824] border border-gray-800 rounded-lg p-3.5 text-white focus:outline-none focus:border-green-500 transition-colors shadow-inner placeholder-gray-600" placeholder="Your Name">
                        </div>
                        <div class="space-y-2">
                            <label class="text-gray-400 text-sm font-bold">Email <span class="text-green-500">*</span></label>
                            <input type="email" name="email" required class="w-full bg-[#141824] border border-gray-800 rounded-lg p-3.5 text-white focus:outline-none focus:border-green-500 transition-colors shadow-inner placeholder-gray-600" placeholder="your@email.com">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-gray-400 text-sm font-bold">Phone</label>
                            <input type="tel" name="phone" class="w-full bg-[#141824] border border-gray-800 rounded-lg p-3.5 text-white focus:outline-none focus:border-green-500 transition-colors shadow-inner placeholder-gray-600" placeholder="+1 (234) 567-8900">
                        </div>
                        <div class="space-y-2">
                            <label class="text-gray-400 text-sm font-bold">Company / Subject</label>
                            <input type="text" name="subject" class="w-full bg-[#141824] border border-gray-800 rounded-lg p-3.5 text-white focus:outline-none focus:border-green-500 transition-colors shadow-inner placeholder-gray-600" placeholder="Subject">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-gray-400 text-sm font-bold">Message <span class="text-green-500">*</span></label>
                        <textarea name="message" rows="5" required class="w-full bg-[#141824] border border-gray-800 rounded-lg p-3.5 text-white focus:outline-none focus:border-green-500 transition-colors shadow-inner placeholder-gray-600 resize-y" placeholder="Your message here..."></textarea>
                    </div>

                    <div class="flex items-start gap-3">
                        <input type="checkbox" id="terms" required class="mt-1 w-4 h-4 bg-[#141824] border-gray-800 rounded text-green-500 focus:ring-green-500 focus:ring-opacity-25 focus:ring-offset-[#141824] cursor-pointer appearance-none border checked:bg-green-500 relative before:content-[''] before:absolute before:inset-0 before:flex before:items-center before:justify-center checked:before:content-['✓'] checked:before:text-white checked:before:text-xs">
                        <label for="terms" class="text-gray-500 text-sm cursor-pointer">I agree to the <a href="#" class="text-white hover:text-green-500 transition-colors underline decoration-gray-700">Terms</a> and <a href="#" class="text-white hover:text-green-500 transition-colors underline decoration-gray-700">Privacy Policy</a>.</label>
                    </div>

                    <button type="submit" class="bg-green-600 hover:bg-white hover:text-green-700 text-white font-bold py-3 px-8 rounded-lg shadow-[0_0_15px_rgba(34,197,94,0.4)] transition-all flex items-center gap-2 group">
                        Send Message 
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" class="transform group-hover:translate-x-1 transition-transform"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>
            </div>

            <!-- Right Info -->
            <div class="flex flex-col justify-center space-y-10 pl-0 lg:pl-12">
                @if(!empty($blockData['contact_info']))
                    @foreach($blockData['contact_info'] as $info)
                        <div class="flex items-start gap-4 group">
                            <div class="w-12 h-12 shrink-0 rounded-lg bg-[#141824] border border-gray-800 flex items-center justify-center text-green-500 shadow-md group-hover:scale-110 group-hover:border-green-500 transition-all">
                                @if(!empty($info['icon_svg']))
                                    @if(str_starts_with(trim($info['icon_svg']), '<svg'))
                                        <div class="w-5 h-5 flex items-center justify-center [&>svg]:w-full [&>svg]:h-full [&>svg]:fill-current [&>svg]:stroke-current">{!! $info['icon_svg'] !!}</div>
                                    @else
                                        <div class="w-5 h-5 flex items-center justify-center">
                                            <img src="{{ Storage::url($info['icon_svg']) }}" alt="Contact Icon" class="w-full h-full object-contain filter invert opacity-80 group-hover:opacity-100 transition-opacity" />
                                        </div>
                                    @endif
                                @else
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                                @endif
                            </div>
                            <div>
                                <h4 class="text-gray-500 text-sm font-bold uppercase tracking-wider mb-1">{{ $info['title'] ?? 'Contact' }}</h4>
                                <p class="text-white font-mono text-base md:text-lg group-hover:text-green-400 transition-colors">{{ $info['value'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-gray-500 text-sm border-l border-gray-800 pl-4 py-2">Add contact info details in the admin panel.</div>
                @endif
            </div>
        </div>
        </div>
</section>
