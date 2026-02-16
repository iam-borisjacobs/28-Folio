@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full">
        
        <!-- Header & Breadcrumbs -->
        <div class="flex flex-col mb-8">
            <h1 class="text-5xl font-bold text-white mb-4">Education</h1>
            <nav class="flex text-gray-400 text-lg">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Resume</span>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Education</span>
            </nav>
        </div>

        <!-- Action Bar -->
        <div class="flex justify-end mb-8">
            <a href="{{ route('admin.resume.education.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition-colors object-right">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Education
            </a>
        </div>

        <!-- Content -->
        <div class="bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-700">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-900/50 border-b border-gray-700 text-gray-400 text-sm uppercase tracking-wider">
                            <th class="px-6 py-4 font-semibold">Degree & Institution</th>
                            <th class="px-6 py-4 font-semibold">Date Range</th>
                            <th class="px-6 py-4 font-semibold text-right">Order</th>
                            <th class="px-6 py-4 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($education as $edu)
                            <tr class="hover:bg-gray-700/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="text-white font-bold text-lg">{{ $edu->degree }}</div>
                                    @if($edu->field_of_study)
                                        <div class="text-indigo-400 text-sm font-medium">{{ $edu->field_of_study }}</div>
                                    @endif
                                    <div class="text-gray-400 mt-1">{{ $edu->institution }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-300 whitespace-nowrap">
                                    {{ $edu->start_date->format('Y') }} — 
                                    {{ $edu->end_date ? $edu->end_date->format('Y') : 'Present' }}
                                </td>
                                <td class="px-6 py-4 text-right text-gray-400 font-mono">
                                    {{ $edu->sort_order }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="{{ route('admin.resume.education.edit', $edu) }}" class="text-indigo-400 hover:text-indigo-300 font-medium transition-colors">Edit</a>
                                        
                                        <form action="{{ route('admin.resume.education.destroy', $edu) }}" method="POST" onsubmit="return confirm('Delete this education entry?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 font-medium transition-colors">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                    No education found. Click "Add Education" to get started.
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
