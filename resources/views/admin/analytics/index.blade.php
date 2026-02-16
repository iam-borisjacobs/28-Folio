@extends('admin.layouts.app')

@section('header')
    <h2 class="font-bold text-5xl text-white leading-tight">
        {{ __('Analytics') }}
    </h2>
@endsection

@section('content')
<div class="py-6">
    <div class="w-full px-6">
        
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <x-admin.stat-card label="Total Page Views" :value="$stats['views']" color="green">
                <x-slot:icon>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                </x-slot:icon>
            </x-admin.stat-card>

            <x-admin.stat-card label="Project Views" :value="$stats['projects']" color="blue">
                <x-slot:icon>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
                </x-slot:icon>
            </x-admin.stat-card>

            <x-admin.stat-card label="Post Reads" :value="$stats['posts']" color="purple">
                <x-slot:icon>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </x-slot:icon>
            </x-admin.stat-card>
        </div>

        <!-- Recent Activity Log -->
        <div class="bg-[#1e293b] rounded-xl shadow-xl border border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-700">
                <h3 class="text-xl font-bold text-white">Recent Activity Log</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-gray-400">
                    <thead class="bg-gray-800 text-gray-200 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-6 py-3">Event</th>
                            <th class="px-6 py-3">Subject</th>
                            <th class="px-6 py-3">User Agent</th>
                            <th class="px-6 py-3">Time</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($recentEvents as $event)
                        <tr class="hover:bg-gray-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-xs font-bold uppercase 
                                    {{ $event->event_type === 'page_view' ? 'bg-gray-700 text-gray-300' : '' }}
                                    {{ $event->event_type === 'project_view' ? 'bg-blue-900 text-blue-200' : '' }}
                                    {{ $event->event_type === 'post_view' ? 'bg-purple-900 text-purple-200' : '' }}
                                ">
                                    {{ str_replace('_', ' ', $event->event_type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($event->subject)
                                    <span class="text-white font-medium">{{ $event->subject->title ?? $event->subject->name ?? 'Unknown' }}</span>
                                    <span class="text-xs block text-gray-500">{{ class_basename($event->subject_type) }} #{{ $event->subject_id }}</span>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs truncate max-w-xs" title="{{ $event->user_agent }}">
                                {{ $event->user_agent }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                {{ $event->created_at->diffForHumans() }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                No analytics data recorded yet.
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
