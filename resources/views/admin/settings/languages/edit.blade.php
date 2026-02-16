@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full px-6">
        
        <!-- Header -->
        <div class="flex flex-col mb-8">
            <h1 class="text-5xl font-bold text-white mb-4">Edit Language</h1>
            <nav class="flex text-gray-400 text-lg">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Settings</span>
                <span class="mx-3">&rsaquo;</span>
                <a href="{{ route('admin.settings.languages.index') }}" class="hover:text-white transition-colors">Languages</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Edit</span>
            </nav>
        </div>

        <div class="bg-[#1e293b] rounded-lg shadow-xl overflow-hidden border border-gray-700">
            <form action="{{ route('admin.settings.languages.update', $language) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="p-8 space-y-8">
                    <!-- Name -->
                    <div>
                        <label class="block text-lg font-medium text-gray-300 mb-3">Language Name</label>
                        <input type="text" name="name" value="{{ old('name', $language->name) }}" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="e.g. French" required>
                        @error('name')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Code -->
                    <div>
                        <label class="block text-lg font-medium text-gray-300 mb-3">Language Code (ISO 639-1)</label>
                        <input type="text" name="code" value="{{ old('code', $language->code) }}" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="e.g. fr" maxlength="2" required>
                        <p class="mt-2 text-base text-gray-500">Two-letter language code (e.g., en, fr, es).</p>
                        @error('code')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Sort Order -->
                    <div>
                        <label class="block text-lg font-medium text-gray-300 mb-3">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $language->sort_order) }}" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>

                    <!-- Flags -->
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $language->is_active) ? 'checked' : '' }} class="h-6 w-6 text-indigo-600 focus:ring-indigo-500 border-gray-700 rounded bg-gray-900" {{ $language->is_default ? 'disabled' : '' }}>
                            <label for="is_active" class="ml-3 block text-lg font-medium text-gray-300">Active</label>
                        </div>
                        @if($language->is_default)
                            <p class="text-sm text-yellow-500 ml-9">Default language cannot be disabled.</p>
                            <input type="hidden" name="is_active" value="1">
                        @endif
                        
                        <div class="flex items-center">
                            <input type="checkbox" id="is_default" name="is_default" value="1" {{ old('is_default', $language->is_default) ? 'checked' : '' }} class="h-6 w-6 text-indigo-600 focus:ring-indigo-500 border-gray-700 rounded bg-gray-900">
                            <label for="is_default" class="ml-3 block text-lg font-medium text-gray-300">Set as Default Language</label>
                        </div>
                        <p class="text-base text-gray-500 ml-9">Setting this as default will unset the current default language.</p>
                    </div>
                </div>

                <div class="bg-gray-800 px-8 py-6 border-t border-gray-700 flex justify-end gap-4">
                    <a href="{{ route('admin.settings.languages.index') }}" class="px-6 py-3 bg-gray-700 text-white rounded-lg font-bold hover:bg-gray-600 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="px-8 py-3 bg-indigo-600 border border-transparent rounded-lg font-bold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
