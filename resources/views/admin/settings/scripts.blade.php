@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full px-6">
        
        <!-- Header -->
        <div class="flex flex-col mb-8">
            <h1 class="text-5xl font-bold text-white mb-4">Global Scripts</h1>
             <nav class="flex text-gray-400 text-lg">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <span class="mx-3">&rsaquo;</span>
                <a href="{{ route('admin.settings.index') }}" class="hover:text-white transition-colors">Settings</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Scripts</span>
            </nav>
        </div>

        <div class="bg-[#1e293b] rounded-lg shadow-xl overflow-hidden border border-gray-700">
            
            <div class="p-8">
                <div class="mb-8 bg-yellow-900/30 border-l-4 border-yellow-500 p-6 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-base text-yellow-200">
                                Warning: Scripts injected here are rendered globally. Be careful with what you add, as it can break the site or introduce security vulnerabilities.
                            </p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.settings.scripts') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-8">
                        <!-- Head Scripts -->
                        <div>
                            <label for="scripts_head" class="block text-lg font-medium text-gray-300 mb-3">Head Scripts</label>
                            <p class="text-base text-gray-500 mb-3">Injected before <code>&lt;/head&gt;</code>. Ideal for Google Analytics, verification tags.</p>
                            <textarea name="scripts_head" id="scripts_head" rows="6" 
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 font-mono shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm px-5 py-4">{{ old('scripts_head', $settings['scripts_head'] ?? '') }}</textarea>
                        </div>

                        <!-- Body Start Scripts -->
                        <div>
                            <label for="scripts_body_start" class="block text-lg font-medium text-gray-300 mb-3">Body Start Scripts</label>
                            <p class="text-base text-gray-500 mb-3">Injected after <code>&lt;body&gt;</code>. Ideal for GTM (noscript).</p>
                            <textarea name="scripts_body_start" id="scripts_body_start" rows="4" 
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 font-mono shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm px-5 py-4">{{ old('scripts_body_start', $settings['scripts_body_start'] ?? '') }}</textarea>
                        </div>

                        <!-- Body End Scripts -->
                        <div>
                            <label for="scripts_body_end" class="block text-lg font-medium text-gray-300 mb-3">Body End Scripts</label>
                            <p class="text-base text-gray-500 mb-3">Injected before <code>&lt;/body&gt;</code>. Ideal for chat widgets, performance scripts.</p>
                            <textarea name="scripts_body_end" id="scripts_body_end" rows="6" 
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 font-mono shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm px-5 py-4">{{ old('scripts_body_end', $settings['scripts_body_end'] ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="pt-8 border-t border-gray-700 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-8 py-4 bg-indigo-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Save Scripts
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
