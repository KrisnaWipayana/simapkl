<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    function index(Request $request)
    {
        $mahasiswa = Mahasiswa::all();
        $lowongan = DB::table('lowongans')
        ->join('perusahaans', 'lowongans.perusahaan_id', '=', 'perusahaans.id')
        ->select(
            'lowongans.*',
            'perusahaans.nama as nama_perusahaan',
            'perusahaans.alamat as alamat_perusahaan')
        ->get();

        $mahasiswaId = Auth::guard('mahasiswa')->user()->id;

        $perusahaan = DB::table('perusahaan');

        $laporanMingguan = DB::table('laporan_mingguan')
        ->where('mahasiswa_id', $mahasiswaId)
        ->get();

        
        $laporanAkhir = DB::table('laporan_akhir')->where('mahasiswa_id', $request->session()->get('mahasiswa_id'))->get();
        // $laporanAkhir = DB::table('laporan_akhir')->get();
        $cv = DB::table('cv')->get();

        // Mengembalikan view dengan data mahasiswa
        return view('dashboard.mahasiswa', compact('laporanMingguan', 'laporanAkhir', 'mahasiswa', 'cv', 'lowongan'));
    }

    function lowonganDetails(Request $request) 
    {
        $lowongan = DB::table('lowongans')
        ->join('perusahaans', 'lowongans.perusahaan_id', '=', 'perusahaans.id')
        ->select(
            'lowongans.*',
            'perusahaans.nama as nama_perusahaan',
            'perusahaans.alamat as alamat_perusahaan')
        ->where('lowongans.id', $request->id)
        ->first();

        return view('dashboard.lowongan-details', compact('lowongan'));
    }
}
