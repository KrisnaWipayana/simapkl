@extends('layout.app-dsn')
<title>
    Dashboard - SIMAPKL
</title>

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <div class="p-4 min-h-screen">
        <div class="max-w-8xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Detail Mahasiswa</h1>
                    <p class="text-gray-600 dark:text-gray-300">Informasi lengkap profil dan status PKL mahasiswa</p>
                </div>
            </div>

            <div id="revisionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md mx-4">
                        <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Catatan Revisi</h3>
                            <button onclick="closeRevisionModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <form id="revisiForm" method="POST" enctype="multipart/form-data" class="p-6">
                            @csrf
                            <input type="hidden" id="laporanIdToRevise" name="laporan_id">
                            <div class="mb-4">
                                <label for="fileLaporanAkhirInput" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih atau Drag File Revisi (DOC/PDF)</label>
                                <div id="laporanAkhirDropzone" class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center cursor-pointer hover:border-green-500 transition-colors duration-200">
                                    <div id="laporanAkhirDropzoneContent">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Drag and drop file di sini</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">atau klik untuk memilih file</p>
                                        <input type="file" name="revisi_file" id="fileLaporanAkhirInput" class="hidden" accept=".pdf,.doc,.docx">
                                    </div>
                                    <div id="laporanAkhirPreview" class="hidden">
                                        <div class="flex items-center justify-between bg-gray-100 dark:bg-gray-700 rounded-lg p-3">
                                            <div class="flex items-center">
                                                <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                </svg>
                                                <div class="ml-3">
                                                    <p id="laporanAkhirFileName" class="text-sm font-medium text-gray-900 dark:text-white"></p>
                                                    <p id="laporanAkhirFileSize" class="text-xs text-gray-500 dark:text-gray-400"></p>
                                                </div>
                                            </div>
                                            <button type="button" onclick="removeLaporanAkhirFile()" class="text-red-500 hover:text-red-700">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div id="fileError" class="text-red-600 text-sm mt-2 hidden">Hanya file DOC, DOCX, atau PDF yang diizinkan dan ukuran maksimal 5MB.</div>
                            </div>
                            <div class="flex justify-end">
                                <button type="button" onclick="closeRevisionModal()" class="mr-3 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">Batal</button>
                                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-700 rounded-md hover:bg-green-800">Unggah</button>
                            </div>
                        </form>
                    </div>
                </div>

            <div class="space-y-8">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <div class="bg-green-700 px-6 py-4">
                        <h2 class="text-xl font-semibold text-white">Informasi Profil</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <div class="text-center">
                                <div class="mb-4">
                                    <div class="w-32 h-32 mx-auto bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Foto tidak tersedia</p>
                                </div>
                            </div>
                            
                            <div class="lg:col-span-2">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIM</label>
                                        <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">{{$mahasiswa->nim}}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                                        <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">{{$mahasiswa->nama}}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                        <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">{{$mahasiswa->email}}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Program Studi</label>
                                        <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">{{$mahasiswa->nama_prodi}}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jurusan</label>
                                        <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">{{$mahasiswa->nama_jurusan}}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Posisi Magang</label>
                                        <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                            {{ $mahasiswa->nama_lowongan ? $mahasiswa->nama_lowongan . ' di ' . $mahasiswa->nama_perusahaan : 'Belum Terdaftar Magang' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="bg-green-700 px-6 py-4">
                            <h2 class="text-xl font-semibold text-white">Laporan Mingguan</h2>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700 sticky top-0">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Upload</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Judul</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse ($laporanMingguan as $laporan)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500 dark:text-gray-300">
                                                {{ \Carbon\Carbon::parse($laporan->created_at)->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 text-xs text-gray-900 dark:text-gray-100">{{$laporan->judul_laporan}}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-grey-500 dark:text-grey-300">
                                                    {{ Str::limit($laporan->deskripsi_laporan, 50) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">
                                                Tidak ada laporan mingguan
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="bg-green-700 px-6 py-4">
                            <h2 class="text-xl font-semibold text-white">Status Laporan Akhir</h2>
                        </div>
                        <div class="">
                            <div class="space-y-4">
                                <div class="max-h-96 overflow-y-auto">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700 sticky top-0">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Upload</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Judul Laporan</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                            @forelse ($laporanAkhir as $laporan)
                                            <tr id="laporan-{{$laporan->id}}">
                                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500 dark:text-gray-300">
                                                    {{ \Carbon\Carbon::parse($laporan->created_at)->format('d M Y') }}
                                                </td>
                                                <td class="px-6 py-4 text-xs text-gray-900 dark:text-gray-100">{{$laporan->judul_laporan}}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span id="status-badge-{{$laporan->id}}" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                        @if($laporan->status_laporan == 'Diterima') bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200
                                                        @elseif($laporan->status_laporan == 'Revisi') bg-red-100 dark:bg-red-800 text-red-800 dark:text-red-200
                                                        @else bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200 @endif">
                                                        {{ $laporan->status_laporan }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <select onchange="updateStatus({{$laporan->id}}, this.value)" 
                                                            class="text-xs border border-gray-300 dark:border-gray-600 rounded px-1 py-1 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500">
                                                        <option value="">Pilih Status</option>
                                                        <option value="Diterima">Diterima</option>
                                                        <option value="Menunggu">Menunggu</option>
                                                        <option value="Revisi">Revisi</option>
                                                    </select>
                                                    <a href="{{ route('laporan.akhir.download', $laporan->id) }}" 
                                                    class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-200 text-xs ml-3">
                                                    Unduh
                                                    </a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">
                                                    Tidak ada data laporan akhir
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="toast" class="fixed top-4 right-0 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out z-50">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span id="toast-message">Status berhasil diupdate!</span>
        </div>
    </div>

</body>
    <script>
    // File handling variables
    let selectedRevisionFile = null;
    
    // DOM elements
    const elements = {
        revisionModal: document.getElementById('revisionModal'),
        laporanIdToReviseInput: document.getElementById('laporanIdToRevise'),
        revisiForm: document.getElementById('revisiForm'),
        laporanAkhirDropzone: document.getElementById('laporanAkhirDropzone'),
        laporanAkhirDropzoneContent: document.getElementById('laporanAkhirDropzoneContent'),
        fileLaporanAkhirInput: document.getElementById('fileLaporanAkhirInput'),
        laporanAkhirPreview: document.getElementById('laporanAkhirPreview'),
        laporanAkhirFileName: document.getElementById('laporanAkhirFileName'),
        laporanAkhirFileSize: document.getElementById('laporanAkhirFileSize'),
        fileError: document.getElementById('fileError'),
        toast: document.getElementById('toast'),
        toastMessage: document.getElementById('toast-message')
    };

    // Status badge classes
    const statusClasses = {
        'Diterima': 'bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200',
        'Menunggu': 'bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200',
        'Revisi': 'bg-red-100 dark:bg-red-800 text-red-800 dark:text-red-200'
    };

    // File validation constants
    const FILE_TYPES = [
        'application/pdf', 
        'application/msword', 
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ];
    const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5MB in bytes

    // ========== Core Functions ========== //

    /**
     * Update laporan status
     */
    async function updateStatus(laporanId, newStatus) {
        if (!newStatus) return;

        const originalStatus = document.getElementById(`status-badge-${laporanId}`).textContent;
        
        // Optimistic UI update
        updateStatusUI(laporanId, newStatus);

        try {
            const response = await fetch(`/dashboard/laporan-akhir/${laporanId}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status: newStatus })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await parseResponse(response);
            
            if (data.success) {
                showToast(`Status diperbarui ke ${newStatus}`);
                if (newStatus === 'Revisi') {
                    elements.laporanIdToReviseInput.value = laporanId;
                    openRevisionModal();
                }
            } else {
                throw new Error(data.message || 'Update gagal');
            }
        } catch (error) {
            console.error('Error:', error);
            updateStatusUI(laporanId, originalStatus);
            showToast(error.message || 'Kesalahan jaringan', 'error');
        }
    }

    /**
     * Update status UI
     */
    function updateStatusUI(laporanId, newStatus) {
        const badge = document.getElementById(`status-badge-${laporanId}`);
        if (!badge) return;
        
        badge.className = `px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClasses[newStatus] || statusClasses['Menunggu']}`;
        badge.textContent = newStatus;
    }

    /**
     * Show toast notification
     */
    function showToast(message, type = 'success') {
        // Update message and color
        elements.toastMessage.textContent = message;
        elements.toast.className = elements.toast.className
            .replace('bg-green-500', '')
            .replace('bg-red-500', '');
        elements.toast.classList.add(type === 'error' ? 'bg-red-500' : 'bg-green-500');
        
        // Show toast
        elements.toast.classList.remove('translate-x-full');
        
        // Hide after 3 seconds
        setTimeout(() => {
            elements.toast.classList.add('translate-x-full');
        }, 3000);
    }

    /**
     * Handle file validation and preview
     */
    function handleFile(file) {
        elements.fileError.classList.add('hidden');

        // Validate file type
        if (!FILE_TYPES.includes(file.type)) {
            showFileError('Hanya file DOC, DOCX, atau PDF yang diizinkan.');
            return;
        }

        // Validate file size
        if (file.size > MAX_FILE_SIZE) {
            showFileError('Ukuran file terlalu besar. Maksimal 5MB.');
            return;
        }

        // Set selected file and show preview
        selectedRevisionFile = file;
        elements.laporanAkhirFileName.textContent = file.name;
        elements.laporanAkhirFileSize.textContent = formatFileSize(file.size);
        
        elements.laporanAkhirDropzoneContent.classList.add('hidden');
        elements.laporanAkhirPreview.classList.remove('hidden');
    }

    /**
     * Remove selected file and reset UI
     */
    function removeLaporanAkhirFile() {
        selectedRevisionFile = null;
        elements.fileLaporanAkhirInput.value = '';
        elements.laporanAkhirFileName.textContent = '';
        elements.laporanAkhirFileSize.textContent = '';
        
        elements.laporanAkhirDropzoneContent.classList.remove('hidden');
        elements.laporanAkhirPreview.classList.add('hidden');
        elements.fileError.classList.add('hidden');
    }

    // ========== Modal Functions ========== //

    function openRevisionModal() {
        elements.revisionModal.classList.remove('hidden');
        elements.revisionModal.classList.add('flex');
        removeLaporanAkhirFile();
    }

    function closeRevisionModal() {
        elements.revisionModal.classList.add('hidden');
        elements.revisionModal.classList.remove('flex');
        removeLaporanAkhirFile();
        elements.revisiForm.reset();
    }

    // ========== Helper Functions ========== //

    function showFileError(message) {
        elements.fileError.textContent = message;
        elements.fileError.classList.remove('hidden');
        removeLaporanAkhirFile();
    }

    function formatFileSize(bytes) {
        if (bytes < 1024) return bytes + ' B';
        if (bytes < 1048576) return (bytes / 1024).toFixed(2) + ' KB';
        return (bytes / 1048576).toFixed(2) + ' MB';
    }

    async function parseResponse(response) {
        try {
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                return await response.json();
            }
            return { success: true };
        } catch (e) {
            console.error('Error parsing response:', e);
            return { success: false, message: 'Invalid response format' };
        }
    }

    // ========== Event Listeners ========== //

    // Drag and drop events
    elements.laporanAkhirDropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        elements.laporanAkhirDropzone.classList.add('border-green-500');
        elements.laporanAkhirDropzone.classList.remove('border-gray-300', 'dark:border-gray-600');
    });

    elements.laporanAkhirDropzone.addEventListener('dragleave', () => {
        elements.laporanAkhirDropzone.classList.remove('border-green-500');
        elements.laporanAkhirDropzone.classList.add('border-gray-300', 'dark:border-gray-600');
    });

    elements.laporanAkhirDropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        elements.laporanAkhirDropzone.classList.remove('border-green-500');
        elements.laporanAkhirDropzone.classList.add('border-gray-300', 'dark:border-gray-600');
        
        if (e.dataTransfer.files.length > 0) {
            handleFile(e.dataTransfer.files[0]);
        }
    });

    // File input click
    elements.laporanAkhirDropzone.addEventListener('click', () => {
        elements.fileLaporanAkhirInput.click();
    });

    // File input change
    elements.fileLaporanAkhirInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            handleFile(e.target.files[0]);
        }
    });

    // Form submission
    elements.revisiForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        if (!selectedRevisionFile) {
            showFileError('Silakan pilih file untuk diunggah.');
            return;
        }

        const formData = new FormData();
        formData.append('revisi_file', selectedRevisionFile);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        formData.append('laporan_id', elements.laporanIdToReviseInput.value);

        try {
            const response = await fetch(`/dashboard/laporan-akhir/${elements.laporanIdToReviseInput.value}/upload-revisi`, {
                method: 'POST',
                body: formData,
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await parseResponse(response);
            
            if (data.success) {
                showToast('File revisi berhasil diunggah.');
                closeRevisionModal();
            } else {
                throw new Error(data.message || 'Gagal mengunggah file revisi.');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast(error.message || 'Terjadi kesalahan saat mengunggah file.', 'error');
        }
    });
</script>
@endsection