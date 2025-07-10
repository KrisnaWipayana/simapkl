<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
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
    public function searchPerusahaan(Request $request)
    {
        $query = $request->input('q');
        
        $results = Perusahaan::query()
            ->when($query, function($q) use ($query) {
                return $q->where('nama', 'like', "%$query%")
                    ->orWhere('alamat', 'like', "%$query%");
            })
            ->limit(10)
            ->get(['id', 'nama', 'alamat']);

        return response()->json($results);
    }

    public function searchLowongan(Request $request)
    {
        $query = $request->input('q');
        $perusahaanId = $request->input('perusahaan_id');

        $results = Lowongan::query()
            ->where('perusahaan_id', $perusahaanId)
            ->when($query, function($q) use ($query) {
                return $q->where('judul', 'like', "%$query%");
            })
            ->limit(10)
            ->get(['id', 'judul',]);

        return response()->json($results);
    }
}
