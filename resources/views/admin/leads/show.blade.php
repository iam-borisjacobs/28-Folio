@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full px-6">
        
        <!-- Header & Breadcrumbs -->
        <div class="flex flex-col mb-8">
            <h1 class="text-5xl font-bold text-white mb-4">Lead Details</h1>
             <nav class="flex text-gray-400 text-lg">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <span class="mx-3">&rsaquo;</span>
                <a href="{{ route('admin.leads.index') }}" class="hover:text-white transition-colors">Leads</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">View Lead</span>
            </nav>
        </div>

        <div class="bg-[#1e293b] rounded-lg shadow-xl overflow-hidden border border-gray-700">
            <!-- Header -->
            <div class="px-8 py-6 border-b border-gray-700 flex justify-between items-center bg-gray-900/50">
                <div class="flex items-center gap-4">
                    <h2 class="text-3xl font-bold text-white">{{ $lead->subject ?? '(No Subject)' }}</h2>
                    <span class="px-4 py-2 text-sm font-bold uppercase tracking-wider rounded-lg {{ $lead->status === 'new' ? 'bg-green-600/20 text-green-400 border border-green-600/30' : 'bg-gray-600/20 text-gray-400 border border-gray-600/30' }}">
                        {{ ucfirst($lead->status) }}
                    </span>
                </div>
                <span class="text-lg text-gray-400">{{ $lead->created_at->format('M d, Y h:i A') }}</span>
            </div>

            <div class="p-8 space-y-8">
                <!-- Sender Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-lg font-medium text-gray-300 mb-2">Name</label>
                        <div class="text-xl text-white bg-gray-900/50 rounded-md px-5 py-4 border border-gray-700">{{ $lead->name }}</div>
                    </div>
                    <div>
                        <label class="block text-lg font-medium text-gray-300 mb-2">Email</label>
                        <div class="text-xl text-indigo-400 bg-gray-900/50 rounded-md px-5 py-4 border border-gray-700 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <a href="mailto:{{ $lead->email }}" class="hover:underline">{{ $lead->email }}</a>
                        </div>
                    </div>
                </div>

                <!-- Message Content -->
                <div>
                     <label class="block text-lg font-medium text-gray-300 mb-2">Message</label>
                    <div class="bg-gray-900/50 rounded-md p-6 text-gray-200 whitespace-pre-wrap leading-relaxed border border-gray-700 text-lg font-sans">
                        {{ $lead->message }}
                    </div>
                </div>

                <!-- Technical Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-8 border-t border-gray-700">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">IP Address</label>
                        <div class="text-base text-gray-400 font-mono bg-gray-900/30 px-3 py-2 rounded border border-gray-800 inline-block">{{ $lead->ip_address ?? 'N/A' }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">User Agent</label>
                        <div class="text-base text-gray-400 font-mono bg-gray-900/30 px-3 py-2 rounded border border-gray-800 truncate" title="{{ $lead->user_agent }}">{{ $lead->user_agent ?? 'N/A' }}</div>
                    </div>
                </div>

                 <!-- Footer / Actions -->
                <div class="pt-8 border-t border-gray-700 flex justify-end gap-4">
                    <!-- Status Toggle -->
                    <form action="{{ route('admin.leads.update', $lead) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @if($lead->status === 'new')
                            <input type="hidden" name="status" value="contacted">
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-700 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Mark as Contacted
                            </button>
                        @else
                            <input type="hidden" name="status" value="new">
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Mark as New
                            </button>
                        @endif
                    </form>

                     <a href="mailto:{{ $lead->email }}?subject=Re: {{ $lead->subject }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Reply via Email
                    </a>

                    <form action="{{ route('admin.leads.destroy', $lead) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this lead? This cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
