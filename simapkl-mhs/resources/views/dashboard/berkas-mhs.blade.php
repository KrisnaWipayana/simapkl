@extends('layout.app')
<title>Profil Mahasiswa - SIMAPKL</title>

@section('content')
<div class="p-4 min-h-screen">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Berkas Mahasiswa</h1>
        <a href="" class="btn btn-primary">Tambah Berkas</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Nama Berkas</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!--  -->
        </tbody>
    </table>
@endsection