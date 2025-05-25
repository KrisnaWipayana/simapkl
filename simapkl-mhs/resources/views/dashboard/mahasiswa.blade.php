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

                        <!-- List lowongan -->
                        <div x-data="{ show: false, detail: {} }">
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
                                                        <span class="flex-shrink-0 bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                                            {{ $skill }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </button>
                                @endforeach
                            </div>

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
        </div>
@endsection
