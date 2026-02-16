@extends('admin.layouts.app')

@section('content')
<div class="py-6" x-data="mediaManager()">
    <div class="w-full px-6">
        
        <!-- Header -->
        <div class="flex flex-col mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-5xl font-bold text-white mb-4">Media Library</h1>
                    <nav class="flex text-gray-400 text-lg">
                        <a href="{{ route('admin.media.index') }}" class="hover:text-white transition-colors">Home</a>
                        @foreach($breadcrumbs as $crumb)
                            <span class="mx-3">&rsaquo;</span>
                            <a href="{{ route('admin.media.index', ['folder_id' => $crumb->id]) }}" class="hover:text-white transition-colors">{{ $crumb->name }}</a>
                        @endforeach
                    </nav>
                </div>
                <div class="flex items-center gap-6">
                    <!-- Search -->
                    <div class="relative w-full md:w-96">
                        <input type="text" placeholder="Search files..." class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-3 pr-12">
                    </div>

                    <div class="flex items-center gap-4">
                        <!-- Create Folder Button -->
                        <button @click="showFolderModal = true" class="inline-flex items-center px-6 py-3 bg-gray-700 border border-gray-600 rounded-md font-semibold text-base text-gray-200 uppercase tracking-widest hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 whitespace-nowrap">
                            <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>
                            <span>New Folder</span>
                        </button>
                        
                        <!-- Upload Button (Trigger) -->
                        <label for="file-upload" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-bold text-base text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer whitespace-nowrap">
                            <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            <span>Upload</span>
                        </label>
                        <input id="file-upload" type="file" multiple class="hidden" @change="handleFiles($event.target.files)">
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Container -->
        <div class="bg-[#1e293b] rounded-lg shadow-xl overflow-hidden border border-gray-700 p-8 min-h-[600px]">

            <!-- Drag & Drop Zone -->
            <div 
                class="relative border-2 border-dashed border-gray-700 rounded-lg p-12 mb-10 text-center transition-colors duration-200 bg-gray-900/50"
                :class="{ 'border-indigo-500 bg-gray-800/80': isDragging }"
                @dragover.prevent="isDragging = true"
                @dragleave.prevent="isDragging = false"
                @drop.prevent="isDragging = false; handleFiles($event.dataTransfer.files)"
            >
                <div class="flex flex-col items-center justify-center space-y-4">
                    <div class="p-4 bg-gray-800 rounded-full shadow-lg">
                        <svg class="w-10 h-10 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                    </div>
                    <div class="text-gray-300 text-lg">
                        <span class="font-medium text-indigo-400 cursor-pointer hover:underline" @click="document.getElementById('file-upload').click()">Upload a file</span> 
                        or drag and drop
                    </div>
                    <p class="text-sm text-gray-500">PNG, JPG, GIF, WEBP, PDF, MP4 up to 10MB</p>
                </div>

                <!-- Upload Progress -->
                <div x-show="uploading" class="absolute inset-0 bg-gray-900/95 flex flex-col items-center justify-center rounded-lg z-10" style="display: none;">
                    <div class="w-96">
                        <div class="flex justify-between mb-2 text-base text-gray-300 font-medium">
                            <span>Uploading files...</span>
                            <span x-text="progress + '%'"></span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-3 overflow-hidden">
                            <div class="bg-indigo-600 h-3 rounded-full transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">
                
                <!-- Folders -->
                @foreach($folders as $folder)
                <div class="group relative bg-gray-900 rounded-xl p-6 border border-gray-700 hover:border-indigo-500 transition-all cursor-pointer shadow-sm hover:shadow-md"
                     onclick="window.location='{{ route('admin.media.index', ['folder_id' => $folder->id]) }}'">
                    <div class="flex flex-col items-center gap-4">
                        <svg class="w-16 h-16 text-yellow-500/80 group-hover:text-yellow-400 transition-colors transform group-hover:scale-110 duration-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19.5 21a3 3 0 003-3v-4.5a3 3 0 00-3-3h-15a3 3 0 00-3 3V18a3 3 0 003 3h15zM1.5 10.146V6a3 3 0 013-3h5.379a2.25 2.25 0 011.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 013 3v1.146A4.483 4.483 0 0019.5 9h-15a4.483 4.483 0 00-3.032 1.146z" />
                        </svg>
                        <span class="text-base font-semibold text-gray-200 group-hover:text-white truncate w-full text-center">{{ $folder->name }}</span>
                    </div>
                    
                    <!-- Folder Actions -->
                    <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity">
                        <form action="{{ route('admin.media.folders.destroy', $folder) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this folder?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 hover:bg-gray-800 rounded-md text-gray-400 hover:text-red-400 transition-colors" @click.stop title="Delete Folder">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach

                <!-- Files -->
                @foreach($files as $file)
                <div class="group relative bg-gray-900 rounded-xl border border-gray-700 hover:border-indigo-500 transition-all overflow-hidden flex flex-col shadow-sm hover:shadow-md">
                    <div class="aspect-square w-full bg-gray-800 relative flex items-center justify-center overflow-hidden">
                        @if($file->is_image)
                            <img src="{{ $file->url }}" alt="{{ $file->filename }}" class="object-cover w-full h-full transform group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="text-gray-500 flex flex-col items-center">
                                <svg class="w-16 h-16 mb-3 text-gray-600 group-hover:text-gray-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-sm font-bold uppercase tracking-wider text-gray-500">{{ Str::afterLast($file->filename, '.') }}</span>
                            </div>
                        @endif

                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gray-900/80 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-4 backdrop-blur-sm">
                            <a href="{{ $file->url }}" target="_blank" class="p-3 bg-gray-800 rounded-full hover:bg-indigo-600 text-white transition-all transform hover:scale-110 shadow-lg border border-gray-700 hover:border-indigo-500" title="View">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            <button class="p-3 bg-gray-800 rounded-full hover:bg-indigo-600 text-white transition-all transform hover:scale-110 shadow-lg border border-gray-700 hover:border-indigo-500" title="Copy URL" onclick="navigator.clipboard.writeText('{{ $file->url }}'); alert('URL copied!')">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="px-4 py-3 bg-gray-900 border-t border-gray-800">
                        <p class="text-sm font-semibold text-gray-200 truncate" title="{{ $file->filename }}">{{ $file->filename }}</p>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-xs text-gray-500 font-mono">{{ round($file->size / 1024, 1) }} KB</span>
                            
                            <form action="{{ route('admin.media.destroy', $file) }}" method="POST" onsubmit="return confirm('Delete this file?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-500 hover:text-red-400 transition-colors p-1" title="Delete File">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($folders->isEmpty() && $files->isEmpty())
            <div class="text-center py-32">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gray-800 mb-6">
                    <svg class="h-12 w-12 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-200">No media found</h3>
                <p class="mt-2 text-base text-gray-500 max-w-sm mx-auto">Get started by creating a new folder or uploading your first file to the library.</p>
                <div class="mt-8">
                     <button @click="document.getElementById('file-upload').click()" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-bold text-base text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Upload File
                    </button>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Create Folder Modal -->
    <div x-show="showFolderModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Backdrop -->
            <div x-show="showFolderModal" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 transition-opacity bg-black bg-opacity-80 backdrop-blur-sm" 
                 @click="showFolderModal = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <!-- Modal Panel -->
            <div x-show="showFolderModal" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block align-bottom bg-[#1e293b] rounded-lg text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-700">
                
                <form action="{{ route('admin.media.folders.store') }}" method="POST">
                    @csrf
                    <div class="px-6 py-6 sm:p-8">
                         <h3 class="text-2xl font-bold text-white mb-6">Create New Folder</h3>
                         
                         <div>
                            <label for="folder_name" class="block text-lg font-medium text-gray-300 mb-3">Folder Name</label>
                            <input type="text" name="name" id="folder_name" required autofocus
                                   class="block w-full rounded-md border-gray-700 bg-gray-900 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg px-5 py-4"
                                   placeholder="e.g. Project Assets">
                            <input type="hidden" name="parent_id" value="{{ $currentFolder ? $currentFolder->id : '' }}">
                        </div>
                    </div>
                    <div class="bg-gray-800/50 px-6 py-4 sm:px-8 sm:flex sm:flex-row-reverse border-t border-gray-700">
                        <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-bold text-base text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 sm:ml-3 sm:w-auto">
                            Create Folder
                        </button>
                        <button type="button" @click="showFolderModal = false" class="mt-3 w-full inline-flex justify-center items-center px-6 py-3 bg-gray-700 border border-transparent rounded-md font-semibold text-base text-gray-200 uppercase tracking-widest hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 sm:mt-0 sm:ml-3 sm:w-auto">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function mediaManager() {
        return {
            isDragging: false,
            uploading: false,
            progress: 0,
            showFolderModal: false,
            folderId: '{{ $currentFolder ? $currentFolder->id : "" }}',

            handleFiles(files) {
                if (files.length === 0) return;
                
                this.uploadFiles(files);
            },

            async uploadFiles(files) {
                this.uploading = true;
                this.progress = 0;
                
                const totalFiles = files.length;
                let completed = 0;

                for (let i = 0; i < totalFiles; i++) {
                    const formData = new FormData();
                    formData.append('file', files[i]);
                    if (this.folderId) {
                        formData.append('folder_id', this.folderId);
                    }

                    try {
                        await axios.post('{{ route("admin.media.upload") }}', formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            },
                            onUploadProgress: (progressEvent) => {
                                const percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                                this.progress = percentCompleted;
                            }
                        });
                        completed++;
                    } catch (error) {
                        console.error('Upload failed:', error);
                        // Optional: Show error toast
                    }
                }

                this.uploading = false;
                window.location.reload(); 
            }
        }
    }
</script>
@endsection
