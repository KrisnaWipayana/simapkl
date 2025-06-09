<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa - SIMAPKL</title>
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
</head>
<body class="min-h-full bg-gradient-to-br from-mint-50 to-white">
    <div class="min-h-screen flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <div class="mx-auto h-12 w-12 bg-mint-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="h-6 w-6 text-mint-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Kirim Lamaran</h2>
                <p class="text-sm text-gray-600">Lengkapi form di bawah untuk mengirim lamaran Anda</p>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-mint-100">
                <form action="{{ route('send.email') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-semibold text-gray-700">
                            Email
                        </label>
                        <div class="relative">
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ $email ?? 'mahasiswa@example.com' }}" 
                                readonly 
                                required
                                class="w-full px-4 py-3 border border-mint-200 rounded-xl bg-mint-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-mint-500 focus:border-transparent transition-all duration-200 text-sm"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-mint-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Subject Field -->
                    <div class="space-y-2">
                        <label for="subject" class="block text-sm font-semibold text-gray-700">
                            Subject
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="subject" 
                                name="subject" 
                                value="{{ $subject ?? 'Lamaran Kerja - Posisi Magang' }}" 
                                readonly 
                                required
                                class="w-full px-4 py-3 border border-mint-200 rounded-xl bg-mint-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-mint-500 focus:border-transparent transition-all duration-200 text-sm"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-mint-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- CV Upload Field -->
                    <div class="space-y-2">
                        <label for="cv" class="block text-sm font-semibold text-gray-700">
                            Upload CV
                        </label>
                        <div class="relative">
                            <input 
                                type="file" 
                                id="cv" 
                                name="cv" 
                                accept=".pdf,.doc,.docx"
                                required
                                class="hidden"
                                onchange="updateFileName(this)"
                            >
                            <label 
                                for="cv" 
                                class="w-full px-4 py-3 border border-mint-200 rounded-xl bg-white text-gray-700 hover:bg-mint-50 focus-within:ring-2 focus-within:ring-mint-500 focus-within:border-transparent transition-all duration-200 cursor-pointer flex items-center justify-between text-sm"
                            >
                                <span id="file-label" class="text-gray-500">Pilih file CV (PDF, DOC, DOCX)</span>
                                <svg class="h-5 w-5 text-mint-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                            </label>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">File maksimal 5MB dalam format PDF, DOC, atau DOCX</p>
                    </div>

                    <!-- Content Field -->
                    <div class="space-y-2">
                        <label for="content" class="block text-sm font-semibold text-gray-700">
                            Isi Pesan
                        </label>
                        <textarea 
                            name="email_message" 
                            id="content" 
                            placeholder="Tulis pesan lamaran Anda di sini..." 
                            rows="6" 
                            required
                            class="w-full px-4 py-3 border border-mint-200 rounded-xl text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-mint-500 focus:border-transparent transition-all duration-200 resize-none text-sm"
                        ></textarea>
                        {{-- <p class="text-xs text-gray-500 mt-1">Jelaskan mengapa Anda tertarik dengan posisi ini</p> --}}
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-4">
                        <button 
                            type="submit" 
                            class="flex-1 bg-mint-600 hover:bg-mint-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-mint-500 focus:ring-offset-2 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 text-sm"
                        >
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                <span>Kirim Lamaran</span>
                            </div>
                        </button>
                        
                        <a 
                            href="#" 
                            onclick="history.back()" 
                            class="flex-1 sm:flex-none bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 text-center text-sm"
                        >
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                <span>Kembali</span>
                            </div>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="text-center">
                <p class="text-xs text-gray-500">
                    Pastikan semua informasi yang Anda berikan sudah benar
                </p>
            </div>
        </div>
    </div>

    <script>
        function updateFileName(input) {
            const label = document.getElementById('file-label');
            if (input.files && input.files[0]) {
                const fileName = input.files[0].name;
                const fileSize = (input.files[0].size / 1024 / 1024).toFixed(2);
                label.textContent = `${fileName} (${fileSize} MB)`;
                label.classList.remove('text-gray-500');
                label.classList.add('text-mint-600', 'font-medium');
            } else {
                label.textContent = 'Pilih file CV (PDF, DOC, DOCX)';
                label.classList.remove('text-mint-600', 'font-medium');
                label.classList.add('text-gray-500');
            }
        }
    </script>
</body>
</html>