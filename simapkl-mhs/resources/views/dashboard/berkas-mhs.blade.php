@extends('layout.app')
<title>Profil Mahasiswa - SIMAPKL</title>

@section('content')
<div class="p-4 min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <div class="max-w-8xl mx-auto">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Berkas Mahasiswa</h1>
                <p class="text-gray-600 dark:text-gray-300">Kelola dan lihat status berkas-berkas PKL Anda</p>
            </div>
        </div>

<!-- Upload Laporan Mingguan Modal -->
<div id="uploadLaporanModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md mx-4">
        <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Upload Laporan Mingguan</h3>
            <button onclick="closeUploadLaporanModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-6">
            <form id="uploadLaporanForm" action="{{ route('laporan.mingguan.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="judul_laporan" class="block text-gray-700 dark:text-gray-300 mb-2">Judul Laporan</label>
                    <input type="text" name="judul_laporan" id="judul_laporan" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div class="mb-4">
                    <label for="deskripsi_laporan" class="block text-gray-700 dark:text-gray-300 mb-2">Deskripsi</label>
                    <textarea name="deskripsi_laporan" id="deskripsi_laporan" rows="3" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400 dark:bg-gray-700 dark:text-white" required></textarea>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeUploadLaporanModal()" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-700 rounded-lg hover:bg-green-800 transition-colors duration-200">
                        Upload Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Upload Laporan Akhir Modal -->
<div id="uploadLaporanAkhirModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md mx-4">
        <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Upload Laporan Akhir</h3>
            <button onclick="closeUploadLaporanAkhirModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-6">
            <form id="uploadLaporanAkhirForm" action="{{ route('laporan.akhir.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="judul_laporan_akhir" class="block text-gray-700 dark:text-gray-300 mb-2">Judul Laporan</label>
                    <input type="text" name="judul_laporan" id="judul_laporan_akhir" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div class="mb-4">
                    <label for="deskripsi_laporan_akhir" class="block text-gray-700 dark:text-gray-300 mb-2">Deskripsi</label>
                    <textarea name="deskripsi_laporan" id="deskripsi_laporan_akhir" rows="3" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400 dark:bg-gray-700 dark:text-white" required></textarea>
                </div>
                <div class="mb-4">
                    <div id="laporanAkhirDropzone" class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center cursor-pointer hover:border-green-500 transition-colors duration-200">
                        <div id="laporanAkhirDropzoneContent">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Drag and drop your file here</p>
                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">or click to select file</p>
                            <input type="file" name="file_laporan" id="fileLaporanAkhirInput" class="hidden" accept=".pdf,.doc,.docx">
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
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeUploadLaporanAkhirModal()" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-700 rounded-lg hover:bg-green-800 transition-colors duration-200">
                        Upload Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 dark:bg-green-900 border-l-4 border-green-500 text-green-700 dark:text-green-200 p-4 mb-6 rounded">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Documents Sections -->
        <div class="space-y-8">
            <!-- Laporan Mingguan Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="bg-green-700 px-6 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-white">Laporan Mingguan</h2>
                    @if (Auth::guard('mahasiswa')->user()->lowongan == null)
                    <button class="px-4 py-2 bg-green-700 hover:bg-green-800 text-white rounded-lg flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Kamu Belum Terdaftar Magang
                    </button>
                    @else
                    <button onclick="showUploadLaporanModal()" class="px-4 py-2 bg-green-700 hover:bg-green-800 text-white rounded-lg flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Laporan Mingguan
                    </button>
                    @endif
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Judul Laporan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Upload</th>                                    
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Deskripsi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($laporanMingguan as $laporan)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $laporan->judul_laporan }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($laporan->created_at)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">{{ Str::limit($laporan->deskripsi_laporan, 50) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($laporan->status_laporan == 'Diterima')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200">
                                                Diterima
                                            </span>
                                        @elseif($laporan->status_laporan == 'Revisi')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200">
                                                Perlu Revisi
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200">
                                                Menunggu
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form action="{{route('laporan.mingguan.delete', ['id' => $laporan->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-400 hover:text-indigo-900 dark:hover:text-indigo-200">Hapus</button>
                                        </form>  
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Tidak ada laporan mingguan yang ditemukan.</td>  
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Laporan Akhir Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="bg-green-700 px-6 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-white">Laporan Akhir</h2>
                    @if (Auth::guard('mahasiswa')->user()->lowongan == null)
                    <button class="px-4 py-2 bg-green-700 hover:bg-green-800 text-white rounded-lg flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Kamu Belum Terdaftar Magang
                    </button>
                    @else
                    <button onclick="showUploadLaporanAkhirModal()" class="px-4 py-2 bg-green-700 hover:bg-green-800 text-white rounded-lg flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Laporan Akhir
                    </button>
                    @endif
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Judul Laporan</th>
                                    <th class ="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Upload</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">File</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($laporanAkhir as $laporan)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $laporan->judul_laporan }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($laporan->created_at)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">{{ $laporan->file_laporan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($laporan->status_laporan == 'Diterima')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200">
                                                Diterima
                                            </span>
                                        @elseif($laporan->status_laporan == 'Revisi')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200">
                                                Perlu Revisi
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200">
                                                Menunggu
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-200 mr-3">Lihat</a>
                                        <a href="{{route('laporan.akhir.download', ['id' => $laporan->id]) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-200 mr-3">Unduh</a>
                                        <form action="{{route('laporan.akhir.delete', ['id' => $laporan->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus Laporan ini?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-400 hover:text-indigo-900 dark:hover:text-indigo-200">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Tidak ada laporan akhir yang ditemukan.</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Global variables
