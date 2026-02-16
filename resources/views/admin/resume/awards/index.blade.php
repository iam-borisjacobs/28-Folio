@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full">
        
        <!-- Header & Breadcrumbs -->
        <div class="flex flex-col mb-8">
            <h1 class="text-5xl font-bold text-white mb-4">Awards</h1>
            <nav class="flex text-gray-400 text-lg">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Resume</span>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Awards</span>
            </nav>
        </div>

        <!-- Action Bar -->
        <div class="flex justify-end mb-8">
            <a href="{{ route('admin.resume.awards.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition-colors object-right">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Award
            </a>
        </div>

        <!-- Content -->
        <div class="bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-700">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-900/50 border-b border-gray-700 text-gray-400 text-sm uppercase tracking-wider">
                            <th class="px-6 py-4 font-semibold">Award Title & Issuer</th>
                            <th class="px-6 py-4 font-semibold">Date</th>
                            <th class="px-6 py-4 font-semibold w-1/3">Description</th>
                            <th class="px-6 py-4 font-semibold text-right">Order</th>
                            <th class="px-6 py-4 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($awards as $award)
                            <tr class="hover:bg-gray-700/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="text-white font-bold text-lg">{{ $award->title }}</div>
                                    <div class="text-gray-400">{{ $award->issuer }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-300 whitespace-nowrap">
                                    {{ $award->award_date ? $award->award_date->format('M Y') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-gray-400 text-sm">
                                    {{ Str::limit($award->description, 50) }}
                                </td>
                                <td class="px-6 py-4 text-right text-gray-400 font-mono">
                                    {{ $award->sort_order }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="{{ route('admin.resume.awards.edit', $award) }}" class="text-indigo-400 hover:text-indigo-300 font-medium transition-colors">Edit</a>
                                        
                                        <form action="{{ route('admin.resume.awards.destroy', $award) }}" method="POST" onsubmit="return confirm('Delete this award?');" class="inline">
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
                                    No awards found. Click "Add Award" to get started.
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
