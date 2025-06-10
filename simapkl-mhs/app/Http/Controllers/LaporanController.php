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
        ]);

        LaporanMingguan::create([
            'mahasiswa_id' => Auth::id(),
            'judul_laporan' => $request->judul_laporan,
            'deskripsi_laporan' => $request->deskripsi_laporan,
            'status_laporan' => 'Menunggu'
        ]);

        return redirect()->back()->with('success', 'Laporan mingguan berhasil diupload!');
    }

    // Delete Laporan Mingguan
    public function deleteLaporanMingguan($id)
    {
        $LaporanMingguan = LaporanMingguan::findOrFail($id);

        // Pastikan hanya pemilik file yang dapat menghapus
        if ($LaporanMingguan->mahasiswa_id != Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus laporan ini.');
        }

        // Hapus data dari database
        $LaporanMingguan->delete();

        return redirect()->back()->with('success', 'Laporan mingguan berhasil dihapus!');
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
        $fileName = 'Laporan _ ' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('laporanAkhir', $fileName, 'public');

        LaporanAkhir::create([
            'mahasiswa_id' => Auth::id(),
            'judul_laporan' => $request->judul_laporan,
            'deskripsi_laporan' => $request->deskripsi_laporan,
            'file_laporan' => $fileName,
            'status_laporan' => 'Menunggu'
        ]);

        return redirect()->back()->with('success', 'Laporan akhir berhasil diupload!');
    }

    // Download Laporan
    public function downloadLaporanAkhir($id)
    {
        $laporanAkhir = LaporanAkhir::findOrFail($id);

        // Check if user owns the file
        if ($laporanAkhir->mahasiswa_id != Auth::id()) {
            abort(403);
        }

        $filePath = storage_path('app/public/laporanAkhir/' . $laporanAkhir->file_laporan); // Fixed field name

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($filePath);
    }

    // Delete Laporan Akhir
    public function deleteLaporanAkhir($id)
    {
        $laporanAkhir = LaporanAkhir::findOrFail($id);

        // Pastikan hanya pemilik file yang dapat menghapus
        if ($laporanAkhir->mahasiswa_id != Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus laporan ini.');
        }

        // Hapus file dari storage
        if ($laporanAkhir->file_laporan && Storage::exists('public/laporanAkhir/' . $laporanAkhir->file_laporan)) {
            Storage::delete('public/laporanAkhir/' . $laporanAkhir->file_laporan);
        }

        // Hapus data dari database
        $laporanAkhir->delete();

        return redirect()->back()->with('success', 'Laporan mingguan berhasil dihapus!');
    }
}
