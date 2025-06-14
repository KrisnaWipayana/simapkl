<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: false }" x-init="darkMode = (window.matchMedia('(prefers-color-scheme: dark)').matches);" :class="darkMode ? 'dark' : ''">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Manajemen PKL Politeknik Negeri Bali - Memudahkan proses Praktik Kerja Lapangan untuk mahasiswa dan dosen">
    <title>SIMAPKL - Jurusan Teknologi Informasi</title>
    <link rel="icon" href="https://www.pnb.ac.id/img/logo-pnb.3aae610b.png" sizes="32x32">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fade-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .animate-fade-left {
            animation: fadeInLeft 0.8s ease-out forwards;
        }

        .animate-fade-right {
            animation: fadeInRight 0.8s ease-out forwards;
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #059669, #10b981, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-white dark:bg-gray-900 text-gray-800 dark:text-white transition-all duration-500">

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <img src="https://www.pnb.ac.id/img/logo-pnb.3aae610b.png" 
                         alt="Logo PNB" 
                         class="h-8 w-auto">
                    <div class="hidden md:block">
                        <h1 class="text-lg font-semibold text-gray-900 dark:text-white">SIMAPKL</h1>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Politeknik Negeri Bali</p>
                    </div>
                </div>
                
                {{-- <div class="flex items-center space-x-4">
                    <button @click="darkMode = !darkMode" 
                            class="p-2 rounded-lg bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                        <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </button>
                </div> --}}
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-24 pb-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Image Section -->
                <div class="order-2 lg:order-1 animate-fade-left">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-green-400 to-emerald-500 rounded-3xl transform rotate-3 opacity-20"></div>
                        <div class="relative bg-gray-100 dark:bg-gray-800 rounded-3xl p-8 h-96 flex items-center justify-center">
                            <!-- Placeholder untuk gambar -->
                            <div class="text-center">
                                <svg class="w-24 h-24 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">Tempat untuk gambar PKL</p>
                                <p class="text-sm text-gray-400 dark:text-gray-500 mt-2">Ukuran yang disarankan: 800x600px</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="order-1 lg:order-2 animate-fade-right">
                    <div class="space-y-6">
                        <div>
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                                <span class="gradient-text">Sistem</span><br>
                                <span class="text-gray-900 dark:text-white">Manajemen</span><br>
                                <span class="gradient-text">PKL</span>
                            </h1>
                        </div>
                        
                        <div class="space-y-4">
                            <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                                Platform digital terpadu untuk mengelola seluruh proses Praktik Kerja Lapangan 
                                Jurusan Teknologi Informasi Politeknik Negeri Bali.
                            </p>
                            
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3">
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    <p class="text-gray-600 dark:text-gray-300">Pendaftaran dan monitoring PKL real-time</p>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    <p class="text-gray-600 dark:text-gray-300">Komunikasi terintegrasi mahasiswa-dosen</p>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    <p class="text-gray-600 dark:text-gray-300">Manajemen dokumen dan laporan digital</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 pt-6">
                            <a href="{{route('login.mahasiswa')}}" class="inline-flex items-center justify-center px-8 py-3 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Login Mahasiswa
                            </a>
                            
                            <a href="{{route('login.dospem')}}" class="inline-flex items-center justify-center px-8 py-3 bg-transparent hover:bg-green-50 dark:hover:bg-gray-800 text-green-600 dark:text-green-400 font-semibold rounded-xl border-2 border-green-500 transition-all duration-300 transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                Login Dosen
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 animate-fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    Fitur <span class="gradient-text">Unggulan</span>
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Solusi lengkap untuk mengelola PKL dengan efisien dan modern
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="card-hover bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-sm animate-fade-up" style="animation-delay: 0.1s">
                    <div class="w-14 h-14 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                        Pendaftaran Cepat
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        Proses pendaftaran PKL yang mudah dan cepat dengan antarmuka yang intuitif
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="card-hover bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-sm animate-fade-up" style="animation-delay: 0.2s">
                    <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                        Dashboard Monitoring
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        Pantau progress PKL secara real-time dengan dashboard yang informatif
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="card-hover bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-sm animate-fade-up" style="animation-delay: 0.3s">
                    <div class="w-14 h-14 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                        Manajemen Dokumen
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        Upload, kelola, dan akses semua dokumen PKL dalam satu platform terintegrasi
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="animate-fade-up" style="animation-delay: 0.1s">
                    <div class="text-3xl md:text-4xl font-bold gradient-text mb-2">1250+</div>
                    <p class="text-gray-600 dark:text-gray-300">Mahasiswa Aktif</p>
                </div>
                <div class="animate-fade-up" style="animation-delay: 0.2s">
                    <div class="text-3xl md:text-4xl font-bold gradient-text mb-2">85+</div>
                    <p class="text-gray-600 dark:text-gray-300">Dosen Pembimbing</p>
                </div>
                <div class="animate-fade-up" style="animation-delay: 0.3s">
                    <div class="text-3xl md:text-4xl font-bold gradient-text mb-2">200+</div>
                    <p class="text-gray-600 dark:text-gray-300">Perusahaan Mitra</p>
                </div>
                <div class="animate-fade-up" style="animation-delay: 0.4s">
                    <div class="text-3xl md:text-4xl font-bold gradient-text mb-2">98%</div>
                    <p class="text-gray-600 dark:text-gray-300">Tingkat Kepuasan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 dark:bg-gray-950 text-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Logo & Description -->
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="https://www.pnb.ac.id/img/logo-pnb.3aae610b.png" 
                             alt="Logo PNB" 
                             class="h-10 w-auto">
                        <div>
                            <h3 class="text-xl font-bold">SIMAPKL</h3>
                            <p class="text-sm text-gray-400">Sistem Manajemen PKL</p>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4 max-w-md">
                        Platform digital untuk mengelola Praktik Kerja Lapangan 
                        Jurusan Teknologi Informasi Politeknik Negeri Bali.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Login Mahasiswa</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Login Dosen</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Panduan PKL</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-gray-300 text-sm">Jl. Kampus Bukit Jimbaran, Kuta Selatan, Badung</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-300 text-sm">pkl@pnb.ac.id</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-gray-300 text-sm">(0361) 701981</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400 text-sm">
                    © 2024 SIMAPKL - Jurusan Teknologi Informasi Politeknik