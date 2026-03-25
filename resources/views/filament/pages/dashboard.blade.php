<x-filament-widgets::widget>
    <div class="py-6">
        <div class="w-full px-6">

            <!-- Welcome Card -->
            <div class="bg-[#1e293b] rounded-xl p-8 mb-8 relative overflow-hidden border border-gray-700 shadow-xl">
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <h3 class="text-4xl font-bold text-white mb-3 flex items-center">
                            <span class="mr-3">👋</span>
                            Welcome back, {{ auth()->check() ? explode(' ', auth()->user()->name)[0] : 'Admin' }}!
                            🚀
                        </h3>
                        <p class="text-xl text-gray-400">Here's an overview of your portfolio performance.</p>
                    </div>
                    <div class="bg-gray-800/50 p-2 rounded-lg border border-gray-700">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <!-- Subtle Background Decoration -->
                <div class="absolute right-0 top-0 h-full w-1/3 bg-gradient-to-l from-indigo-900/20 to-transparent">
                </div>
            </div>

            <!-- Metric Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <x-admin.stat-card label="Portfolio Views" :value="$stats['views']" color="green">
                    <x-slot:icon>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M5 13l4 4L19 7" />
                        </svg>
                    </x-slot:icon>
                </x-admin.stat-card>

                <x-admin.stat-card label="Projects" :value="$stats['projects']" color="blue">
                    <x-slot:icon>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </x-slot:icon>
                </x-admin.stat-card>

                <a href="{{ route('filament.admin.resources.posts.index') }}"
                    class="block transform hover:scale-[1.02] transition-transform">
                    <x-admin.stat-card label="Blog Posts" :value="$stats['posts']" color="purple">
                        <x-slot:icon>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </x-slot:icon>
                    </x-admin.stat-card>
                </a>

                <!-- Total Leads Metric -->
                <x-admin.stat-card label="Total Leads" :value="$totalLeads" color="yellow">
                    <x-slot:icon>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </x-slot:icon>
                    @if ($newLeads > 0)
                        <div
                            class="flex items-center text-sm font-medium text-yellow-400 bg-yellow-400/10 px-3 py-1 rounded w-fit drop-shadow-md">
                            <span>{{ $newLeads }} new unread</span>
                        </div>
                    @endif
                </x-admin.stat-card>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">

                <!-- Left Column: Recent Leads (Span 2) -->
                <div class="lg:col-span-2 space-y-8">

                    <!-- Recent Leads -->
                    <div class="bg-[#1e293b] rounded-xl shadow-xl border border-gray-700 overflow-hidden">
                        <div
                            class="px-8 py-6 border-b border-gray-700 flex justify-between items-center bg-gray-800/30">
                            <h3 class="text-xl font-bold text-white">Recent Leads</h3>
                            <a href="{{ route('filament.admin.resources.leads.index') }}"
                                class="text-indigo-400 hover:text-indigo-300 font-medium hover:underline">View All
                                Leads
                                &rarr;</a>
                        </div>
                        <div class="p-0">
                            <ul class="divide-y divide-gray-700">
                                @forelse($recentLeads as $lead)
                                    <li
                                        class="px-8 py-5 flex items-center justify-between hover:bg-gray-800/50 transition-colors">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-500/20 text-indigo-400 flex items-center justify-center font-bold text-lg border border-indigo-500/30">
                                                {{ substr($lead['name'], 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="text-lg font-medium text-white">{{ $lead['name'] }}
                                                </div>
                                                <div class="text-sm text-gray-400">{{ $lead['email'] }}</div>
                                            </div>
                                        </div>
                                        <div class="text-right flex flex-col items-end">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium uppercase tracking-wide {{ $lead['status'] === 'new' ? 'bg-green-100 text-green-800' : 'bg-gray-700 text-gray-300 border border-gray-600' }}">
                                                {{ $lead['status'] }}
                                            </span>
                                            <div class="text-xs text-gray-500 mt-1">
                                                {{ \Carbon\Carbon::parse($lead['created_at'])->diffForHumans() }}</div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="px-8 py-12 text-center text-gray-500 text-lg">
                                        No leads received yet.
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <!-- Projects Widget -->
                    <div class="bg-[#1e293b] rounded-xl p-8 border border-gray-700 shadow-xl">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-white">Recent Projects</h3>
                            <a href="{{ route('filament.admin.resources.projects.index') }}"
                                class="text-indigo-400 hover:text-indigo-300 font-medium hover:underline">View All
                                &rarr;</a>
                        </div>

                        <div class="space-y-6">
                            @foreach ($recent_projects as $project)
                                <div class="flex items-center gap-4 group cursor-pointer">
                                    @if ($project['image'])
                                        <img src="{{ $project['image'] }}"
                                            class="w-24 h-16 rounded-lg object-cover bg-gray-700 border border-gray-600 group-hover:border-indigo-500 transition-colors"
                                            alt="{{ $project['title'] }}">
                                    @else
                                        <div
                                            class="w-24 h-16 rounded-lg bg-gray-800 border border-gray-700 flex items-center justify-center text-gray-600">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <h5
                                            class="text-lg font-bold text-white truncate group-hover:text-indigo-400 transition-colors">
                                            {{ $project['title'] }}</h5>
                                        <p class="text-sm text-gray-400 truncate">{{ $project['subtitle'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <!-- Right Column: Quick Actions & Links (Span 1) -->
                <div class="space-y-8">

                    <!-- Quick Actions -->
                    <div class="bg-[#1e293b] rounded-xl p-6 border border-gray-700 shadow-xl">
                        <h3 class="text-xl font-bold text-white mb-6">Quick Actions</h3>
                        <div class="grid grid-cols-1 gap-4">
                            <a href="{{ route('filament.admin.resources.projects.create') }}"
                                class="flex items-center p-4 border border-gray-700 rounded-xl hover:bg-gray-800 transition-colors group">
                                <div
                                    class="p-3 bg-green-500/10 text-green-500 rounded-lg group-hover:bg-green-500 group-hover:text-white transition-colors mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-white text-lg">Add Project</div>
                                    <div class="text-sm text-gray-400">Showcase new work</div>
                                </div>
                            </a>

                            <a href="{{ route('filament.admin.resources.posts.create') }}"
                                class="flex items-center p-4 border border-gray-700 rounded-xl hover:bg-gray-800 transition-colors group">
                                <div
                                    class="p-3 bg-indigo-500/10 text-indigo-500 rounded-lg group-hover:bg-indigo-500 group-hover:text-white transition-colors mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-white text-lg">Write Post</div>
                                    <div class="text-sm text-gray-400">Share your thoughts</div>
                                </div>
                            </a>

                            <a href="{{ route('filament.admin.resources.media.index') }}"
                                class="flex items-center p-4 border border-gray-700 rounded-xl hover:bg-gray-800 transition-colors group">
                                <div
                                    class="p-3 bg-purple-500/10 text-purple-500 rounded-lg group-hover:bg-purple-500 group-hover:text-white transition-colors mr-4">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-white text-lg">Upload Media</div>
                                    <div class="text-sm text-gray-400">Manage your assets</div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- System Status / Links -->
                    <div class="bg-[#1e293b] rounded-xl p-6 border border-gray-700 shadow-xl">
                        <h3 class="text-xl font-bold text-white mb-6">System</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between text-gray-400">
                                <span>Laravel Version</span>
                                <span class="text-white font-mono">{{ app()->version() }}</span>
                            </div>
                            <div class="flex items-center justify-between text-gray-400">
                                <span>PHP Version</span>
                                <span class="text-white font-mono">{{ phpversion() }}</span>
                            </div>
                            <div class="pt-4 border-t border-gray-700">
                                <a href="{{ route('filament.admin.resources.settings.index') }}"
                                    class="w-full text-center block px-4 py-2 border border-gray-600 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 transition-colors">
                                    System Settings
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-filament-widgets::widget>
</div>
