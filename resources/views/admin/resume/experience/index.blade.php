@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full">
        
        <!-- Header & Breadcrumbs -->
        <div class="flex flex-col mb-8">
            <h1 class="text-5xl font-bold text-white mb-4">Experience</h1>
            <nav class="flex text-gray-400 text-lg">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Resume</span>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Experience</span>
            </nav>
        </div>

        <!-- Action Bar -->
        <div class="flex justify-end mb-8">
            <a href="{{ route('admin.resume.experience.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition-colors object-right">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Experience
            </a>
        </div>

        <!-- Content -->
        <div class="bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-700">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-900/50 border-b border-gray-700 text-gray-400 text-sm uppercase tracking-wider">
                            <th class="px-6 py-4 font-semibold">Role & Company</th>
                            <th class="px-6 py-4 font-semibold">Date Range</th>
                            <th class="px-6 py-4 font-semibold text-center">Current</th>
                            <th class="px-6 py-4 font-semibold text-right">Order</th>
                            <th class="px-6 py-4 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($experiences as $experience)
                            <tr class="hover:bg-gray-700/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="text-white font-bold text-lg">{{ $experience->job_title }}</div>
                                    <div class="text-gray-400">{{ $experience->company }}</div>
                                    @if($experience->location)
                                        <div class="text-gray-500 text-sm mt-1 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            {{ $experience->location }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-300 whitespace-nowrap">
                                    {{ $experience->start_date->format('M Y') }} — 
                                    @if($experience->is_current)
                                        <span class="text-indigo-400 font-medium">Present</span>
                                    @else
                                        {{ $experience->end_date ? $experience->end_date->format('M Y') : 'N/A' }}
                                    @endif
                                    <div class="text-xs text-gray-500 mt-1">
                                        @if($experience->is_current)
                                            {{ $experience->start_date->diffForHumans(null, true) }}
                                        @elseif($experience->end_date)
                                            {{ $experience->start_date->diffForHumans($experience->end_date, true) }}
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($experience->is_current)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100/10 text-green-400 border border-green-500/20">
                                            Current
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right text-gray-400 font-mono">
                                    {{ $experience->sort_order }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="{{ route('admin.resume.experience.edit', $experience) }}" class="text-indigo-400 hover:text-indigo-300 font-medium transition-colors">Edit</a>
                                        
                                        <form action="{{ route('admin.resume.experience.destroy', $experience) }}" method="POST" onsubmit="return confirm('Delete this experience?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 font-medium transition-colors">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    No experiences found. Click "Add Experience" to get started.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
