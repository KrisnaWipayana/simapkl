<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    function index(Request $request)
    {
        // Mengambil data mahasiswa dari database
        $mahasiswa = Mahasiswa::all();

        // Mengembalikan view dengan data mahasiswa
        return view('dashboard.mahasiswa', compact('mahasiswa'));
    }
}
