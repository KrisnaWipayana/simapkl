<!-- resources/views/dashboard.blade.php -->
@extends('layout.app')
<title>
    {{ $lowongan->judul }} di {{ $lowongan->nama_perusahaan }}
</title>

@section('content')
    <div class="flex-1 overflow-auto p-4">
                <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                    <!-- Rekomendasi Lokasi Magang -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
                        <div class="flex justify-between items-center p-4">
                            <h1 class="text-3xl font-sans font-semibold">{{$lowongan->judul}}</h1>
                        </div>  
                         
                        <p class="text-sm font-sans p-4">{{$lowongan->deskripsi}}</p>

                    </div>
                </div>
            </div>
        </div>
@endsection
