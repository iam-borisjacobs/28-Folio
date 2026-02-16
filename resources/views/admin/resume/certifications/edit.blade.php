@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="w-full px-6">
        
        <!-- Header & Breadcrumbs -->
        <div class="flex flex-col mb-8">
            <h1 class="text-5xl font-bold text-white mb-4">Edit Certification</h1>
            <nav class="flex text-gray-400 text-lg">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Resume</span>
                <span class="mx-3">&rsaquo;</span>
                <a href="{{ route('admin.resume.certifications.index') }}" class="hover:text-white transition-colors">Certifications</a>
                <span class="mx-3">&rsaquo;</span>
                <span class="text-gray-500">Edit</span>
            </nav>
        </div>

        <div class="bg-[#1e293b] rounded-lg shadow-xl overflow-hidden border border-gray-700">
            <form action="{{ route('admin.resume.certifications.update', $certification) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="p-8 space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Name -->
                        <div class="col-span-1">
                            <label for="name" class="block text-lg font-medium text-gray-300 mb-3">Certification Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $certification->name) }}" required autofocus
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                                placeholder="e.g. AWS Certified Solutions Architect">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                         <!-- Issuer -->
                         <div class="col-span-1">
                            <label for="issuer" class="block text-lg font-medium text-gray-300 mb-3">Issuer</label>
                            <input type="text" id="issuer" name="issuer" value="{{ old('issuer', $certification->issuer) }}" required
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                                placeholder="e.g. Amazon Web Services">
                            <x-input-error :messages="$errors->get('issuer')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                         <!-- Issue Date -->
                         <div class="col-span-1">
                            <label for="issue_date" class="block text-lg font-medium text-gray-300 mb-3">Issue Date</label>
                            <input type="date" id="issue_date" name="issue_date" value="{{ old('issue_date', $certification->issue_date ? $certification->issue_date->format('Y-m-d') : '') }}"
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                            <x-input-error :messages="$errors->get('issue_date')" class="mt-2" />
                        </div>

                        <!-- Credential URL -->
                        <div class="col-span-1">
                            <label for="credential_url" class="block text-lg font-medium text-gray-300 mb-3">Credential URL (Optional)</label>
                            <input type="url" id="credential_url" name="credential_url" value="{{ old('credential_url', $certification->credential_url) }}"
                                class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                                placeholder="https://...">
                            <x-input-error :messages="$errors->get('credential_url')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Sort Order -->
                    <div>
                         <label for="sort_order" class="block text-lg font-medium text-gray-300 mb-3">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $certification->sort_order) }}"
                            class="block w-40 rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4">
                        <p class="mt-2 text-base text-gray-500">Higher numbers appear last.</p>
                        <x-input-error :messages="$errors->get('sort_order')" class="mt-2" />
                    </div>
                </div>

                <div class="bg-gray-800 px-8 py-6 border-t border-gray-700 flex justify-end space-x-4">
                    <a href="{{ route('admin.resume.certifications.index') }}" class="inline-flex items-center px-8 py-4 border border-gray-600 rounded-md shadow-sm text-sm font-bold text-gray-300 uppercase tracking-widest bg-transparent hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 focus:ring-offset-gray-900 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center px-8 py-4 bg-indigo-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Update Certification
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
