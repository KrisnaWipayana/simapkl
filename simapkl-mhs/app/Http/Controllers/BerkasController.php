<?php

namespace App\Http\Controllers;

use App\Models\CV;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BerkasController extends Controller
{
    public function index()
    {

        $mahasiswaId = auth()->guard('mahasiswa')->user()->id;

        $laporanMingguan = DB::table('laporan_mingguans')
            ->where('mahasiswa_id', $mahasiswaId)
            ->get();

        $laporanAkhir = DB::table('laporan_akhirs')
            ->where('mahasiswa_id', $mahasiswaId)
            ->get();

        $cv = DB::table('cvs')
            ->where('mahasiswa_id', $mahasiswaId)
            ->get();

        return view('dashboard.berkas-mhs', compact('laporanMingguan', 'laporanAkhir', 'cv'));
    }

    // Delete CV
    public function deleteCV($id)
    {
        $cv = CV::findOrFail($id);

        // Pastikan hanya pemilik file yang dapat menghapus
        if ($cv->mahasiswa_id != Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus file ini.');
        }

        // Hapus file dari storage
        if ($cv->file_cv && Storage::exists('public/cv/' . $cv->file_cv)) {
            Storage::delete('public/cv/' . $cv->file_cv);
        }

        // Hapus data dari database
        $cv->delete();

        return redirect()->back()->with('success', 'CV berhasil dihapus!');
    }

    public function downloadCV($id)
    {
        $cv = CV::findOrFail($id);

        // Pastikan hanya pemilik file yang dapat mengunduh
        if ($cv->mahasiswa_id != Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk mengunduh file ini.');
        }

        $filePath = 'cv/' . $cv->file_cv;

        // Gunakan disk 'public' untuk periksa file
        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Unduh file dari disk 'public'
        return Storage::disk('public')->download($filePath);
    }
}
