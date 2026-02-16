@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full px-6">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div class="flex flex-col">
                <h1 class="text-5xl font-bold text-white mb-4">Languages</h1>
                <nav class="flex text-gray-400 text-lg">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                    <span class="mx-3">&rsaquo;</span>
                    <span class="text-gray-500">Settings</span>
                    <span class="mx-3">&rsaquo;</span>
                    <span class="text-gray-500">Languages</span>
                </nav>
            </div>
            <a href="{{ route('admin.settings.languages.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-bold transition-colors">
                Add Language
            </a>
        </div>

        <!-- Languages List -->
        <div class="bg-[#1e293b] rounded-lg shadow-xl overflow-hidden border border-gray-700">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-800 border-b border-gray-700 text-gray-400 uppercase text-sm">
                        <th class="px-8 py-4 font-semibold">Name</th>
                        <th class="px-8 py-4 font-semibold">Code</th>
                        <th class="px-8 py-4 font-semibold">Default</th>
                        <th class="px-8 py-4 font-semibold">Status</th>
                        <th class="px-8 py-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700 text-gray-300">
                    @foreach($languages as $language)
                        <tr class="hover:bg-gray-700/50 transition-colors">
                            <td class="px-8 py-4 font-medium text-white">{{ $language->name }}</td>
                            <td class="px-8 py-4">{{ $language->code }}</td>
                            <td class="px-8 py-4">
                                @if($language->is_default)
                                    <span class="px-3 py-1 bg-green-900/50 text-green-400 rounded-full text-xs font-bold border border-green-700 uppercase tracking-widest">Default</span>
                                @endif
                            </td>
                            <td class="px-8 py-4">
                                @if($language->is_active)
                                    <span class="px-3 py-1 bg-blue-900/50 text-blue-400 rounded-full text-xs font-bold border border-blue-700 uppercase tracking-widest">Active</span>
                                @else
                                    <span class="px-3 py-1 bg-gray-700 text-gray-400 rounded-full text-xs font-bold border border-gray-600 uppercase tracking-widest">Inactive</span>
                                @endif
                            </td>
                            <td class="px-8 py-4 text-right">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('admin.settings.languages.edit', $language) }}" class="text-indigo-400 hover:text-white transition-colors">Edit</a>
                                    
                                    @if(!$language->is_default)
                                        <form action="{{ route('admin.settings.languages.destroy', $language) }}" method="POST" onsubmit="return confirm('Are you sure? This will delete all translations associated with this language.');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 transition-colors ml-3">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    
                    @if($languages->isEmpty())
                        <tr>
                            <td colspan="5" class="px-8 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" /></svg>
                                    <p class="text-lg font-medium">No languages found.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
