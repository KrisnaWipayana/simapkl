@extends('layout.app-dsn')
<title>
    Dashboard - SIMAPKL
</title>

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Dashboard Dosen Pembimbing</h1>
    
    <!-- Statistik Utama -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Mahasiswa Bimbingan -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border-l-4 border-mint-500">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Mahasiswa</p>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mt-1">{{ $totalMahasiswa }}</h3>
                </div>
                <div class="p-3 rounded-lg bg-mint-100 dark:bg-mint-900 text-mint-600 dark:text-mint-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Mahasiswa Aktif PKL -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border-l-4 border-blue-500">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Sedang PKL</p>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mt-1">{{ $sedangPkl }}</h3>
                </div>
                <div class="p-3 rounded-lg bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
            <p class="text-xs text-blue-600 dark:text-blue-400 mt-2">{{ $totalMahasiswa > 0 ? round(($sedangPkl/$totalMahasiswa)*100) : 0 }}% dari total bimbingan</p>
        </div>

        <!-- Mahasiswa Tidak PKL -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border-l-4 border-gray-500">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Tidak PKL</p>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mt-1">{{ $tidakPkl }}</h3>
                </div>
                <div class="p-3 rounded-lg bg-gray-100 dark:bg-gray-900 text-gray-600 dark:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">{{ $totalMahasiswa > 0 ? round(($tidakPkl/$totalMahasiswa)*100) : 0 }}% dari total bimbingan</p>
        </div>
    </div>

    <!-- Daftar Mahasiswa -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Daftar Mahasiswa Bimbingan</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">NIM</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Perusahaan</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($mahasiswaBimbingan as $mhs)
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $mhs->nama }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $mhs->nim }}</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if($mhs->lowongan_id)
                                <span class="px-2 py-1 text-xs rounded-full bg-mint-100 dark:bg-mint-900 text-mint-800 dark:text-mint-200">Sedang PKL</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">Tidak PKL</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $mhs->perusahaan->nama ?? '-' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Aktivitas Terkini -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Aktivitas Terkini</h2>
        <div class="space-y-4">
            @foreach($aktivitasTerkini as $aktivitas)
            <div class="flex items-start">
                <div class="flex-shrink-0 mr-3 mt-1">
                    <div class="p-2 rounded-lg {{ $aktivitas['status'] == 'Sedang PKL' ? 'bg-mint-100 dark:bg-mint-900 text-mint-600 dark:text-mint-300' : 'bg-gray-100 dark:bg-gray-900 text-gray-600 dark:text-gray-300' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-800 dark:text-gray-200">
                        <span class="font-semibold">{{ $aktivitas['mahasiswa'] }}</span> 
                        {{ $aktivitas['status'] == 'Sedang PKL' ? 'sedang melaksanakan PKL di ' . $aktivitas['perusahaan'] : 'belum memiliki lokasi PKL' }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ \Carbon\Carbon::parse($aktivitas['updated_at'])->diffForHumans() }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection