<!DOCTYPE html>
<html lang="en" x-data="{ show: false, darkMode: false }" x-init="show = true; darkMode = (window.matchMedia('(prefers-color-scheme: dark)').matches);" :class="darkMode ? 'dark' : ''">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Manajemen PKL Politeknik Negeri Bali - Memudahkan proses Praktik Kerja Lapangan untuk mahasiswa dan dosen">
    <title>SIMAPKL - Jurusan Teknologi Informasi</title>
    <link rel="icon" href="https://www.pnb.ac.id/img/logo-pnb.3aae610b.png" sizes="32x32">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        /* Custom Gradient Colors */
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --mint-gradient: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            --ocean-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        /* Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .glass-dark {
            background: rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Advanced Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            25% { transform: translateY(-10px) rotate(1deg); }
            50% { transform: translateY(-5px) rotate(-1deg); }
            75% { transform: translateY(-15px) rotate(0.5deg); }
        }

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(102, 126, 234, 0.4); }
            50% { box-shadow: 0 0 40px rgba(102, 126, 234, 0.8), 0 0 60px rgba(102, 126, 234, 0.4); }
        }

        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes slide-in-bottom {
            0% { transform: translateY(100px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-pulse-glow { animation: pulse-glow 3s ease-in-out infinite; }
        .animate-gradient { 
            background-size: 300% 300%;
            animation: gradient-shift 8s ease infinite;
        }
        .animate-slide-bottom { animation: slide-in-bottom 0.8s ease-out; }

        /* Hero Background with Particles */
        .hero-bg {
            background: linear-gradient(135deg,rgb(25, 72, 52) 0%,rgb(69, 184, 138) 50%,rgb(14, 199, 98) 100%);
            background-size: 300% 300%;
            animation: gradient-shift 12s ease infinite;
            position: relative;
            overflow: hidden;
        }

        .hero-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 80%, rgba(255,255,255,0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(255,255,255,0.05) 0%, transparent 50%);
            animation: float 20s ease-in-out infinite;
        }

        /* Advanced Card Hover Effects */
        .card-hover {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card-hover:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        /* Neon Text Effect */
        .neon-text {
            text-shadow: 
                0 0 5px rgba(102, 126, 234, 0.8),
                0 0 10px rgba(102, 126, 234, 0.6),
                0 0 15px rgba(102, 126, 234, 0.4),
                0 0 20px rgba(102, 126, 234, 0.2);
        }

        /* Advanced Button Styles */
        .btn-primary {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-secondary {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-secondary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-secondary:hover::before {
            left: 100%;
        }

        /* Parallax Effect */
        .parallax {
            transform: translateZ(0);
            transition: transform 0.3s ease-out;
        }

        /* Morphing Shapes */
        .morphing-blob {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            animation: morph 8s ease-in-out infinite;
        }

        @keyframes morph {
            0%, 100% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
            25% { border-radius: 58% 42% 75% 25% / 76% 46% 54% 24%; }
            50% { border-radius: 50% 50% 33% 67% / 55% 27% 73% 45%; }
            75% { border-radius: 33% 67% 58% 42% / 63% 68% 32% 37%; }
        }

        
        ::-webkit-scrollbar-thumb:hover { background: linear-gradient(135deg, #764ba2, #667eea); }

        /* Responsive typography */
        @media (max-width: 640px) {
            .hero-title { font-size: 2.5rem; }
            .hero-subtitle { font-size: 1.25rem; }
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-white font-sans transition-all duration-500 min-h-screen">

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 py-4 px-6 glass dark:glass-dark transition-all duration-300" 
         x-data="{ scrolled: false }" 
         x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 50)"
         :class="scrolled ? 'py-2' : 'py-4'">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <img src="https://www.pnb.ac.id/img/logo-pnb.3aae610b.png" 
                     alt="Logo PNB" 
                     class="h-10 w-auto transition-all duration-300"
                     :class="scrolled ? 'h-8' : 'h-10'">
                <span class="text-white font-bold text-lg hidden md:inline">
                    Politeknik Negeri Bali
                </span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-bg min-h-screen flex items-center justify-center relative overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-20 left-10 w-20 h-20 bg-white/10 rounded-full animate-float morphing-blob"></div>
            <div class="absolute top-40 right-20 w-16 h-16 bg-white/10 rounded-full animate-float" style="animation-delay: -2s;"></div>
            <div class="absolute bottom-40 left-20 w-24 h-24 bg-white/10 rounded-full animate-float morphing-blob" style="animation-delay: -4s;"></div>
            <div class="absolute bottom-20 right-10 w-12 h-12 bg-white/10 rounded-full animate-float" style="animation-delay: -1s;"></div>
        </div>

        <div class="container mx-auto px-6 pt-20 text-center relative z-10">
            <div x-show="show" 
                 x-transition:enter="transition-all duration-1000 delay-300"
                 x-transition:enter-start="opacity-0 transform scale-95 translate-y-10"
                 x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                 class="max-w-5xl mx-auto">
                
                <h1 class="hero-title text-5xl md:text-7xl font-black text-white mb-6">
                    Sistem Manajemen PKL
                </h1>
                
                <p class="hero-subtitle text-xl md:text-3xl text-white mb-4 font-light">
                    Jurusan Teknologi Informasi
                </p>
                
                <p class="text-lg md:text-xl text-white mb-12 max-w-3xl mx-auto leading-relaxed">
                    Revolusi digital dalam pengelolaan Praktik Kerja Lapangan. 
                    Pengalaman yang seamless, efisien, dan modern untuk masa depan pendidikan.
                </p>
                
                <div class="flex flex-col sm:flex-row justify-center gap-6 mb-16">
                    <a href="{{route('login.mahasiswa')}}">
                    <button class="btn-primary px-10 py-4 text-white bg-green-500 font-bold rounded-2xl shadow-2xl hover:shadow-3xl transform hover:scale-105 transition-all duration-300">
                        <span class="relative z-10 flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Login Mahasiswa</span>
                        </span>
                    </button>
                    </a>
                    
                    <a href="{{route('login.dospem')}}">
                    <button class="btn-secondary px-10 py-4 text-white bg-green-500 font-bold rounded-2xl shadow-2xl hover:shadow-3xl transform hover:scale-105 transition-all duration-300">
                        <span class="flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <span>Login Dosen</span>
                        </span>
                    </button>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 px-6 relative bg-gray-100 overflow-hidden">
        <div class="absolute inset-0 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900"></div>
        
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-2xl font-bold bg-green-500 bg-clip-text text-transparent mb-6">
                    Fitur Unggulan
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    Teknologi terdepan untuk pengalaman PKL yang tak terlupakan
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="card-hover glass dark:glass-dark rounded-3xl p-8 group">
                    <div class="w-16 h-16 mx-auto mb-6 bg-green-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-center mb-4 bg-green-500 bg-clip-text text-transparent">
                        Pendaftaran Instan
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 text-center leading-relaxed">
                        Proses pendaftaran PKL dalam hitungan menit
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="card-hover glass dark:glass-dark rounded-3xl p-8 group">
                    <div class="w-16 h-16 mx-auto mb-6 bg-green-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-center mb-4 bg-green-500 bg-clip-text text-transparent">
                        Cloud Storage
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 text-center leading-relaxed">
                        Upload dan akses dokumen PKL dari mana saja
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="card-hover glass dark:glass-dark rounded-3xl p-8 group">
                    <div class="w-16 h-16 mx-auto mb-6 bg-green-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-center mb-4 bg-green-500 bg-clip-text text-transparent">
                        Analytics Dashboard
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 text-center leading-relaxed">
                        Pantau progress PKL dengan dashboard interaktif dan insights berbasis data
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 px-6 relative overflow-hidden bg-green-500">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    PKL dalam Angka
                </h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center group">
                    <div class="text-5xl md:text-6xl font-black text-white mb-2 group-hover:scale-110 transition-transform duration-300"
                         x-data="{ count: 0, target: 1250 }" 
                         x-init="setTimeout(() => { let interval = setInterval(() => { count += 25; if(count >= target) { count = target; clearInterval(interval); } }, 50); }, 500)"
                         x-text="count + '+'">0</div>
                    <p class="text-white font-semibold">Mahasiswa Aktif</p>
                </div>
                <div class="text-center group">
                    <div class="text-5xl md:text-6xl font-black text-white mb-2 group-hover:scale-110 transition-transform duration-300"
                         x-data="{ count: 0, target: 85 }" 
                         x-init="setTimeout(() => { let interval = setInterval(() => { count += 2; if(count >= target) { count = target; clearInterval(interval); } }, 70); }, 700)"
                         x-text="count + '+'">0</div>
                    <p class="text-white font-semibold">Dosen Pembimbing</p>
                </div>
                <div class="text-center group">
                    <div class="text-5xl md:text-6xl font-black text-white mb-2 group-hover:scale-110 transition-transform duration-300"
                         x-data="{ count: 0, target: 200 }" 
                         x-init="setTimeout(() => { let interval = setInterval(() => { count += 5; if(count >= target) { count = target; clearInterval(interval); } }, 40); }, 900)"
                         x-text="count + '+'">0</div>
                    <p class="text-white font-semibold">Perusahaan Mitra</p>
                </div>
                <div class="text-center group">
                    <div class="text-5xl md:text-6xl font-black text-white mb-2 group-hover:scale-110 transition-transform duration-300"
                         x-data="{ count: 0, target: 98 }" 
                         x-init="setTimeout(() => { let interval = setInterval(() => { count += 1; if(count >= target) { count = target; clearInterval(interval); } }, 60); }, 1100)"
                         x-text="count + '%'">0%</div>
                    <p class="text-white font-semibold">Tingkat Kepuasan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20 px-6 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-2xl font-bold bg-green-500 bg-clip-text text-transparent mb-6">
                    Soon
                </h2>
            </div>

            {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="card-hover glass dark:glass-dark rounded-3xl p-8">
                    <div class="flex items-center mb-6">
                        <img src="https://randomuser.me/api/portraits/women/32.jpg" 
                             alt="Testimoni" 
                             class="w-16 h-16 rounded-full mr-4 border-4 border-gradient-to-r from-blue-400 to-purple-500">
                        <div>
                            <h4 class="font-bold text-lg bg-green-500 bg-clip-text text-transparent">
                                Ni Luh Putu Sari
                            </h4>
                            <p class="text-gray-500 dark:text-gray-400">Teknik Informatika</p>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed mb-4">
                        "Sistem PKL ini benar-benar game changer! Interface-nya intuitif dan fitur real-time monitoring membantu saya tetap on track dengan progress PKL."
                    </p>
                    <div class="flex text-yellow-400">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69 --}}