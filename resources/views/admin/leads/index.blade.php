@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full px-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-white">Leads</h1>
        </div>
        <!-- Filters -->
        <div class="bg-gray-800 rounded-lg p-4 mb-6 flex flex-col md:flex-row gap-4 justify-between items-center">
            <form action="{{ route('admin.leads.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 w-full">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, email, subject..." 
                       class="bg-gray-700 text-white rounded-md px-4 py-2 border border-gray-600 focus:outline-none focus:border-indigo-500 w-full md:w-64">
                
                <select name="status" class="bg-gray-700 text-white rounded-md px-4 py-2 border border-gray-600 focus:outline-none focus:border-indigo-500">
                    <option value="">All Statuses</option>
                    <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                    <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>Contacted</option>
                </select>

                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition-colors">Filter</button>
                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.leads.index') }}" class="text-gray-400 hover:text-white px-4 py-2">Clear</a>
                @endif
            </form>
        </div>

        <!-- Leads Table -->
        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Name / Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Subject</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($leads as $lead)
                        <tr class="hover:bg-gray-750 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-white">{{ $lead->name }}</div>
                                <div class="text-sm text-gray-400">{{ $lead->email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-300 truncate max-w-xs">{{ $lead->subject ?? '(No Subject)' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $lead->status === 'new' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($lead->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                {{ $lead->created_at->format('M d, Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.leads.show', $lead) }}" class="text-indigo-400 hover:text-indigo-300 mr-4">View</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                No leads found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($leads->hasPages())
                <div class="px-6 py-4 border-t border-gray-700">
                    {{ $leads->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
