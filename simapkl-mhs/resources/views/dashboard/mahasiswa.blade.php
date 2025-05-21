@extends('layout.app')
@include('layout.sidebar')
<title>
    Dashboard - SIMAPKL
</title>

@section('content')
    <div class="flex-1 overflow-auto p-4">
                <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                    <!-- Welcome alert -->
                    <div id="alert" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 transition-all duration-500 ease-in-out transform translate-y-0 opacity-100">
                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-sans font-semibold">Selamat datang kembali, {{ Auth::guard('mahasiswa')->user()->nama }}!</h2>
                            <button id = "closeAlertBtn" class="text-gray-500 dark:text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-sm font-sans">Persiapkan data kamu sebelum melamar magang ya.</p>
                    </div>

                    <!-- Rekomendasi Lokasi Magang -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold">Rekomendasi lowongan magang buat kamu!</h2>
                        </div>

                        <!-- Job Listings -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($lowongan as $lwg)
                                <a href="{{ route('dashboard.lowongan.details', $lwg->id) }}"
                                class="flex flex-col space-y-2 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg shadow hover:shadow-md transition">
                                    <div>
                                        <h3 class="font-semibold text-base">{{ $lwg->judul }}</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-300 line-clamp-3">{{ $lwg->nama_perusahaan }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-300 line-clamp-3">{{ $lwg->deskripsi }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
