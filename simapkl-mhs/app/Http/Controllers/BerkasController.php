<?php

namespace App\Http\Controllers;

use App\Models\CV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        if ($cv->mahasiswa_id != Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk mengunduh file ini.');
        }

        $filePath = public_path('storage/cv/' . $cv->file_cv);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($filePath);
    }

    public function uploadCV(Request $request)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $user = Auth::guard('mahasiswa')->user();

        if (!$request->hasFile('cv')) {
            return response()->json(['success' => false, 'message' => 'File tidak ditemukan.'], 400);
        }

        $file = $request->file('cv');
        $fileName = 'cv_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('public/cv', $fileName);

        // Simpan path ke database pada tabel CV
        $cv = new CV();
        $cv->mahasiswa_id = $user->id;
        $cv->file_cv = $fileName;
        $cv->save();

        return response()->json(['success' => true, 'message' => 'CV berhasil diupload!']);
    }
}
