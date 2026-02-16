@extends('themes.active.layouts.app')

@section('content')
<div class="bg-[#1e293b] min-h-screen py-12 flex flex-col items-center justify-center">
    <div class="w-full max-w-4xl px-6">
        <div class="mx-auto text-center mb-12">
            <h2 class="text-5xl font-bold tracking-tight text-white mb-4">Contact Us</h2>
            <p class="text-xl leading-8 text-gray-400">We'd love to hear from you. Please fill out the form below.</p>
        </div>
        
        <div class="bg-gray-900/50 rounded-xl shadow-2xl overflow-hidden border border-gray-700 p-8 sm:p-12" x-data="contactForm()">
            <form @submit.prevent="submitForm">
                <div class="grid grid-cols-1 gap-x-8 gap-y-8 sm:grid-cols-2">
                    <!-- Honeypot -->
                    <div class="hidden">
                        <label>Don't fill this out if you're human: <input name="website_url" x-model="formData.website_url" /></label>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="name" class="block text-lg font-medium text-gray-300 mb-2">Name</label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name" x-model="formData.name" autocomplete="name" 
                                class="block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                                placeholder="Your Name">
                            <p x-show="errors.name" x-text="errors.name" class="mt-2 text-base text-red-500"></p>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="email" class="block text-lg font-medium text-gray-300 mb-2">Email</label>
                        <div class="mt-1">
                            <input type="email" name="email" id="email" x-model="formData.email" autocomplete="email" 
                                class="block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                                placeholder="you@example.com">
                            <p x-show="errors.email" x-text="errors.email" class="mt-2 text-base text-red-500"></p>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="subject" class="block text-lg font-medium text-gray-300 mb-2">Subject</label>
                        <div class="mt-1">
                            <input type="text" name="subject" id="subject" x-model="formData.subject" 
                                class="block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                                placeholder="What is this regarding?">
                            <p x-show="errors.subject" x-text="errors.subject" class="mt-2 text-base text-red-500"></p>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="block text-lg font-medium text-gray-300 mb-2">Message</label>
                        <div class="mt-1">
                            <textarea name="message" id="message" x-model="formData.message" rows="6" 
                                class="block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                                placeholder="Write your message here..."></textarea>
                            <p x-show="errors.message" x-text="errors.message" class="mt-2 text-base text-red-500"></p>
                        </div>
                    </div>
                </div>
                <div class="mt-12 flex justify-end">
                    <button type="submit" :disabled="loading" 
                        class="inline-flex items-center px-8 py-4 bg-indigo-600 border border-transparent rounded-md font-bold text-lg text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all disabled:opacity-50 disabled:cursor-not-allowed w-full sm:w-auto justify-center">
                        <span x-show="!loading">Send Message</span>
                        <span x-show="loading" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Sending...
                        </span>
                    </button>
                    
                </div>
                <!-- Notifications -->
                <div x-show="successMessage" x-transition class="mt-8 p-4 bg-green-900/50 border border-green-500 rounded-lg text-green-200 text-center text-lg">
                    <p x-text="successMessage"></p>
                </div>
                <div x-show="errorMessage" x-transition class="mt-8 p-4 bg-red-900/50 border border-red-500 rounded-lg text-red-200 text-center text-lg">
                    <p x-text="errorMessage"></p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function contactForm() {
        return {
            formData: {
                name: '',
                email: '',
                subject: '',
                message: '',
                website_url: '' // Honeypot
            },
            errors: {},
            loading: false,
            successMessage: '',
            errorMessage: '',

            async submitForm() {
                this.loading = true;
                this.errors = {};
                this.successMessage = '';
                this.errorMessage = '';

                try {
                    const response = await axios.post('{{ route("contact.send") }}', this.formData);
                    this.successMessage = response.data.message;
                    this.formData = { name: '', email: '', subject: '', message: '', website_url: '' };
                } catch (error) {
                    if (error.response && error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else if (error.response && error.response.status === 429) {
                        this.errorMessage = 'Too many requests. Please try again later.';
                    } else {
                        this.errorMessage = 'An error occurred. Please try again.';
                    }
                } finally {
                    this.loading = false;
                }
            }
        }
    }
</script>
@endsection
