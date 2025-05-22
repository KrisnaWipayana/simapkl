<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    public function uploadCV(Request $request)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf,doc,docx|max:10240', // 10MB max
        ]); 

        $user = Auth::guard('mahasiswa')->user();

        // Delete old CV if exists
        if ($user->cv) {
            Storage::delete('public/cvs/' . $user->cv->file_cv);
        }

        // Store new CV
        $file = $request->file('cv');
        $fileName = 'cv_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('public/cvs', $fileName);

        // Update or create CV record
        $user->cv()->updateOrCreate(
            ['mahasiswa_id' => $user->id],
            ['file_cv' => $fileName]
        );

        return response()->json(['success' => true, 'message' => 'CV berhasil diupload!']);
    }
}
