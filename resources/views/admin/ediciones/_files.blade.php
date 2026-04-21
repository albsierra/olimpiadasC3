<script>
function fileManager(indexUrl) {
    return {
        files: [],
        loading: false,
        uploading: false,
        dragging: false,
        progress: 0,

        async loadFiles() {
            this.loading = true;
            const res = await fetch(indexUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            this.files = await res.json();
            this.loading = false;
        },

        onDrop(e) {
            this.dragging = false;
            this.uploadFiles(e.dataTransfer.files);
        },

        async uploadFiles(fileList) {
            if (!fileList.length) return;
            const formData = new FormData();
            Array.from(fileList).forEach(f => formData.append('files[]', f));
            formData.append('_token', '{{ csrf_token() }}');

            this.uploading = true;
            this.progress = 0;

            await new Promise((resolve, reject) => {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', indexUrl);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.upload.onprogress = (e) => {
                    if (e.lengthComputable) this.progress = Math.round((e.loaded / e.total) * 100);
                };
                xhr.onload = () => (xhr.status < 300 ? resolve() : reject());
                xhr.onerror = reject;
                xhr.send(formData);
            }).catch(() => alert('Error al subir archivos'));

            this.uploading = false;
            await this.loadFiles();
        },

        async deleteFile(file) {
            if (!confirm(`¿Eliminar "${file.name}"?`)) return;
            await fetch(file.delete_url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });
            await this.loadFiles();
        },

        formatSize(bytes) {
            if (bytes < 1024) return bytes + ' B';
            if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
            return (bytes / 1048576).toFixed(1) + ' MB';
        },
    };
}
</script>

<div
    x-data="fileManager('{{ route('admin.ediciones.files.index', $edicion) }}')"
    x-init="loadFiles()"
    class="mt-8 border rounded-lg p-6 bg-gray-50"
>
    <h3 class="text-lg font-semibold mb-4">Archivos adjuntos</h3>

    {{-- Zona de carga --}}
    <div
        @dragover.prevent="dragging = true"
        @dragleave.prevent="dragging = false"
        @drop.prevent="onDrop($event)"
        :class="dragging ? 'border-blue-500 bg-blue-50' : 'border-gray-300'"
        class="border-2 border-dashed rounded-lg p-8 text-center transition-colors cursor-pointer"
        @click="$refs.fileInput.click()"
    >
        <p class="text-gray-500">Arrastra archivos aquí o <span class="text-blue-600 underline">selecciónalos</span></p>
        <input
            type="file" multiple x-ref="fileInput" class="hidden"
            @change="uploadFiles($event.target.files)"
        >
    </div>

    {{-- Barra de progreso --}}
    <div x-show="uploading" class="mt-3">
        <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-blue-500 h-2 rounded-full transition-all" :style="`width: ${progress}%`"></div>
        </div>
        <p class="text-sm text-gray-500 mt-1" x-text="`Subiendo... ${progress}%`"></p>
    </div>

    {{-- Lista de archivos --}}
    <ul class="mt-4 space-y-2">
        <template x-for="file in files" :key="file.name">
            <li class="flex items-center justify-between bg-white border rounded px-4 py-2 shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M7 21h10a2 2 0 002-2V9.414A2 2 0 0018.414 9L15 5.586A2 2 0 0013.586 5H7a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-sm font-medium" x-text="file.name"></span>
                    <span class="text-xs text-gray-400" x-text="formatSize(file.size)"></span>
                </div>
                <button
                    @click="deleteFile(file)"
                    class="text-red-500 hover:text-red-700 text-sm font-medium transition-colors"
                    title="Eliminar"
                >
                    ✕
                </button>
            </li>
        </template>
        <li x-show="files.length === 0 && !loading" class="text-sm text-gray-400 text-center py-4">
            No hay archivos adjuntos.
        </li>
        <li x-show="loading" class="text-sm text-gray-400 text-center py-4">Cargando...</li>
    </ul>
</div>