let selectedFile = null;

// Modal functions
function showUploadLaporanModal() {
    const modal = document.getElementById('uploadLaporanModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
}

function closeUploadLaporanModal() {
    const modal = document.getElementById('uploadLaporanModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        resetLaporanForm();
    }
}

function showUploadLaporanAkhirModal() {
    const modal = document.getElementById('uploadLaporanAkhirModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
}

function closeUploadLaporanAkhirModal() {
    const modal = document.getElementById('uploadLaporanAkhirModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        resetLaporanAkhirForm();
    }
}

function showUploadModal() {
    const modal = document.getElementById('uploadModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
}

function closeUploadModal() {
    const modal = document.getElementById('uploadModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        resetUploadForm();
    }
}

// Form reset functions
function resetLaporanForm() {
    const judulInput = document.getElementById('judul_laporan');
    const deskripsiInput = document.getElementById('deskripsi_laporan');
    
    if (judulInput) judulInput.value = '';
    if (deskripsiInput) deskripsiInput.value = '';
}

function resetLaporanAkhirForm() {
    const judulInput = document.getElementById('judul_laporan_akhir');
    const deskripsiInput = document.getElementById('deskripsi_laporan_akhir');
    
    if (judulInput) judulInput.value = '';
    if (deskripsiInput) deskripsiInput.value = '';
    removeLaporanAkhirFile();
}

function resetUploadForm() {
    selectedFile = null;
    const dropContent = document.getElementById('dropContent');
    const filePreview = document.getElementById('filePreview');
    const errorMessage = document.getElementById('errorMessage');
    const submitBtn = document.getElementById('submitBtn');
    const fileInput = document.getElementById('fileInput');
    
    if (dropContent) dropContent.classList.remove('hidden');
    if (filePreview) filePreview.classList.add('hidden');
    if (errorMessage) errorMessage.classList.add('hidden');
    if (submitBtn) submitBtn.disabled = true;
    if (fileInput) fileInput.value = '';
}

// File handling functions
function handleLaporanAkhirFileSelect(e) {
    const file = e.target.files[0];
    if (file) {
        const dropzoneContent = document.getElementById('laporanAkhirDropzoneContent');
        const preview = document.getElementById('laporanAkhirPreview');
        const fileName = document.getElementById('laporanAkhirFileName');
        const fileSize = document.getElementById('laporanAkhirFileSize');
        
        if (dropzoneContent) dropzoneContent.classList.add('hidden');
        if (preview) preview.classList.remove('hidden');
        if (fileName) fileName.textContent = file.name;
        if (fileSize) fileSize.textContent = formatFileSize(file.size);
    }
}

function removeLaporanAkhirFile() {
    const fileInput = document.getElementById('fileLaporanAkhirInput');
    const dropzoneContent = document.getElementById('laporanAkhirDropzoneContent');
    const preview = document.getElementById('laporanAkhirPreview');
    
    if (fileInput) fileInput.value = '';
    if (dropzoneContent) dropzoneContent.classList.remove('hidden');
    if (preview) preview.classList.add('hidden');
}

function handleFileSelect(file) {
    const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    const allowedExtensions = ['.pdf', '.doc', '.docx'];
    
    // Check file type by both MIME type and extension
    const fileName = file.name.toLowerCase();
    const fileExtension = fileName.substring(fileName.lastIndexOf('.'));
    
    if (!allowedTypes.includes(file.type) && !allowedExtensions.includes(fileExtension)) {
        showError('Tipe file tidak didukung. Silakan upload file PDF, DOC, atau DOCX.');
        return;
    }

    if (file.size > 10 * 1024 * 1024) {
        showError('Ukuran file terlalu besar. Maksimal 10MB.');
        return;
    }

    selectedFile = file;
    const fileNameEl = document.getElementById('fileName');
    const fileSizeEl = document.getElementById('fileSize');
    const dropContent = document.getElementById('dropContent');
    const filePreview = document.getElementById('filePreview');
    const errorMessage = document.getElementById('errorMessage');
    const submitBtn = document.getElementById('submitBtn');
    
    if (fileNameEl) fileNameEl.textContent = file.name;
    if (fileSizeEl) fileSizeEl.textContent = formatFileSize(file.size);
    if (dropContent) dropContent.classList.add('hidden');
    if (filePreview) filePreview.classList.remove('hidden');
    if (errorMessage) errorMessage.classList.add('hidden');
    if (submitBtn) submitBtn.disabled = false;
}

function removeFile() {
    resetUploadForm();
}

function showError(message) {
    const errorDiv = document.getElementById('errorMessage');
    if (errorDiv) {
        const errorP = errorDiv.querySelector('p');
        if (errorP) errorP.textContent = message;
        errorDiv.classList.remove('hidden');
    }
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Close modals when clicking outside
    const modals = document.querySelectorAll('[id$="Modal"]');
    modals.forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                if (modal.id === 'uploadLaporanModal') closeUploadLaporanModal();
                else if (modal.id === 'uploadLaporanAkhirModal') closeUploadLaporanAkhirModal();
                else if (modal.id === 'uploadModal') closeUploadModal();
            }
        });
    });

    // Laporan Akhir file handling
    const laporanAkhirDropzone = document.getElementById('laporanAkhirDropzone');
    const fileLaporanAkhirInput = document.getElementById('fileLaporanAkhirInput');

    if (laporanAkhirDropzone && fileLaporanAkhirInput) {
        laporanAkhirDropzone.addEventListener('click', () => fileLaporanAkhirInput.click());
        fileLaporanAkhirInput.addEventListener('change', handleLaporanAkhirFileSelect);

        laporanAkhirDropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            laporanAkhirDropzone.classList.add('border-blue-500');
            laporanAkhirDropzone.classList.remove('border-gray-300', 'dark:border-gray-600');
        });

        laporanAkhirDropzone.addEventListener('dragleave', () => {
            laporanAkhirDropzone.classList.remove('border-blue-500');
            laporanAkhirDropzone.classList.add('border-gray-300', 'dark:border-gray-600');
        });

        laporanAkhirDropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            laporanAkhirDropzone.classList.remove('border-blue-500');
            laporanAkhirDropzone.classList.add('border-gray-300', 'dark:border-gray-600');
            
            if (e.dataTransfer.files.length) {
                // Create a new file input to simulate the change event
                const dt = new DataTransfer();
                dt.items.add(e.dataTransfer.files[0]);
                fileLaporanAkhirInput.files = dt.files;
                
                handleLaporanAkhirFileSelect({ target: fileLaporanAkhirInput });
            }
        });
    }

    // CV Upload handling
    const fileInput = document.getElementById('fileInput');
    const dropZone = document.getElementById('dropZone');
    const uploadForm = document.getElementById('uploadForm');

    if (fileInput) {
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFileSelect(e.target.files[0]);
            }
        });
    }

    if (dropZone) {
        dropZone.addEventListener('click', (e) => {
            if (e.target === dropZone || e.target.closest('#dropContent')) {
                if (fileInput) fileInput.click();
            }
        });

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZone.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900');
            dropZone.classList.remove('border-gray-300', 'dark:border-gray-600');
        });

        dropZone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZone.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900');
            dropZone.classList.add('border-gray-300', 'dark:border-gray-600');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZone.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900');
            dropZone.classList.add('border-gray-300', 'dark:border-gray-600');
            
            if (e.dataTransfer.files.length > 0) {
                handleFileSelect(e.dataTransfer.files[0]);
            }
        });
    }

    if (uploadForm) {
        uploadForm.addEventListener('submit', function(e) {
            e.preventDefault();

            if (!selectedFile) {
                showError('Silakan pilih file terlebih dahulu.');
                return;
            }

            const formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('CV berhasil diupload!');
                    closeUploadModal();
                    window.location.reload();
                } else {
                    showError(data.message || 'Terjadi kesalahan saat mengupload CV.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showError('Terjadi kesalahan. Silakan coba lagi.');
            });
        });
    }

    // Handle form submissions for laporan
    const laporanForm = document.getElementById('uploadLaporanForm');
    const laporanAkhirForm = document.getElementById('uploadLaporanAkhirForm');

    if (laporanForm) {
        laporanForm.addEventListener('submit', function(e) {
            const judul = document.getElementById('judul_laporan').value.trim();
            const deskripsi = document.getElementById('deskripsi_laporan').value.trim();
            
            if (!judul || !deskripsi) {
                e.preventDefault();
                alert('Silakan lengkapi semua field yang diperlukan.');
                return;
            }
        });
    }

    if (laporanAkhirForm) {
        laporanAkhirForm.addEventListener('submit', function(e) {
            const judul = document.getElementById('judul_laporan_akhir').value.trim();
            const deskripsi = document.getElementById('deskripsi_laporan_akhir').value.trim();
            const fileInput = document.getElementById('fileLaporanAkhirInput');
            
            if (!judul || !deskripsi || !fileInput.files.length) {
                e.preventDefault();
                alert('Silakan lengkapi semua field dan pilih file yang akan diupload.');
                return;
            }
        });
    }
});
</script>
@endsection