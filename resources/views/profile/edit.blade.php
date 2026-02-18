@extends('admin.layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="py-6">
        <div class="w-full px-6">

            <!-- Header & Breadcrumbs -->
            <div class="flex flex-col mb-8">
                <h1 class="text-5xl font-bold text-white mb-4">Profile</h1>
                <nav class="flex text-gray-400 text-lg">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                    <span class="mx-3">&rsaquo;</span>
                    <span class="text-gray-500">Profile</span>
                </nav>
            </div>

            <div class="space-y-6">
                <div class="p-8 bg-[#1e293b] shadow-xl border border-gray-700 rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-8 bg-[#1e293b] shadow-xl border border-gray-700 rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-8 bg-[#1e293b] shadow-xl border border-gray-700 rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
