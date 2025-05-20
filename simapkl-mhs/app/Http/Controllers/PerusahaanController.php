<?php

namespace App\Http\Controllers;

use App\Models\perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    function index(Request $request)
    {
        // Mengambil data mahasiswa dari database
        $perusahaan = Perusahaan::all();

        // Mengembalikan view dengan data mahasiswa
        return view('dashboard.perusahaan', compact('perusahaan'));
    }
}
