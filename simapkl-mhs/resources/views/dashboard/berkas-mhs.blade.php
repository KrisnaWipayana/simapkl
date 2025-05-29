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
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
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
                    <div id="laporanAkhirDropzone" class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 transition-colors duration-200">
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
                                    <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Upload Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Upload CV Modal -->
<div id="uploadCVModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md mx-4">
        <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Upload CV</h3>
            <button onclick="closeUploadCVModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-6">
            <form id="uploadCVForm" action="{{ route('cv.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <div id="cvDropzone" class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 transition-colors duration-200">
                        <div id="cvDropzoneContent">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Drag and drop your CV file here</p>
                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">or click to select file</p>
                            <input type="file" name="cv" id="cvInput" class="hidden" accept=".pdf,.doc,.docx">
                        </div>
                        <div id="cvPreview" class="hidden">
                            <div class="flex items-center justify-between bg-gray-100 dark:bg-gray-700 rounded-lg p-3">
                                <div class="flex items-center">
                                    <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                    <div class="ml-3">
                                        <p id="cvFileName" class="text-sm font-medium text-gray-900 dark:text-white"></p>
                                        <p id="cvFileSize" class="text-xs text-gray-500 dark:text-gray-400"></p>
                                    </div>
                                </div>
                                <button type="button" onclick="removeCVFile()" class="text-red-500 hover:text-red-700">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeUploadCVModal()" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Upload CV
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
                <div class="bg-blue-600 px-6 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-white">Laporan Mingguan</h2>
                    <button onclick="showUploadLaporanModal()" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Laporan Mingguan
                    </button>
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
                                @foreach($laporanMingguan as $laporan)
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
                                        <!-- <a href="#" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-200 mr-3">Lihat</a>
                                        <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-200 mr-3">Unduh</a> -->
                                        <a href="#" class="text-red-600 dark:text-red-400 hover:text-indigo-900 dark:hover:text-indigo-200">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Laporan Akhir Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="bg-blue-600 px-6 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-white">Laporan Akhir</h2>
                    <button onclick="showUploadLaporanAkhirModal()" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Laporan Akhir
                    </button>
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
                                @foreach($laporanAkhir as $laporan)
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
                                        <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-200 mr-3">Unduh</a>
                                        <a href="#" class="text-red-600 dark:text-red-400 hover:text-indigo-900 dark:hover:text-indigo-200">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- CV Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="bg-blue-600 px-6 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-white">Upload CV</h2>
                    <button onclick="showUploadCVModal()" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Upload CV
                    </button>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama File</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Upload</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($cv as $file)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $file->file_cv }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($file->created_at)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-200 mr-3">Lihat</a>
                                        <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-200 mr-3">Unduh</a>
                                        <a href="#" class="text-red-600 dark:text-red-400 hover:text-indigo-900 dark:hover:text-indigo-200">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Modal functions
    function showUploadLaporanModal() {
        document.getElementById('uploadLaporanModal').classList.remove('hidden');
        document.getElementById('uploadLaporanModal').classList.add('flex');
    }

    function closeUploadLaporanModal() {
        document.getElementById('uploadLaporanModal').classList.add('hidden');
        document.getElementById('uploadLaporanModal').classList.remove('flex');
        resetLaporanForm();
    }

    function showUploadLaporanAkhirModal() {
        document.getElementById('uploadLaporanAkhirModal').classList.remove('hidden');
        document.getElementById('uploadLaporanAkhirModal').classList.add('flex');
    }

    function closeUploadLaporanAkhirModal() {
        document.getElementById('uploadLaporanAkhirModal').classList.add('hidden');
        document.getElementById('uploadLaporanAkhirModal').classList.remove('flex');
        resetLaporanAkhirForm();
    }

    function showUploadCVModal() {
        document.getElementById('uploadCVModal').classList.remove('hidden');
        document.getElementById('uploadCVModal').classList.add('flex');
    }

    function closeUploadCVModal() {
        document.getElementById('uploadCVModal').classList.add('hidden');
        document.getElementById('uploadCVModal').classList.remove('flex');
        resetCVForm();
    }

    // Close modals when clicking outside
    document.querySelectorAll('[id$="Modal"]').forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                if (modal.id === 'uploadLaporanModal') closeUploadLaporanModal();
                if (modal.id === 'uploadLaporanAkhirModal') closeUploadLaporanAkhirModal();
                if (modal.id === 'uploadCVModal') closeUploadCVModal();
            }
        });
    });

    // File handling for Laporan Mingguan
    // const laporanDropzone = document.getElementById('laporanDropzone');
    const fileLaporanInput = document.getElementById('fileLaporanInput');

    // laporanDropzone.addEventListener('click', () => fileLaporanInput.click());
    fileLaporanInput.addEventListener('change', handleLaporanFileSelect);

    // laporanDropzone.addEventListener('dragover', (e) => {
    //     e.preventDefault();
    //     laporanDropzone.classList.add('border-blue-500');
    //     laporanDropzone.classList.remove('border-gray-300', 'dark:border-gray-600');
    // });

    // laporanDropzone.addEventListener('dragleave', () => {
    //     laporanDropzone.classList.remove('border-blue-500');
    //     laporanDropzone.classList.add('border-gray-300', 'dark:border-gray-600');
    // });

    // laporanDropzone.addEventListener('drop', (e) => {
    //     e.preventDefault();
    //     laporanDropzone.classList.remove('border-blue-500');
    //     laporanDropzone.classList.add('border-gray-300', 'dark:border-gray-600');
        
    //     if (e.dataTransfer.files.length) {
    //         fileLaporanInput.files = e.dataTransfer.files;
    //         handleLaporanFileSelect({ target: fileLaporanInput });
    //     }
    // });

    // function handleLaporanFileSelect(e) {
    //     const file = e.target.files[0];
    //     if (file) {
    //         document.getElementById('laporanDropzoneContent').classList.add('hidden');
    //         document.getElementById('laporanPreview').classList.remove('hidden');
            
    //         document.getElementById('laporanFileName').textContent = file.name;
    //         document.getElementById('laporanFileSize').textContent = formatFileSize(file.size);
    //     }
    // }

    function removeLaporanFile() {
        fileLaporanInput.value = '';
        document.getElementById('laporanDropzoneContent').classList.remove('hidden');
        document.getElementById('laporanPreview').classList.add('hidden');
    }

    function resetLaporanForm() {
        document.getElementById('judul_laporan').value = '';
        document.getElementById('deskripsi_laporan').value = '';
        removeLaporanFile();
    }

    // File handling for Laporan Akhir
    const laporanAkhirDropzone = document.getElementById('laporanAkhirDropzone');
    const fileLaporanAkhirInput = document.getElementById('fileLaporanAkhirInput');

    laporanAkhirDropzone.addEventListener('click', () => fileLaporanAkhirInput.click());
    fileLaporanAkhirInput.addEventListener('change', handleLaporanFileSelect);

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
            fileLaporanAkhirInput.files = e.dataTransfer.files;
            handleLaporanFileSelect({ target: fileLaporanAkhirInput });
        }
    });

    function handleLaporanAkhirFileSelect(e) {
        const file = e.target.files[0];
        if (file) {
            document.getElementById('laporanAkhirDropzoneContent').classList.add('hidden');
            document.getElementById('laporanAkhirPreview').classList.remove('hidden');
            
            document.getElementById('laporanAkhirFileName').textContent = file.name;
            document.getElementById('laporanAkhirFileSize').textContent = formatFileSize(file.size);
        }
    }

    function removeLaporanAkhirFile() {
        fileLaporanAkhirInput.value = '';
        document.getElementById('laporanAkhirDropzoneContent').classList.remove('hidden');
        document.getElementById('laporanAkhirPreview').classList.add('hidden');
    }

    function resetLaporanAkhirForm() {
        document.getElementById('judul_laporan').value = '';
        document.getElementById('deskripsi_laporan').value = '';
        removeLaporanAkhirFile();
    }

    // File handling for CV (similar to above)
    // ... similar implementation for CV ...

    // Helper function
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
</script>
@endsection