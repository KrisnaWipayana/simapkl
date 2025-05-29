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

        $laporanMingguan = DB::table('laporan_mingguan')
            ->where('mahasiswa_id', $mahasiswaId)
            ->get();

        $laporanAkhir = DB::table('laporan_akhir')
            ->where('mahasiswa_id', $mahasiswaId)
            ->get();

        $cv = DB::table('cv')
        ->where('mahasiswa_id', $mahasiswaId)
        ->get();

        return view('dashboard.berkas-mhs', compact('laporanMingguan', 'laporanAkhir', 'cv'));
    }

    // Upload CV
    public function uploadCV(Request $request)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048'
        ]);

        $file = $request->file('cv');
        $path = $file->store('cv');

        CV::create([
            'mahasiswa_id' => Auth::id(),
            'file_cv' => $path
        ]);

        return redirect()->back()->with('success', 'CV berhasil diupload!');
    }

    // Delete CV
    public function deleteCV($id)
    {
        $cv = CV::findOrFail($id);
        
        // Check if user owns the file
        if ($cv->mahasiswa_id != Auth::id()) {
            abort(403);
        }

        Storage::delete($cv->file_cv);
        $cv->delete();

        return redirect()->back()->with('success', 'CV berhasil dihapus!');
    }

    // Download CV
    public function downloadCV($id)
    {
        $cv = CV::findOrFail($id);
        
        // Check if user owns the file
        if ($cv->mahasiswa_id != Auth::id()) {
            abort(403);
        }

        return Storage::download($cv->file_cv);
    }
}