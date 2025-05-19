<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pengelolaan PKL/Magang</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-blue-600 text-white py-6 shadow-md">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold text-center">SISTEM PENGELOLAAN PKL/MAGANG</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <!-- Deskripsi Sistem -->
            <section class="bg-white rounded-lg shadow-md p-8 mb-12">
                <h2 class="text-2xl font-semibold text-blue-700 mb-4">Selamat Datang</h2>
                <p class="text-gray-700 mb-4">
                    Sistem ini dirancang untuk memfasilitasi pengelolaan Praktik Kerja Lapangan (PKL) atau Magang 
                    bagi mahasiswa, dosen pembimbing, dan mitra perusahaan. Dengan sistem ini, seluruh proses 
                    mulai dari pendaftaran, monitoring, hingga penilaian dapat dilakukan secara terintegrasi.
                </p>
                <p class="text-gray-700">
                    Silakan pilih peran Anda untuk masuk ke sistem:
                </p>
            </section>

            <!-- Login Options -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Mahasiswa -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-105">
                    <div class="bg-blue-500 p-4 text-white">
                        <h3 class="text-xl font-semibold text-center">Mahasiswa</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-6">
                            Akses untuk mahasiswa peserta PKL/Magang. Daftar kegiatan, upload laporan, dan lihat penilaian.
                        </p>
                        <a href="{{ route('login.mahasiswa') }}" 
                           class="block w-full bg-blue-500 hover:bg-blue-600 text-white text-center py-2 px-4 rounded-md transition-colors">
                            Login Mahasiswa
                        </a>
                    </div>
                </div>

                <!-- Dosen Pembimbing -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-105">
                    <div class="bg-green-500 p-4 text-white">
                        <h3 class="text-xl font-semibold text-center">Dosen Pembimbing</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-6">
                            Akses untuk dosen pembimbing. Pantau progress mahasiswa, berikan bimbingan, dan input penilaian.
                        </p>
                        <a href="{{ route('login.dospem') }}" 
                           class="block w-full bg-green-500 hover:bg-green-600 text-white text-center py-2 px-4 rounded-md transition-colors">
                            Login Dospem
                        </a>
                    </div>
                </div>

                <!-- Perusahaan -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-105">
                    <div class="bg-purple-500 p-4 text-white">
                        <h3 class="text-xl font-semibold text-center">Perusahaan</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-6">
                            Akses untuk mitra perusahaan. Kelola mahasiswa magang, berikan tugas, dan input evaluasi.
                        </p>
                        <a href="{{ route('login.perusahaan') }}" 
                           class="block w-full bg-purple-500 hover:bg-purple-600 text-white text-center py-2 px-4 rounded-md transition-colors">
                            Login Perusahaan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Sistem Pengelolaan PKL/Magang. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>