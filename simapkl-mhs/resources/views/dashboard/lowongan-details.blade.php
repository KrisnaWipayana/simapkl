<!-- resources/views/lowongan-details.blade.php -->
@extends('layout.app')
<title>
    {{ $lowongan->judul }} di {{ $lowongan->nama_perusahaan }}
</title>

@section('content')
    <div class="flex-1 overflow-auto p-4">

        <div id="alert" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 transition-all duration-500 ease-in-out transform translate-y-0 opacity-100">
            <div class="flex justify-between items-center">
                <h2 class="text-sm lg:text-lg font-sans font-semibold">Persiapkan data kamu sebelum melamar magang ya!</h2>
                <button id = "closeAlertBtn" class="text-gray-500 dark:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <!-- <p class="text-sm font-sans">Persiapkan data kamu sebelum melamar magang ya.</p> -->
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <!-- Container Informasi Perusahaan dan Lowongan (3/4) -->
            <div class="lg:col-span-3 mt-4">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <!-- Header Lowongan -->
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex justify-between items-start">
                            <div>
                                <h1 class="text-3xl font-sans font-semibold text-gray-900 dark:text-white mb-2">
                                    {{ $lowongan->judul }}
                                </h1>
                                <p class="text-lg text-blue-600 dark:text-blue-400 font-medium">
                                    {{ $lowongan->nama_perusahaan }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                    {{ $lowongan->alamat_perusahaan }}
                                </p>
                            </div>
                            <!-- <div class="text-right">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                    Aktif
                                </span>
                            </div> -->
                        </div>
                    </div>

                    <!-- Informasi Waktu -->
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Tanggal Mulai</h3>
                                <p class="text-gray-900 dark:text-white">
                                    {{ \Carbon\Carbon::parse($lowongan->tanggal_mulai)->format('d F Y') }}
                                </p>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Tanggal Selesai</h3>
                                <p class="text-gray-900 dark:text-white">
                                    {{ \Carbon\Carbon::parse($lowongan->tanggal_selesai)->format('d F Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Durasi</h3>
                            <p class="text-gray-900 dark:text-white">
                                {{ \Carbon\Carbon::parse($lowongan->tanggal_mulai)->diffInMonths(\Carbon\Carbon::parse($lowongan->tanggal_selesai)) }} Bulan
                            </p>
                        </div>
                    </div>

                    <!-- Deskripsi Lowongan -->
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Deskripsi Posisi</h2>
                        <div class="prose dark:prose-invert max-w-none">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">
                                {{ $lowongan->deskripsi }}
                            </p>
                        </div>
                    </div>

                    <!-- Skill yang Dibutuhkan Lowongan -->
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Skill yang Dibutuhkan</h2>
                        <div class="flex flex-wrap gap-2">
                            @forelse($skillLowongan as $skill)
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                    {{ $skill }}
                                </span>
                            @empty
                                <span class="text-gray-500 dark:text-gray-400">Tidak ada skill khusus.</span>
                            @endforelse
                        </div>
                    </div>

                    <!-- Informasi Perusahaan -->
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Tentang Perusahaan</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nama Perusahaan</h3>
                                <p class="text-gray-900 dark:text-white mb-3">
                                    {{ $lowongan->nama_perusahaan }}
                                </p>
                                
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Industri</h3>
                                <p class="text-gray-900 dark:text-white mb-3">
                                    {{ $lowongan->perusahaan->industri ?? 'Teknologi Informasi' }}
                                </p>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Alamat</h3>
                                <p class="text-gray-900 dark:text-white mb-3">
                                    {{ $lowongan->alamat_perusahaan }}
                                </p>
                                
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Website</h3>
                                <a href="{{ $lowongan->perusahaan->website ?? '#' }}" 
                                   class="text-blue-600 dark:text-blue-400 hover:underline">
                                    {{ $lowongan->perusahaan->website ?? 'www.company.com' }}
                                </a>
                            </div>
                        </div>
                        @if($lowongan->perusahaan->deskripsi ?? false)
                        <div class="mt-4">
                            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Deskripsi Perusahaan</h3>
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                {{ $lowongan->perusahaan->deskripsi }}
                            </p>
                        </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="p-6">
                        <div class="flex flex-col sm:flex-row gap-3">
                            <button onclick="showApplicationAlert()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200">
                                Lamar Sekarang
                            </button>
                            <button class="flex-1 sm:flex-none bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold py-3 px-6 rounded-lg transition-colors duration-200">
                                Simpan Lowongan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Container Profile User (1/4) -->
            <div class="lg:col-span-1 mt-4 hidden lg:block">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 sticky">
                    <!-- Profile Header -->
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-gray-300 dark:bg-gray-600 rounded-full mx-auto mb-3 flex items-center justify-center">
                            @if(auth()->user()->avatar ?? false)
                                <img src="{{ auth()->user()->avatar }}" alt="Profile" class="w-20 h-20 rounded-full object-cover">
                            @else
                                <svg class="w-10 h-10 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ Auth::guard('mahasiswa')->user()->nama }}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                    <!-- Profile Stats -->
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Informasi Terisi</span>
                            <span class="text-sm font-semibold text-blue-600 dark:text-blue-400">85%</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="text-lg font-semibold text-gray-900 dark:text-white">12</div>
                            <div class="text-xs text-gray-600 dark:text-gray-400">Lamaran</div>
                        </div>
                        <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="text-lg font-semibold text-gray-900 dark:text-white">3</div>
                            <div class="text-xs text-gray-600 dark:text-gray-400">Interview</div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="space-y-3">
                        <button onclick="showEditProfileModal()" class="w-full bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-medium py-2 px-4 rounded-lg text-sm transition-colors duration-200">
                            Edit Profile
                        </button>
                        <button onclick="showUploadModal()" class="w-full bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-medium py-2 px-4 rounded-lg text-sm transition-colors duration-200">
                            Upload CV
                        </button>
                        <button class="w-full bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-medium py-2 px-4 rounded-lg text-sm transition-colors duration-200">
                            Riwayat Lamaran
                        </button>
                    </div>

                    <!-- User Skills -->
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Skill kamu:</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-2 gap-x-4">
                            @foreach ( $skillMahasiswa as $skill )
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                                <div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ $skill }}</p> 
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Upload CV -->
    <div id="uploadModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md mx-4">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Upload CV</h3>
                <button onclick="closeUploadModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <form id="uploadForm" action="{{ route('cv.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Drag and Drop Area -->
                    <div id="dropZone" class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-8 text-center hover:border-blue-500 dark:hover:border-blue-400 transition-colors duration-200 cursor-pointer">
                        <div id="dropContent">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500 mb-4" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="text-gray-600 dark:text-gray-400 mb-2">
                                <span class="font-semibold text-blue-600 dark:text-blue-400">Klik untuk upload</span> atau drag and drop
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-500">PDF, DOC, DOCX (Maksimal 10MB)</p>
                        </div>
                        <div id="filePreview" class="hidden">
                            <div class="flex items-center justify-center space-x-3">
                                <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <p id="fileName" class="text-sm font-medium text-gray-900 dark:text-white"></p>
                                    <p id="fileSize" class="text-xs text-gray-500 dark:text-gray-400"></p>
                                </div>
                            </div>
                            <button type="button" onclick="removeFile()" class="mt-2 text-sm text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                Hapus file
                            </button>
                        </div>
                    </div>
                    
                    <input type="file" id="fileInput" name="cv" accept=".pdf,.doc,.docx" class="hidden">
                    
                    <!-- Error Message -->
                    <div id="errorMessage" class="hidden mt-3 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <p class="text-sm"></p>
                    </div>

                    <!-- Success Message -->
                    <div id="successMessage" class="hidden mt-3 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        <p class="text-sm">CV berhasil diupload!</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeUploadModal()" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                            Batal
                        </button>
                        <button type="submit" id="submitBtn" disabled class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 disabled:bg-gray-400 disabled:cursor-not-allowed transition-colors duration-200">
                            Upload CV
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Profile -->
    <div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md mx-4">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Profile</h3>
                <button onclick="closeEditProfileModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <form id="editProfileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700 dark:text-gray-300 mb-2">Nama</label>
                        <input type="text" name="nama" id="nama" value="{{ Auth::guard('mahasiswa')->user()->nama }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400 dark:bg-gray-700 dark:text-white" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 dark:text-gray-300 mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ Auth::guard('mahasiswa')->user()->email }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400 dark:bg-gray-700 dark:text-white" required>
                    </div>
                    <div class="mb-4">
                        <label for="avatar" class="block text-gray-700 dark:text-gray-300 mb-2">Foto Profil (opsional)</label>
                        <input type="file" name="avatar" id="avatar" accept="image/*" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400 dark:bg-gray-700 dark:text-white">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 mb-2">Skill</label>
                        <div id="selectedSkills" class="flex flex-wrap gap-2 mb-2">
                            @foreach($skillMahasiswa as $id => $skill)
                                <span class="flex items-center bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300" data-id="{{ $id }}">
                                    {{ $skill }}
                                    <button type="button" class="ml-1 text-red-500 hover:text-red-700 focus:outline-none remove-skill-btn" data-id="{{ $id }}">
                                        &times;
                                    </button>
                                </span>
                            @endforeach
                        </div>
                        <input type="text" id="skillSearch" placeholder="Cari skill..." class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400 dark:bg-gray-700 dark:text-white">
                        <div id="skillSuggestions" class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded shadow-lg hidden"></div>
                        <small class="text-gray-500 dark:text-gray-400">Cari dan tambahkan skill. Klik <span class="font-bold text-red-500">×</span> untuk menghapus.</small>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeEditProfileModal()" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Alert Modal untuk Lamar -->
    <div id="applicationAlert" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-sm mx-4">
            <div class="p-6">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-blue-100 dark:bg-blue-900 rounded-full">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-center text-gray-900 dark:text-white mb-2">Konfirmasi Lamaran</h3>
                <p class="text-sm text-center text-gray-600 dark:text-gray-400 mb-6">
                    Apakah Anda yakin ingin melamar untuk posisi <strong>{{ $lowongan->judul }}</strong> di <strong>{{ $lowongan->perusahaan->nama ?? $lowongan->nama_perusahaan }}</strong>?
                </p>
                <div class="flex space-x-3">
                    <button onclick="closeApplicationAlert()" class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                        Batal
                    </button>
                    <button onclick="submitApplication()" class="flex-1 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Ya, Lamar
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        let selectedFile = null;

        // Upload CV Modal Functions
        function showUploadModal() {
            document.getElementById('uploadModal').classList.remove('hidden');
            document.getElementById('uploadModal').classList.add('flex');
        }

        function closeUploadModal() {
            document.getElementById('uploadModal').classList.add('hidden');
            document.getElementById('uploadModal').classList.remove('flex');
            resetUploadForm();
        }

        function resetUploadForm() {
            selectedFile = null;
            document.getElementById('dropContent').classList.remove('hidden');
            document.getElementById('filePreview').classList.add('hidden');
            document.getElementById('errorMessage').classList.add('hidden');
            document.getElementById('successMessage').classList.add('hidden');
            document.getElementById('submitBtn').disabled = true;
            document.getElementById('fileInput').value = '';
        }

        // Application Alert Functions
        function showApplicationAlert() {
            document.getElementById('applicationAlert').classList.remove('hidden');
            document.getElementById('applicationAlert').classList.add('flex');
        }

        function closeApplicationAlert() {
            document.getElementById('applicationAlert').classList.add('hidden');
            document.getElementById('applicationAlert').classList.remove('flex');
        }

        function submitApplication() {
            // Here you would typically submit the application to your backend
            alert('Lamaran berhasil dikirim!');
            closeApplicationAlert();
        }

        function showEditProfileModal() {
            document.getElementById('editProfileModal').classList.remove('hidden');
            document.getElementById('editProfileModal').classList.add('flex');
        }

        function closeEditProfileModal() {
            document.getElementById('editProfileModal').classList.add('hidden');
            document.getElementById('editProfileModal').classList.remove('flex');
        }

        // Close modal when clicking outside
        document.getElementById('editProfileModal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('editProfileModal')) {
                closeEditProfileModal();
            }
        });

        // File Upload Logic
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');

        // Click to upload
        dropZone.addEventListener('click', () => {
            fileInput.click();
        });

        // Drag and drop events
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900');
        });

        dropZone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFileSelect(files[0]);
            }
        });

        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFileSelect(e.target.files[0]);
            }
        });

        function handleFileSelect(file) {
            // Validate file type
            const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            if (!allowedTypes.includes(file.type)) {
                showError('Tipe file tidak didukung. Silakan upload file PDF, DOC, atau DOCX.');
                return;
            }

            // Validate file size (10MB = 10 * 1024 * 1024 bytes)
            if (file.size > 10 * 1024 * 1024) {
                showError('Ukuran file terlalu besar. Maksimal 10MB.');
                return;
            }

            selectedFile = file;
            showFilePreview(file);
            document.getElementById('submitBtn').disabled = false;
            document.getElementById('errorMessage').classList.add('hidden');
        }

        function showFilePreview(file) {
            document.getElementById('dropContent').classList.add('hidden');
            document.getElementById('filePreview').classList.remove('hidden');
            document.getElementById('fileName').textContent = file.name;
            document.getElementById('fileSize').textContent = formatFileSize(file.size);
        }

        function removeFile() {
            selectedFile = null;
            document.getElementById('dropContent').classList.remove('hidden');
            document.getElementById('filePreview').classList.add('hidden');
            document.getElementById('submitBtn').disabled = true;
            document.getElementById('fileInput').value = '';
        }

        function showError(message) {
            const errorDiv = document.getElementById('errorMessage');
            errorDiv.querySelector('p').textContent = message;
            errorDiv.classList.remove('hidden');
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Form submission
        document.getElementById('uploadForm').addEventListener('submit', (e) => {
    e.preventDefault();

    if (!selectedFile) {
        showError('Silakan pilih file terlebih dahulu.');
        return;
    }

    // Show loading state
    const submitBtn = document.getElementById('submitBtn');
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Uploading...';
    submitBtn.disabled = true;

    // Create FormData and send via AJAX
    const formData = new FormData();
    formData.append('cv', selectedFile);
    formData.append('_token', '{{ csrf_token() }}');

    fetch('{{ route("cv.upload") }}', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('successMessage').classList.remove('hidden');
            setTimeout(() => {
                closeUploadModal();
                window.location.reload();
            }, 1500);
        } else {
            showError(data.message || 'Terjadi kesalahan saat mengupload CV.');
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        }
    })
    .catch(error => {
        showError('Whoops! coba kecilkan ukuran file CV kamu ya.');
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
    });
});

        // Close modals when clicking outside
        document.getElementById('uploadModal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('uploadModal')) {
                closeUploadModal();
            }
        });

        document.getElementById('applicationAlert').addEventListener('click', (e) => {
            if (e.target === document.getElementById('applicationAlert')) {
                closeApplicationAlert();
            }
        });


        //skill section
        document.addEventListener('DOMContentLoaded', function () {
        // Search skill
        const skillSearch = document.getElementById('skillSearch');
        const skillSuggestions = document.getElementById('skillSuggestions');
        const selectedSkillsDiv = document.getElementById('selectedSkills');

        let debounceTimeout = null;

        skillSearch.addEventListener('input', function () {
            clearTimeout(debounceTimeout);
            const query = this.value.trim();
            if (query.length < 2) {
                skillSuggestions.classList.add('hidden');
                return;
            }
            
            debounceTimeout = setTimeout(() => {
                fetch(`{{ route('skills.search') }}?q=${encodeURIComponent(query)}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        skillSuggestions.innerHTML = '';
                        
                        if (data.length === 0) {
                            skillSuggestions.classList.add('hidden');
                            return;
                        }
                        
                        data.forEach(skill => {
                            // Cek apakah sudah dipilih
                            if (selectedSkillsDiv.querySelector(`[data-id="${skill.id}"]`)) return;
                            
                            const btn = document.createElement('button');
                            btn.type = 'button';
                            btn.className = 'block w-full text-left px-3 py-2 hover:bg-blue-100 dark:hover:bg-blue-900';
                            btn.textContent = skill.text || skill.nama;
                            btn.onclick = function () {
                                addSkill(skill.id, skill.text || skill.nama);
                                skillSuggestions.classList.add('hidden');
                                skillSearch.value = '';
                            };
                            skillSuggestions.appendChild(btn);
                        });
                        skillSuggestions.classList.remove('hidden');
                    })
                    .catch(error => {
                        console.error('Error searching skills:', error);
                        skillSuggestions.classList.add('hidden');
                    });
            }, 300);
        });

        // Add skill via AJAX
        function addSkill(skillId, skillNama) {
            fetch('{{ route('profile.skill.add') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ skill_id: skillId })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const span = document.createElement('span');
                    span.className = 'flex items-center bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300';
                    span.setAttribute('data-id', skillId);
                    span.innerHTML = `${skillNama}
                        <button type="button" class="ml-1 text-red-500 hover:text-red-700 focus:outline-none remove-skill-btn" data-id="${skillId}">&times;</button>`;
                    selectedSkillsDiv.appendChild(span);
                    
                    // Reset input
                    skillSearch.value = '';
                } else {
                    alert(data.message || 'Gagal menambahkan skill');
                }
            })
            .catch(error => {
                console.error('Error adding skill:', error);
                alert(error.message || 'Terjadi kesalahan saat menambahkan skill');
            });
        }

        // Remove skill via AJAX
        selectedSkillsDiv.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-skill-btn')) {
                const skillId = e.target.getAttribute('data-id');
                
                fetch('{{ route('profile.skill.remove') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ skill_id: skillId })
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => { throw err; });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        e.target.parentElement.remove();
                    } else {
                        alert(data.message || 'Gagal menghapus skill');
                    }
                })
                .catch(error => {
                    console.error('Error removing skill:', error);
                    alert(error.message || 'Terjadi kesalahan saat menghapus skill');
                });
            }
        });

        // Hide suggestions on blur
        skillSearch.addEventListener('blur', function () {
            setTimeout(() => skillSuggestions.classList.add('hidden'), 200);
        });
    });
    </script>
@endsection