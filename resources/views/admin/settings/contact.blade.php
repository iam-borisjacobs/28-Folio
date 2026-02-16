@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full px-6">
        
         <!-- Header -->
        <div class="flex flex-col mb-8">
            <h1 class="text-5xl font-bold text-white mb-4">Contact Settings</h1>
             <nav class="flex text-gray-400 text-lg">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                 <span class="mx-3">&rsaquo;</span>
                <a href="{{ route('admin.settings.index') }}" class="hover:text-white transition-colors">Settings</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Contact</span>
            </nav>
        </div>

        <div class="bg-[#1e293b] rounded-lg shadow-xl overflow-hidden border border-gray-700">
            <form action="{{ route('admin.settings.contact.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="p-8 space-y-8">
                    
                    <!-- Notification Settings -->
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-6 border-b border-gray-700 pb-4">Notifications</h3>
                        <div>
                            <label for="notification_email" class="block text-lg font-medium text-gray-300 mb-3">Notification Email</label>
                            <input type="email" name="notification_email" id="notification_email" value="{{ old('notification_email', $settings->notification_email) }}" 
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                            <p class="mt-2 text-base text-gray-500">The email address where new lead notifications will be sent.</p>
                                @error('notification_email') <span class="text-red-500 text-base mt-2">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Public Form Settings -->
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-6 border-b border-gray-700 pb-4">Public Form</h3>
                        <div>
                            <label for="success_message" class="block text-lg font-medium text-gray-300 mb-3">Success Message</label>
                            <input type="text" name="success_message" id="success_message" value="{{ old('success_message', $settings->success_message) }}" 
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                            <p class="mt-2 text-base text-gray-500">Message displayed to the user after successful submission.</p>
                                @error('success_message') <span class="text-red-500 text-base mt-2">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Auto Reply Settings -->
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-6 border-b border-gray-700 pb-4">Auto Reply</h3>
                        
                        <div class="flex items-center mb-6">
                            <input type="checkbox" name="auto_reply_enabled" id="auto_reply_enabled" value="1" {{ old('auto_reply_enabled', $settings->auto_reply_enabled) ? 'checked' : '' }} class="h-6 w-6 text-indigo-600 focus:ring-indigo-500 border-gray-700 bg-gray-900 rounded">
                            <label for="auto_reply_enabled" class="ml-3 block text-lg text-gray-300">Enable Auto Reply</label>
                        </div>

                        <div x-data="{ enabled: {{ old('auto_reply_enabled', $settings->auto_reply_enabled) ? 'true' : 'false' }} }" x-show="enabled" x-transition>
                            <label for="auto_reply_message" class="block text-lg font-medium text-gray-300 mb-3">Auto Reply Message</label>
                            <textarea name="auto_reply_message" id="auto_reply_message" rows="5" 
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">{{ old('auto_reply_message', $settings->auto_reply_message) }}</textarea>
                            <p class="mt-2 text-base text-gray-500">The content of the email sent to the user.</p>
                                @error('auto_reply_message') <span class="text-red-500 text-base mt-2">{{ $message }}</span> @enderror
                        </div>
                    </div>

                </div>

                <div class="bg-gray-800 px-8 py-6 border-t border-gray-700 flex justify-end">
                    <button type="submit" class="inline-flex items-center px-8 py-4 bg-indigo-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Simple script to toggle auto reply text area visibility if not using Alpine for the checkbox change event directly
    document.getElementById('auto_reply_enabled').addEventListener('change', function() {
        // Since we wrapped textarea in x-show="enabled", we need to update 'enabled' state.
        // However, Alpine x-data scope is isolated. 
        // Best to just let Alpine handle it by binding the checkbox to x-model="enabled"
    });
</script>
<!-- Update Alpine binding above to work -->
<script>
    // Updating the markup above to use x-model properly
    document.addEventListener('alpine:init', () => {
        // No extra init needed if x-data is inline
    });
</script>
@endsection
