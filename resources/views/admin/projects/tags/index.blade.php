@extends('admin.layouts.app')

@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full px-6">
        
        <!-- Header & Breadcrumbs -->
        <div class="flex flex-col mb-8">
            <h1 class="text-5xl font-bold text-white mb-4">Project Tags</h1>
            <nav class="flex text-gray-400 text-lg">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <span class="mx-3">&rsaquo;</span>
                <a href="{{ route('admin.projects.index') }}" class="hover:text-white transition-colors">Projects</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Tags</span>
            </nav>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Create Form -->
            <div class="lg:col-span-1">
                <div class="bg-[#1e293b] rounded-lg shadow-xl overflow-hidden border border-gray-700 sticky top-6">
                    <div class="p-8 border-b border-gray-700">
                        <h3 class="text-2xl font-bold text-white">Create New Tag</h3>
                    </div>
                    <form action="{{ route('admin.projects.tags.store') }}" method="POST" class="p-8 space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-lg font-medium text-gray-300 mb-3">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                                placeholder="e.g. Minimalist">
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-base" />
                        </div>

                        <div>
                            <label for="slug" class="block text-lg font-medium text-gray-300 mb-3">
                                Slug <span class="text-gray-500 font-normal ml-1">(Optional)</span>
                            </label>
                            <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                                placeholder="auto-generated">
                            <x-input-error :messages="$errors->get('slug')" class="mt-2 text-base" />
                        </div>

                        <button type="submit" class="w-full inline-flex justify-center items-center px-8 py-4 bg-indigo-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Create Tag') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- List -->
            <div class="lg:col-span-2">
                <div class="bg-[#1e293b] rounded-lg shadow-xl overflow-hidden border border-gray-700">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-900/50 border-b border-gray-700 text-gray-400">
                                    <th class="px-8 py-6 font-medium text-lg">Name</th>
                                    <th class="px-8 py-6 font-medium text-lg">Slug</th>
                                    <th class="px-8 py-6 font-medium text-lg text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @forelse($tags as $tag)
                                    <tr class="hover:bg-gray-800/50 transition-colors">
                                        <td class="px-8 py-6 text-white text-lg font-medium">{{ $tag->name }}</td>
                                        <td class="px-8 py-6 text-gray-400 text-lg">{{ $tag->slug }}</td>
                                        <td class="px-8 py-6 text-right">
                                            <div class="flex items-center justify-end space-x-6">
                                                <a href="{{ route('admin.projects.tags.edit', $tag) }}" class="text-indigo-400 hover:text-indigo-300 text-lg font-medium hover:underline">Edit</a>
                                                
                                                <form action="{{ route('admin.projects.tags.destroy', $tag) }}" method="POST" onsubmit="return confirm('Delete this tag?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-400 hover:text-red-300 text-lg font-medium hover:underline">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-8 py-12 text-center text-gray-500 text-xl">
                                            No tags found. Start by creating one.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-6 border-t border-gray-700">
                        {{ $tags->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
