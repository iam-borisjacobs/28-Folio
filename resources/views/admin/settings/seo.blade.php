@extends('admin.layouts.app')

@section('content')
    <div class="py-6">
        <div class="w-full px-6">

            <!-- Header -->
            <div class="flex flex-col mb-8">
                <h1 class="text-5xl font-bold text-white mb-4">SEO Settings</h1>
                <nav class="flex text-gray-400 text-lg">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                    <span class="mx-3">&rsaquo;</span>
                    <a href="{{ route('admin.settings.index') }}" class="hover:text-white transition-colors">Settings</a>
                    <span class="mx-3">&rsaquo;</span>
                    <span class="text-gray-500">SEO</span>
                </nav>
            </div>

            <form action="{{ route('admin.settings.seo') }}" method="POST">
                @csrf

                <!-- Metadata -->
                <div class="bg-[#1e293b] rounded-lg shadow-xl overflow-hidden border border-gray-700 mb-8">
                    <div class="p-8 space-y-8">
                        <h3 class="text-2xl font-bold text-white mb-6 border-b border-gray-700 pb-4">Metadata Defaults</h3>

                        <div>
                            <label for="meta_title_format" class="block text-lg font-medium text-gray-300 mb-3">Meta Title
                                Format</label>
                            <input type="text" name="meta_title_format" id="meta_title_format"
                                value="{{ old('meta_title_format', $settings['meta_title_format'] ?? '%page% | %site%') }}"
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                            <p class="mt-2 text-base text-gray-500">Variables: <code>%page%</code>, <code>%site%</code>,
                                <code>%tagline%</code></p>
                        </div>

                        <div>
                            <label for="meta_description_default"
                                class="block text-lg font-medium text-gray-300 mb-3">Default Meta Description</label>
                            <textarea name="meta_description_default" id="meta_description_default" rows="3"
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">{{ old('meta_description_default', $settings['meta_description_default'] ?? '') }}</textarea>
                        </div>

                        <div class="flex items-center pt-4">
                            <input type="hidden" name="allow_indexing" value="0">
                            <input type="checkbox" name="allow_indexing" id="allow_indexing" value="1"
                                {{ ($settings['allow_indexing'] ?? '0') == '1' ? 'checked' : '' }}
                                class="h-6 w-6 text-indigo-600 focus:ring-indigo-500 border-gray-700 bg-gray-900 rounded">
                            <label for="allow_indexing" class="ml-3 block text-lg text-gray-300">
                                Allow Search Engines to Index Site
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="bg-[#1e293b] rounded-lg shadow-xl overflow-hidden border border-gray-700">
                    <div class="p-8 space-y-8">
                        <h3 class="text-2xl font-bold text-white mb-6 border-b border-gray-700 pb-4">Social Profiles</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="social_twitter" class="block text-lg font-medium text-gray-300 mb-3">Twitter
                                    Handle</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <span
                                        class="inline-flex items-center px-4 rounded-l-md border border-r-0 border-gray-700 bg-gray-800 text-gray-300 text-lg">@</span>
                                    <input type="text" name="social_twitter" id="social_twitter"
                                        value="{{ old('social_twitter', $settings['social_twitter'] ?? '') }}"
                                        class="flex-1 min-w-0 block w-full px-5 py-4 bg-gray-900 border-gray-700 rounded-none rounded-r-md text-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-lg">
                                </div>
                            </div>
                            <div>
                                <label for="social_instagram"
                                    class="block text-lg font-medium text-gray-300 mb-3">Instagram</label>
                                <input type="text" name="social_instagram" id="social_instagram"
                                    value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}"
                                    class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                            </div>
                            <div>
                                <label for="social_facebook" class="block text-lg font-medium text-gray-300 mb-3">Facebook
                                    URL</label>
                                <input type="text" name="social_facebook" id="social_facebook"
                                    value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}"
                                    class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                            </div>
                            <div>
                                <label for="social_youtube" class="block text-lg font-medium text-gray-300 mb-3">YouTube
                                    URL</label>
                                <input type="text" name="social_youtube" id="social_youtube"
                                    value="{{ old('social_youtube', $settings['social_youtube'] ?? '') }}"
                                    class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                            </div>
                            <div>
                                <label for="social_linkedin" class="block text-lg font-medium text-gray-300 mb-3">LinkedIn
                                    URL</label>
                                <input type="text" name="social_linkedin" id="social_linkedin"
                                    value="{{ old('social_linkedin', $settings['social_linkedin'] ?? '') }}"
                                    class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                            </div>
                            <div>
                                <label for="social_github" class="block text-lg font-medium text-gray-300 mb-3">GitHub
                                    URL</label>
                                <input type="text" name="social_github" id="social_github"
                                    value="{{ old('social_github', $settings['social_github'] ?? '') }}"
                                    class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-800 px-8 py-6 border-t border-gray-700 flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-8 py-4 bg-indigo-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Save SEO Settings
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
