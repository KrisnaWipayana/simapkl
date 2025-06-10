<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAPKL - REGISTER MAHASISWA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        mint: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .card {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.03);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-mint-50 to-white flex items-center justify-center min-h-screen p-4">
    <div class="bg-white rounded-lg shadow-sm w-full max-w-4xl overflow-hidden">
        <div class="p-8">
            <div class="text-center mb-8">
                {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg> --}}
                <h1 class="text-xl font-normal text-gray-800 mt-4">Daftar Mahasiswa</h1>
            </div>
            
            <form method="POST" action="{{ route('register.mahasiswa.post') }}" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kolom Kiri -->
                    <div class="space-y-4">
                        <!-- NIM -->
                        <div>
                            <input class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500 @error('nim') border-red-500 @enderror" 
                                   type="text" name="nim" placeholder="NIM" value="{{ old('nim') }}" required>
                            @error('nim')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Nama -->
                        <div>
                            <input class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500 @error('nama') border-red-500 @enderror" 
                                   type="text" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
                            @error('nama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <input class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500 @error('email') border-red-500 @enderror" 
                                   type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Jurusan -->
                        <div>
                            <select class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500 @error('jurusan_id') border-red-500 @enderror" 
                                    name="jurusan_id" required>
                                <option value="">Pilih Jurusan</option>
                                @foreach($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                        {{ $jurusan->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jurusan_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Kolom Kanan -->
                    <div class="space-y-4">
                        <!-- Password -->
                        <div>
                            <input class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500 @error('password') border-red-500 @enderror" 
                                   type="password" name="password" placeholder="Password" required>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Konfirmasi Password -->
                        <div>
                            <input class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500" 
                                   type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                        </div>
                        
                        <!-- Program Studi -->
                        <div>
                            <select class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500 @error('prodi_id') border-red-500 @enderror" 
                                    name="prodi_id" required>
                                <option value="">Pilih Program Studi</option>
                                @foreach($prodis as $prodi)
                                    <option value="{{ $prodi->id }}" 
                                            data-jurusan="{{ $prodi->jurusan_id }}"
                                            {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}
                                            style="display: none;">
                                        {{ $prodi->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('prodi_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Foto (Optional) -->
                        {{-- <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil (Opsional)</label>
                            <input class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500 @error('foto') border-red-500 @enderror" 
                                   type="file" name="foto" accept="image/*">
                            @error('foto')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div> --}}
                    </div>
                </div>
                
                <!-- Tombol Submit - Full Width -->
                <div class="mt-8">
                    <button type="submit" class="w-full bg-green-700 text-white hover:bg-green-800 transition-colors duration-200 py-2 px-4 rounded-md">
                        Daftar
                    </button>
                </div>
            </form>
        </div>
        
        <div class="bg-gray-50 px-8 py-4 text-center border-t border-gray-200">
            <p class="text-sm text-gray-600">
                Sudah punya akun? 
                <a href="{{ route('login.mahasiswa') }}" class="text-green-600 hover:text-green-500 font-medium">Login di sini</a>
            </p>
        </div>
        
        <div class="bg-gray-50 px-8 py-4 text-center">
            <a href="{{ route('welcome') }}" class="text-sm text-gray-600 hover:text-blue-500">Kembali</a>
        </div>
    </div>

    <script>
        // Script untuk menampilkan prodi berdasarkan jurusan yang dipilih
        document.addEventListener('DOMContentLoaded', function() {
            const jurusanSelect = document.querySelector('select[name="jurusan_id"]');
            const prodiSelect = document.querySelector('select[name="prodi_id"]');
            const prodiOptions = prodiSelect.querySelectorAll('option[data-jurusan]');

            function updateProdiOptions() {
                const selectedJurusan = jurusanSelect.value;
                
                // Reset prodi selection
                prodiSelect.value = '';
                
                // Hide all prodi options
                prodiOptions.forEach(option => {
                    option.style.display = 'none';
                });
                
                // Show relevant prodi options
                if (selectedJurusan) {
                    prodiOptions.forEach(option => {
                        if (option.getAttribute('data-jurusan') === selectedJurusan) {
                            option.style.display = 'block';
                        }
                    });
                }
            }

            jurusanSelect.addEventListener('change', updateProdiOptions);
            
            // Initialize on page load
            updateProdiOptions();
        });
    </script>
</body>
</html>