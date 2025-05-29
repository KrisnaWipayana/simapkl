<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanMingguan;
use App\Models\LaporanAkhir;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    // Upload Laporan Mingguan
    public function uploadMingguan(Request $request)
    {
        $request->validate([
            'judul_laporan' => 'required|string|max:255',
            'deskripsi_laporan' => 'required|string',
            'file_laporan' => 'required|file|mimes:pdf,doc,docx|max:2048'
        ]);

        $file = $request->file('file_laporan');
        $path = $file->store('laporan_mingguan');

        LaporanMingguan::create([
            'mahasiswa_id' => Auth::id(),
            'judul_laporan' => $request->judul_laporan,
            'deskripsi_laporan' => $request->deskripsi_laporan,
            'file_laporan' => $path,
            'status_laporan' => 'Menunggu'
        ]);

        return redirect()->back()->with('success', 'Laporan mingguan berhasil diupload!');
    }

    // Upload Laporan Akhir
    public function uploadAkhir(Request $request)
    {
        $request->validate([
            'judul_laporan' => 'required|string|max:255',
            'deskripsi_laporan' => 'required|string',
            'file_laporan' => 'required|file|mimes:pdf,doc,docx|max:5120' // 5MB max
        ]);

        $file = $request->file('file_laporan');
        $path = $file->store('laporan_akhir');

        LaporanAkhir::create([
            'mahasiswa_id' => Auth::id(),
            'judul_laporan' => $request->judul_laporan,
            'deskripsi_laporan' => $request->deskripsi_laporan,
            'file_laporan' => $path,
            'status_laporan' => 'Menunggu'
        ]);

        return redirect()->back()->with('success', 'Laporan akhir berhasil diupload!');
    }

    // Download Laporan
    public function downloadLaporan($id)
    {
        $laporan = LaporanMingguan::findOrFail($id);
        
        // Check if user owns the file
        if ($laporan->mahasiswa_id != Auth::id()) {
            abort(403);
        }

        return Storage::download($laporan->file_laporan);
    }
}