@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full">
        
        <!-- Header & Breadcrumbs -->
        <div class="flex flex-col mb-8">
            <h1 class="text-5xl font-bold text-white mb-4">Certifications</h1>
            <nav class="flex text-gray-400 text-lg">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Resume</span>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Certifications</span>
            </nav>
        </div>

        <!-- Action Bar -->
        <div class="flex justify-end mb-8">
            <a href="{{ route('admin.resume.certifications.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition-colors object-right">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Certification
            </a>
        </div>

        <!-- Content -->
        <div class="bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-700">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-900/50 border-b border-gray-700 text-gray-400 text-sm uppercase tracking-wider">
                            <th class="px-6 py-4 font-semibold">Name & Issuer</th>
                            <th class="px-6 py-4 font-semibold">Issue Date</th>
                            <th class="px-6 py-4 font-semibold">Credential</th>
                            <th class="px-6 py-4 font-semibold text-right">Order</th>
                            <th class="px-6 py-4 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($certifications as $cert)
                            <tr class="hover:bg-gray-700/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="text-white font-bold text-lg">{{ $cert->name }}</div>
                                    <div class="text-gray-400">{{ $cert->issuer }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-300 whitespace-nowrap">
                                    {{ $cert->issue_date ? $cert->issue_date->format('M Y') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($cert->credential_url)
                                        <a href="{{ $cert->credential_url }}" target="_blank" class="text-indigo-400 hover:text-indigo-300 font-medium inline-flex items-center transition-colors">
                                            View Credential
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </a>
                                    @else
                                        <span class="text-gray-600 italic">No URL</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right text-gray-400 font-mono">
                                    {{ $cert->sort_order }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="{{ route('admin.resume.certifications.edit', $cert) }}" class="text-indigo-400 hover:text-indigo-300 font-medium transition-colors">Edit</a>
                                        
                                        <form action="{{ route('admin.resume.certifications.destroy', $cert) }}" method="POST" onsubmit="return confirm('Delete this certification?');" class="inline">
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
                                    No certifications found. Click "Add Certification" to get started.
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
