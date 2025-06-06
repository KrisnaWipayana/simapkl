<?php

namespace App\Http\Controllers;

use App\Models\Dospem;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DospemController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil dospem yang sedang login
        $dospem = Auth::guard('dospem')->user();
        
        // Mengambil mahasiswa bimbingan
        $mahasiswaBimbingan = $dospem->mahasiswas()
            ->with(['lowongan', 'perusahaan']) // Eager load relasi lowongan dan perusahaan
            ->get();
        
        // Hitung statistik
        $totalMahasiswa = $mahasiswaBimbingan->count();
        $sedangPkl = $mahasiswaBimbingan->where('lowongan_id', '!=', null)->count();
        $tidakPkl = $totalMahasiswa - $sedangPkl;
         
        // Aktivitas terkini (sederhana berdasarkan update terakhir)
        $aktivitasTerkini = $mahasiswaBimbingan->map(function($mhs) {
            return [
                'mahasiswa' => $mhs->nama,
                'status' => $mhs->lowongan_id ? 'Sedang PKL' : 'Tidak PKL',
                'perusahaan' => $mhs->perusahaan->nama ?? '-',
                'updated_at' => $mhs->updated_at,
            ];
        })->sortByDesc('updated_at')->take(5);
        
        return view('dashboard.dospem', compact(
            'mahasiswaBimbingan',
            'totalMahasiswa',
            'sedangPkl',
            'tidakPkl',
            'aktivitasTerkini'
        ));
    }
}