@extends('layout.app')
<!-- @include('layout.sidebar') -->
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
                    <button id="closeAlertBtn" class="text-gray-500 dark:text-gray-400">
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
                
                <!-- Search Form -->
                <form action="" method="GET" class="mb-6">
                    <div class="flex flex-col sm:flex-row gap-2">
                        <div class="relative flex-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input 
                                type="search" 
                                name="search" 
                                value="{{ request('search') }}"
                                placeholder="Cari lowongan magang..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:focus:ring-green-400 dark:focus:border-green-400 transition-colors"
                            >
                        </div>
                        <button 
                            type="submit" 
                            class="px-6 py-2 bg-green-600 hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600 text-white font-medium rounded-lg transition-colors duration-200 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 flex items-center gap-2 whitespace-nowrap"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari Lowongan
                        </button>
                    </div>
                    
                    <!-- Search Results Info -->
                    @if(request('search'))
                        <div class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                            <span>Hasil pencarian untuk: </span>
                            <span class="font-semibold text-gray-800 dark:text-gray-200">"{{ request('search') }}"</span>
                            @if(isset($lowongan) && $lowongan->count() > 0)
                                <span class="ml-2 text-green-600 dark:text-green-400">({{ $lowongan->total() }} lowongan ditemukan)</span>
                            @else
                                <span class="ml-2 text-red-600 dark:text-red-400">(Tidak ada lowongan ditemukan)</span>
                            @endif
                            <a href="{{ url()->current() }}" class="ml-3 text-green-600 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300 underline">
                                Hapus filter
                            </a>
                        </div>
                    @endif
                </form>

                <!-- List lowongan -->
                <div x-data="{ show: false, detail: {} }">
                    @if($lowongan->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
                            @foreach ($lowongan as $lwg)
                                <button
                                    @click="show = true; detail = {{ Js::from($lwg) }}"
                                    class="flex flex-col space-y-2 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg shadow hover:shadow-md transition text-left w-full"
                                >
                                    <div>
                                        <h3 class="font-semibold text-base">{{ $lwg->judul }}</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-300 line-clamp-3 mb-1">{{ $lwg->nama_perusahaan }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-300 line-clamp-3 mt-1">{{ $lwg->alamat_perusahaan }}</p>

                                        {{-- Skills section --}}
                                        @if (!empty($skillLowonganMap[$lwg->id]) && count($skillLowonganMap[$lwg->id]) > 0)
                                            <div class="mt-2 flex flex-nowrap overflow-x-auto pb-2 scrollbar-hide">
                                                @foreach ($skillLowonganMap[$lwg->id] as $skill)
                                                    <span class="flex-shrink-0 text-xs font-medium mr-2 px-2.5 py-0.5 rounded bg-green-200 text-green-700 dark:text-green-500 dark:bg-green-900">
                                                        {{ $skill }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <h3 class="mt-4 text-sm font-medium text-gray-900 dark:text-gray-100">Tidak ada lowongan ditemukan</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                @if(request('search'))
                                    Coba gunakan kata kunci yang berbeda atau 
                                    <a href="{{ url()->current() }}" class="text-green-600 hover:text-green-700 underline">hapus filter pencarian</a>
                                @else
                                    Belum ada lowongan magang yang tersedia saat ini.
                                @endif
                            </p>
                        </div>
                    @endif

                    <!-- Pagination -->
                    @if($lowongan->hasPages())
                        <div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                            <!-- Pagination Info -->
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                Menampilkan {{ $lowongan->firstItem() }} - {{ $lowongan->lastItem() }} dari {{ $lowongan->total() }} lowongan
                            </div>
                            
                            <nav class="flex items-center space-x-1" role="navigation" aria-label="Pagination Navigation">
                                {{-- Previous Page Link --}}
                                @if ($lowongan->onFirstPage())
                                    <span class="px-3 py-2 text-sm leading-4 text-gray-400 dark:text-gray-600 cursor-not-allowed">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </span>
                                @else
                                    <a href="{{ $lowongan->previousPageUrl() }}" 
                                    class="px-3 py-2 text-sm leading-4 text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-700 dark:hover:text-gray-200 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($lowongan->getUrlRange(1, $lowongan->lastPage()) as $page => $url)
                                    @if ($page == $lowongan->currentPage())
                                        <span class="px-3 py-2 text-sm leading-4 text-white bg-green-600 dark:bg-green-500 border border-green-600 dark:border-green-500 rounded-md font-medium">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}" 
                                        class="px-3 py-2 text-sm leading-4 text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-700 dark:hover:text-gray-200 transition-colors">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($lowongan->hasMorePages())
                                    <a href="{{ $lowongan->nextPageUrl() }}" 
                                    class="px-3 py-2 text-sm leading-4 text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-700 dark:hover:text-gray-200 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                @else
                                    <span class="px-3 py-2 text-sm leading-4 text-gray-400 dark:text-gray-600 cursor-not-allowed">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </span>
                                @endif
                            </nav>
                        </div>
                    @endif

                    <style>
                        /* For Webkit browsers (Chrome, Safari) */
                        .scrollbar-hide::-webkit-scrollbar {
                            display: none;
                        }

                        /* For Firefox */
                        .scrollbar-hide {
                            scrollbar-width: none;
                        }
                    </style>

                    <!-- Popup -->
                    <div
                        x-show="show"
                        x-transition
                        class="fixed inset-0 z-50 flex items-center justify-center"
                        style="display: none;"
                    >
                        <!-- Blur Layer -->
                        <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" @click="show = false"></div>

                        <!-- Popup Card -->
                        <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-lg w-11/12 max-w-xs sm:max-w-md p-6 z-10">
                            <button
                                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300"
                                @click="show = false"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <h2 class="text-xl font-bold mb-2" x-text="detail.judul"></h2>
                            <p class="text-sm text-gray-500 dark:text-gray-300 mb-1" x-text="detail.nama_perusahaan"></p>
                            <p class="text-sm text-gray-500 dark:text-gray-300 mb-1" x-text="detail.alamat_perusahaan"></p>
                            <hr>
                            <div class="text-sm text-gray-500 dark:text-gray-300 mt-3 mb-1">
                                <span x-text="detail.deskripsi"></span>
                            </div>
                            <a x-bind:href="'/dashboard/mahasiswa/lowongan/' + detail.id">
                                <button class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-md mt-4">
                                    Lamar
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection