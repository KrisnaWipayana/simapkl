@extends('layout.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-dark-green dark:text-light-green">Laporan Magang Mahasiswa</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-800 rounded shadow">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b dark:border-gray-700 text-left">Laporan</th>
                    <th class="py-2 px-4 border-b dark:border-gray-700 text-left">Deskripsi</th>
                    <th class="py-2 px-4 border-b dark:border-gray-700 text-left">Status Laporan</th>
                    <th class="py-2 px-4 border-b dark:border-gray-700 text-left">Laporan Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporanMingguan as $lpMg)
                    <tr class="hover:bg-green-50 dark:hover:bg-green-900">
                        <td class="py-2 px-4 border-b dark:border-gray-700">{{ $lpMg->judul_laporan }}</td>
                        <td class="py-2 px-4 border-b dark:border-gray-700">{{ $lpMg->deskripsi_laporan }}</td>
                        <td class="py-2 px-4 border-b dark:border-gray-700">{{ $lpMg->status_laporan }}</td>
                        <td class="py-2 px-4 border-b dark:border-gray-700">{{ $lpMg->created_at }}</td>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500 dark:text-gray-400">Belum ada laporan magang.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
<!-- 
    <form action="{{ route('logout.mahasiswa') }}" method="POST">
    @csrf
    <button type="submit">Logout</button> -->