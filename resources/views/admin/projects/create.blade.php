@extends('admin.layouts.app')

@section('content')
<div class="py-6" x-data="{ tab: 'content' }">
    <div class="w-full px-6">
        
        <!-- Header & Breadcrumbs -->
        <div class="flex flex-col mb-8">
            <h1 class="text-5xl font-bold text-white mb-4">Create Project</h1>
            <nav class="flex text-gray-400 text-lg">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <span class="mx-3">&rsaquo;</span>
                <a href="{{ route('admin.projects.index') }}" class="hover:text-white transition-colors">Projects</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Create Project</span>
            </nav>
        </div>

        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Tabs & Form Container -->
            <div class="bg-[#1e293b] rounded-lg shadow-xl overflow-hidden border border-gray-700">
                
                <!-- Main Tabs -->
                <div class="border-b border-gray-700 px-6">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button type="button" @click="tab = 'content'" :class="{ 'border-indigo-500 text-indigo-400': tab === 'content', 'border-transparent text-gray-400 hover:text-gray-300 hover:border-gray-600': tab !== 'content' }" class="whitespace-nowrap py-5 px-1 border-b-2 font-medium text-lg transition-colors duration-200">
                            Content
                        </button>
                        <button type="button" @click="tab = 'media'" :class="{ 'border-indigo-500 text-indigo-400': tab === 'media', 'border-transparent text-gray-400 hover:text-gray-300 hover:border-gray-600': tab !== 'media' }" class="whitespace-nowrap py-5 px-1 border-b-2 font-medium text-lg transition-colors duration-200">
                            Media
                        </button>
                        <button type="button" @click="tab = 'organization'" :class="{ 'border-indigo-500 text-indigo-400': tab === 'organization', 'border-transparent text-gray-400 hover:text-gray-300 hover:border-gray-600': tab !== 'organization' }" class="whitespace-nowrap py-5 px-1 border-b-2 font-medium text-lg transition-colors duration-200">
                            Organization
                        </button>
                        <button type="button" @click="tab = 'seo'" :class="{ 'border-indigo-500 text-indigo-400': tab === 'seo', 'border-transparent text-gray-400 hover:text-gray-300 hover:border-gray-600': tab !== 'seo' }" class="whitespace-nowrap py-5 px-1 border-b-2 font-medium text-lg transition-colors duration-200">
                            SEO
                        </button>
                        <button type="button" @click="tab = 'settings'" :class="{ 'border-indigo-500 text-indigo-400': tab === 'settings', 'border-transparent text-gray-400 hover:text-gray-300 hover:border-gray-600': tab !== 'settings' }" class="whitespace-nowrap py-5 px-1 border-b-2 font-medium text-lg transition-colors duration-200">
                            Settings
                        </button>
                    </nav>
                </div>

                <!-- Content -->
                <div class="p-8">
                    
                    <!-- Content Tab -->
                    <div x-show="tab === 'content'" class="space-y-8" x-data="{ currentLang: '{{ $languages->first()->code ?? 'en' }}' }">
                        
                        <!-- Language Tabs -->
                        <div class="border-b border-gray-700 mb-6">
                            <nav class="-mb-px flex space-x-4" aria-label="Language Tabs">
                                @foreach($languages as $language)
                                    <button type="button" @click="currentLang = '{{ $language->code }}'" 
                                        :class="{ 'border-indigo-500 text-indigo-400': currentLang === '{{ $language->code }}', 'border-transparent text-gray-400 hover:text-gray-300 hover:border-gray-600': currentLang !== '{{ $language->code }}' }" 
                                        class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-base transition-colors duration-200 flex items-center">
                                        {{ $language->name }}
                                        @if($language->is_default)
                                            <span class="ml-2 text-xs bg-gray-700 text-gray-300 px-2 py-0.5 rounded-full">Default</span>
                                        @endif
                                    </button>
                                @endforeach
                            </nav>
                        </div>

                        @foreach($languages as $language)
                            <div x-show="currentLang === '{{ $language->code }}'" style="display: none;">
                                <!-- Title -->
                                <div class="mb-6">
                                    <label for="title_{{ $language->code }}" class="block text-lg font-medium text-gray-300 mb-3">Title ({{ $language->name }})</label>
                                    <input type="text" id="title_{{ $language->code }}" name="translations[{{ $language->code }}][title]" value="{{ old('translations.'.$language->code.'.title') }}" 
                                        class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                                        placeholder="Enter the project title..."
                                        @if($language->is_default) required autofocus @endif>
                                    <x-input-error :messages="$errors->get('translations.'.$language->code.'.title')" class="mt-2 text-base" />
                                </div>

                                <!-- Slug -->
                                <div class="mb-6">
                                    <label for="slug_{{ $language->code }}" class="block text-lg font-medium text-gray-300 mb-3">
                                        Slug ({{ $language->name }}) <span class="text-gray-500 font-normal ml-1">(Auto-generated if empty)</span>
                                    </label>
                                    <input type="text" id="slug_{{ $language->code }}" name="translations[{{ $language->code }}][slug]" value="{{ old('translations.'.$language->code.'.slug') }}"
                                        class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                                        placeholder="/project-title">
                                    <x-input-error :messages="$errors->get('translations.'.$language->code.'.slug')" class="mt-2 text-base" />
                                </div>

                                <!-- Short Description -->
                                <div class="mb-6">
                                    <label for="short_description_{{ $language->code }}" class="block text-lg font-medium text-gray-300 mb-3">Short Description ({{ $language->name }})</label>
                                    <textarea id="short_description_{{ $language->code }}" name="translations[{{ $language->code }}][description]" rows="3"
                                        class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                                        placeholder="Write a short description...">{{ old('translations.'.$language->code.'.description') }}</textarea>
                                    <x-input-error :messages="$errors->get('translations.'.$language->code.'.description')" class="mt-2 text-base" />
                                </div>

                                <!-- Full Description (Visual RTE) -->
                                <div>
                                    <label for="full_description_{{ $language->code }}" class="block text-lg font-medium text-gray-300 mb-3">Full Description ({{ $language->name }})</label>
                                    <div class="rounded-md border border-gray-700 bg-gray-900 overflow-hidden">
                                        <!-- Fake Toolbar -->
                                        <div class="flex items-center space-x-2 px-4 py-3 border-b border-gray-700 bg-gray-800/50">
                                            <button type="button" onclick="insertMarkdown('bold', '{{ $language->code }}')" class="p-2 text-gray-400 hover:text-white hover:bg-gray-700 rounded"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h8a4 4 0 014 4 2 2 0 01-2 2H6zM6 8a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H6z" /></svg></button>
                                            <button type="button" onclick="insertMarkdown('code', '{{ $language->code }}')" class="p-2 text-gray-400 hover:text-white hover:bg-gray-700 rounded"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" /></svg></button>
                                            <span class="w-px h-5 bg-gray-700 mx-2"></span>
                                            <button type="button" onclick="insertMarkdown('link', '{{ $language->code }}')" class="p-2 text-gray-400 hover:text-white hover:bg-gray-700 rounded"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg></button>
                                            <button type="button" onclick="insertMarkdown('list', '{{ $language->code }}')" class="p-2 text-gray-400 hover:text-white hover:bg-gray-700 rounded"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg></button>
                                        </div>
                                        <textarea id="full_description_{{ $language->code }}" name="translations[{{ $language->code }}][content]" rows="10"
                                            class="block w-full border-0 bg-transparent text-gray-300 focus:ring-0 text-lg px-5 py-4"
                                            placeholder="Write the full description...">{{ old('translations.'.$language->code.'.content') }}</textarea>
                                    </div>
                                    <x-input-error :messages="$errors->get('translations.'.$language->code.'.content')" class="mt-2 text-base" />
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Media Tab -->
                    <div x-show="tab === 'media'" class="space-y-8" style="display: none;">
                        <div class="bg-gray-900 rounded-lg p-8 border border-gray-700 border-dashed text-center">
                            <div class="text-gray-400 mb-4 text-lg">Featured Image</div>
                            <input id="featured_image" type="file" name="featured_image" accept="image/*" class="block w-full text-base text-gray-400 file:mr-4 file:py-3 file:px-6 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
                            <p class="mt-3 text-sm text-gray-500">JPG, PNG, WEBP up to 5MB</p>
                        </div>

                        <div class="bg-gray-900 rounded-lg p-8 border border-gray-700 border-dashed text-center">
                            <div class="text-gray-400 mb-4 text-lg">Gallery Images</div>
                            <input id="gallery_images" type="file" name="gallery_images[]" multiple accept="image/*" class="block w-full text-base text-gray-400 file:mr-4 file:py-3 file:px-6 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
                             <p class="mt-3 text-sm text-gray-500">Upload multiple images for the project gallery</p>
                        </div>
                    </div>

                    <!-- Organization Tab -->
                    <div x-show="tab === 'organization'" class="space-y-8" style="display: none;">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <label class="block text-lg font-medium text-gray-300">Categories</label>
                                <a href="{{ route('admin.projects.categories.index') }}" class="text-indigo-400 hover:text-indigo-300 text-sm font-medium hover:underline">+ Manage Categories</a>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                 @forelse($categories as $category)
                                    <label class="inline-flex items-center p-4 rounded bg-gray-900 border border-gray-700 cursor-pointer hover:border-indigo-500 transition-colors">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="rounded border-gray-700 bg-gray-800 text-indigo-600 shadow-sm focus:ring-indigo-500 h-5 w-5" {{ is_array(old('categories')) && in_array($category->id, old('categories')) ? 'checked' : '' }}>
                                        <span class="ml-3 text-base text-gray-300">{{ $category->name }}</span>
                                    </label>
                                 @empty
                                    <div class="col-span-3 text-gray-500 italic text-base p-4 border border-gray-700 border-dashed rounded-lg bg-gray-800/50">
                                        No categories found. Please create one first.
                                    </div>
                                 @endforelse
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <label class="block text-lg font-medium text-gray-300">Tags</label>
                                <a href="{{ route('admin.projects.tags.index') }}" class="text-indigo-400 hover:text-indigo-300 text-sm font-medium hover:underline">+ Manage Tags</a>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                 @forelse($tags as $tag)
                                    <label class="inline-flex items-center p-4 rounded bg-gray-900 border border-gray-700 cursor-pointer hover:border-indigo-500 transition-colors">
                                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="rounded border-gray-700 bg-gray-800 text-indigo-600 shadow-sm focus:ring-indigo-500 h-5 w-5" {{ is_array(old('tags')) && in_array($tag->id, old('tags')) ? 'checked' : '' }}>
                                        <span class="ml-3 text-base text-gray-300">{{ $tag->name }}</span>
                                    </label>
                                 @empty
                                    <div class="col-span-3 text-gray-500 italic text-base p-4 border border-gray-700 border-dashed rounded-lg bg-gray-800/50">
                                        No tags found. Please create one first.
                                    </div>
                                 @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- SEO Tab -->
                    <div x-show="tab === 'seo'" class="space-y-8" style="display: none;" x-data="{ currentLangSeo: '{{ $languages->first()->code ?? 'en' }}' }">
                         <!-- Language Tabs -->
                         <div class="border-b border-gray-700 mb-6">
                            <nav class="-mb-px flex space-x-4" aria-label="SEO Language Tabs">
                                @foreach($languages as $language)
                                    <button type="button" @click="currentLangSeo = '{{ $language->code }}'" 
                                        :class="{ 'border-indigo-500 text-indigo-400': currentLangSeo === '{{ $language->code }}', 'border-transparent text-gray-400 hover:text-gray-300 hover:border-gray-600': currentLangSeo !== '{{ $language->code }}' }" 
                                        class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-base transition-colors duration-200 flex items-center">
                                        {{ $language->name }}
                                    </button>
                                @endforeach
                            </nav>
                        </div>
                        
                        @foreach($languages as $language)
                            <div x-show="currentLangSeo === '{{ $language->code }}'" style="display: none;">
                                <div>
                                    <label for="seo_title_{{ $language->code }}" class="block text-lg font-medium text-gray-300 mb-3">Meta Title ({{ $language->name }})</label>
                                    <input type="text" id="seo_title_{{ $language->code }}" name="translations[{{ $language->code }}][seo_meta][title]" value="{{ old('translations.'.$language->code.'.seo_meta.title') }}"
                                        class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                                </div>

                                <div class="mt-6">
                                    <label for="seo_description_{{ $language->code }}" class="block text-lg font-medium text-gray-300 mb-3">Meta Description ({{ $language->name }})</label>
                                    <textarea id="seo_description_{{ $language->code }}" name="translations[{{ $language->code }}][seo_meta][description]" rows="3"
                                        class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">{{ old('translations.'.$language->code.'.seo_meta.description') }}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Settings Tab -->
                    <div x-show="tab === 'settings'" class="space-y-8" style="display: none;">
                         <!-- Project URL -->
                         <div>
                            <label for="project_url" class="block text-lg font-medium text-gray-300 mb-3">Project URL</label>
                            <input type="url" id="project_url" name="project_url" value="{{ old('project_url') }}"
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                                placeholder="https://example.com">
                            <x-input-error :messages="$errors->get('project_url')" class="mt-2 text-base" />
                        </div>

                        <!-- Status & Feature -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-end">
                            <div>
                                <label for="status" class="block text-lg font-medium text-gray-300 mb-3">Status</label>
                                <select id="status" name="status"
                                    class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                                </select>
                            </div>

                            <div class="flex items-center pb-4">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_featured" value="1" class="rounded border-gray-700 bg-gray-900 text-indigo-600 shadow-sm focus:ring-indigo-500 h-6 w-6" {{ old('is_featured') ? 'checked' : '' }}>
                                    <span class="ml-3 text-lg text-gray-400">Feature this project</span>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Footer / Actions -->
                <div class="bg-gray-800 px-8 py-6 border-t border-gray-700 flex justify-end">
                     <button type="submit" class="inline-flex items-center px-8 py-4 bg-indigo-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Save Project') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let savedRange = null;
    let currentEditorLanguage = null;

    function insertMarkdown(type, lang) {
        currentEditorLanguage = lang;
        const textarea = document.getElementById('full_description_' + lang);
        if (!textarea) return;

        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const text = textarea.value;
        const selectedText = text.substring(start, end);
        
        let replacement = '';
        
        switch (type) {
            case 'bold':
                replacement = `**${selectedText || 'bold text'}**`;
                break;
            case 'code':
                replacement = `\`${selectedText || 'code'}\``;
                break;
            case 'link':
                // Open Modal
                savedRange = { start, end, selectedText };
                window.dispatchEvent(new CustomEvent('open-modal', { detail: 'markdown-link-modal' }));
                
                // Reset input
                const linkInput = document.getElementById('link-url');
                if (linkInput) {
                    linkInput.value = 'https://';
                    setTimeout(() => {
                        linkInput.focus();
                        linkInput.select();
                    }, 100);
                }
                return; // Stop here, wait for modal
            case 'list':
                replacement = `\n- ${selectedText || 'item'}`;
                break;
        }
        
        insertText(replacement, start, end, textarea);
    }

    function insertText(text, start, end, textarea) {
        const originalText = textarea.value;
        
        textarea.value = originalText.substring(0, start) + text + originalText.substring(end);
        textarea.focus();
        textarea.setSelectionRange(start + text.length, start + text.length);
    }

    function confirmLinkInsertion() {
        const url = document.getElementById('link-url').value;
        if (!savedRange || !currentEditorLanguage) return;
        
        const textarea = document.getElementById('full_description_' + currentEditorLanguage);
        if (!textarea) return;

        const replacement = `[${savedRange.selectedText || 'link text'}](${url})`;
        insertText(replacement, savedRange.start, savedRange.end, textarea);
        
        window.dispatchEvent(new CustomEvent('close-modal', { detail: 'markdown-link-modal' }));
        savedRange = null;
        currentEditorLanguage = null;
    }
</script>
@endpush

<!-- Link Insertion Modal -->
<x-admin.modal name="markdown-link-modal" focusable>
    <div class="p-6">
        <h2 class="text-xl font-bold text-gray-100 mb-4">Insert Link</h2>
        
        <div>
            <label for="link-url" class="block text-sm font-medium text-gray-400 mb-2">URL</label>
            <input type="text" id="link-url" class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-4 py-3" placeholder="https://example.com"
            keydown.enter.prevent="confirmLinkInsertion()">
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-md font-semibold transition-colors">
                Cancel
            </button>
            <button type="button" onclick="confirmLinkInsertion()" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md font-semibold transition-colors">
                Insert Link
            </button>
        </div>
    </div>
</x-admin.modal>
