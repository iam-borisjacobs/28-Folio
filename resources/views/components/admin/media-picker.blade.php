@props(['name', 'label' => 'Image', 'value' => null])

<div x-data="{ 
    showModal: false, 
    selectedUrl: '{{ $value }}',
    files: [],
    loading: false,
    
    init() {
        // Initialize if value exists
    },

    openModal() {
        this.showModal = true;
        this.loadFiles();
    },

    closeModal() {
        this.showModal = false;
    },

    selectFile(url) {
        this.selectedUrl = url;
        this.closeModal();
    },

    removeFile() {
        this.selectedUrl = null;
    },

    async loadFiles(folderId = null) {
        this.loading = true;
        try {
            // We need an API endpoint that returns JSON. 
            // Currently index returns a view. We might need a JSON variant or use a dedicated API.
            // For now, let's assume we can fetch the HTML or add a JSON response to the controller.
            // A quick fix is to check request()->wantsJson() in controller.
            
            // Let's implement a simple fetch for now assuming controller handles it
             const response = await axios.get('{{ route('admin.media.index') }}', {
                params: { folder_id: folderId },
                headers: { 'Accept': 'application/json' }
            });
            this.files = response.data.files;
            // this.folders = response.data.folders; 
        } catch (error) {
            console.error('Error loading files:', error);
        }
        this.loading = false;
    }
}">
    <label class="block text-sm font-medium text-gray-400 mb-2">{{ $label }}</label>
    
    <!-- Preview / Select Button -->
    <div class="flex items-center gap-4">
        <template x-if="selectedUrl">
            <div class="relative group">
                <img :src="selectedUrl" class="h-32 w-32 object-cover rounded-lg border border-gray-700">
                <button type="button" @click="removeFile()" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow-sm hover:bg-red-600">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </template>

        <button type="button" @click="openModal()" class="flex flex-col items-center justify-center h-32 w-32 rounded-lg border-2 border-dashed border-gray-700 hover:border-indigo-500 hover:bg-gray-800 transition-all text-gray-500 hover:text-indigo-400">
            <svg class="w-8 h-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
            <span class="text-xs font-medium">Select Image</span>
        </button>
    </div>

    <input type="hidden" :name="name" :value="selectedUrl">

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-black bg-opacity-75" @click="closeModal()"></div>

            <div class="inline-block align-bottom bg-gray-900 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full border border-gray-700">
                <div class="bg-gray-800 px-4 py-3 border-b border-gray-700 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-white">Select Media</h3>
                    <button @click="closeModal()" class="text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                
                <div class="p-6 h-96 overflow-y-auto">
                    <!-- Loading State -->
                    <div x-show="loading" class="flex justify-center items-center h-full">
                        <svg class="animate-spin h-8 w-8 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>

                    <!-- Grid -->
                    <div x-show="!loading" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        <template x-for="file in files" :key="file.id">
                            <div @click="selectFile(file.url)" class="group relative aspect-square bg-gray-800 rounded-lg border border-gray-700 hover:border-indigo-500 cursor-pointer overflow-hidden">
                                <img :src="file.url" class="object-cover w-full h-full">
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                                    <span class="text-white text-xs font-medium">Select</span>
                                </div>
                            </div>
                        </template>
                    </div>
                     <div x-show="!loading && files.length === 0" class="text-center text-gray-500 mt-10">
                        No files found. Please upload files in the Media Library first.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
