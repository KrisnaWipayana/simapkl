<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    function index(Request $request)
    {
        // Mengambil data mahasiswa dari database
        $mahasiswa = Mahasiswa::all();
        $laporanMingguan = DB::table('laporan_mingguan')->get();
        $laporanAkhir = DB::table('laporan_akhir')->get();
        $cv = DB::table('cv')->get();

        // Mengembalikan view dengan data mahasiswa
        return view('dashboard.mahasiswa', compact('laporanMingguan', 'laporanAkhir', 'mahasiswa', 'cv'));
    }
}
