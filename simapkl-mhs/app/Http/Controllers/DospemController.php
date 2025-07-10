<?php

namespace App\Http\Controllers;

use App\Models\Dospem;
use App\Models\Mahasiswa;
use App\Models\LaporanAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\LaporanRevisiNotification;

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

    public function dosenProfile(Request $request)
    {
        $user = Auth::guard('dospem')->user();
        // Ambil data dospem
        $dospem = DB::table('dospems')
            ->where('id', $user->id)
            ->first();

        $dospemId = Auth::guard('dospem')->user()->id;

        return view('dashboard.profile-dsn', compact('dospem'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::guard('dospem')->user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:dospems,email,' . $user->id,
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Ambil model Mahasiswa berdasarkan id user
        $dospem = \App\Models\Dospem::findOrFail($user->id);

        $dospem->nama = $request->nama;
        $dospem->email = $request->email;

        if ($request->hasFile('foto')) {
            if ($dospem->foto && Storage::exists($dospem->foto)) {
                Storage::delete($dospem->foto);
            }
            $path = $request->file('foto')->store('avatars', 'public');
            $dospem->foto = $path;
        }

        $dospem->save();

        return redirect()->back()->with('success', 'Profil & skill berhasil diperbarui.');
    }

    public function mahasiswaDetail(Request $request)
    {
        $mahasiswa = DB::table('mahasiswas')
            ->leftjoin('laporan_mingguans', 'mahasiswas.id', '=', 'laporan_mingguans.mahasiswa_id')
            ->leftjoin('laporan_akhirs', 'mahasiswas.id', '=', 'laporan_akhirs.mahasiswa_id')
            ->leftjoin('prodis', 'mahasiswas.prodi_id', '=', 'prodis.id')
            ->leftjoin('jurusans', 'mahasiswas.jurusan_id', '=', 'jurusans.id')
            ->leftjoin('perusahaans', 'mahasiswas.perusahaan_id', '=', 'perusahaans.id')
            ->leftjoin('lowongans', 'mahasiswas.lowongan_id', '=', 'lowongans.id')
            ->select(
                'mahasiswas.*',
                'laporan_mingguans.judul_laporan as judul_laporanMingguan',
                'laporan_akhirs.judul_laporan as judul_laporanAkhir',
                'laporan_mingguans.status_laporan as status_laporanMingguan',
                'laporan_akhirs.status_laporan as status_laporanAkhir',
                'prodis.nama as nama_prodi',
                'jurusans.nama as nama_jurusan',
                'perusahaans.nama as nama_perusahaan',
                'lowongans.judul as nama_lowongan',
            )
            ->where('mahasiswas.id', $request->id)
            ->first();

        $laporanMingguan = DB::table('laporan_mingguans')
            ->select('laporan_mingguans.*')
            ->where('mahasiswa_id', $request->id)
            ->get();

        $laporanAkhir = DB::table('laporan_akhirs')
            ->select('laporan_akhirs.*')
            ->where('mahasiswa_id', $request->id)
            ->get();

        return view('dashboard.mahasiswa-detail', compact('mahasiswa', 'laporanMingguan', 'laporanAkhir'));
    }

    public function updateStatusLaporan(Request $request, $id)
    {
        \Log::info('UpdateStatus Request:', [
            'id' => $id,
            'status' => $request->status,
            'user' => auth()->user()?->id
        ]);

        try {
            $request->validate(['status' => 'required|in:Diterima,Menunggu,Revisi']);

            $laporan = LaporanAkhir::findOrFail($id);
            $laporan->status_laporan = $request->status;
            $laporan->save();

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Laporan not found'
            ], 404);
            
        } catch (\Exception $e) {
            \Log::error("UpdateStatus Error: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Server error',
                'error' => env('APP_DEBUG') ? $e->getMessage() : null
            ], 500);
        }
    }
    
    public function downloadLaporanAkhir($id)
    {
        $laporan = LaporanAkhir::findOrFail($id);
        
        // Pastikan nama kolom sesuai database
        $filename = $laporan->file_laporan; // atau nama kolom yang sesuai
        
        $filePath = storage_path('app/public/laporanAkhir/' . $filename);
        
        // Debugging - tambahkan ini sementara
        if (!file_exists($filePath)) {
            \Log::error("File not found: " . $filePath);
            abort(404, 'File tidak ditemukan di: ' . $filePath);
        }
        
        return response()->download($filePath);
    }

    public function sendRevisi(Request $request, $laporanId)
    {
        \Log::info('Upload Revisi Request:', $request->all());
        
        try {
            // 1. Validasi File Revisi
            $request->validate([
                'revisi_file' => 'required|file|mimes:pdf,doc,docx|max:10240',
            ]);

            // 2. Dapatkan data dosen pembimbing yang login
            $dospem = Auth::guard('dospem')->user();
            if (!$dospem) {
                throw new \Exception('Sesi dosen pembimbing tidak valid');
            }

            // 3. Cari Data Laporan
            $laporan = LaporanAkhir::with(['mahasiswa' => function($query) {
                $query->select('id', 'nama', 'email'); // Pastikan kolom email ada
            }])->findOrFail($laporanId);

            if (!$laporan->mahasiswa) {
                throw new \Exception('Data mahasiswa tidak ditemukan');
            }

            if (empty($laporan->mahasiswa->email)) {
                throw new \Exception('Email mahasiswa tidak tersedia');
            }

            // 4. Simpan File Revisi
            $originalName = $request->file('revisi_file')->getClientOriginalName();
            $filename = time() . '_revisi_' . $originalName;
            
            $path = $request->file('revisi_file')->storeAs(
                'laporan_revisi', 
                $filename, 
                'public'
            );

            // 5. Update database
            $laporan->file_revisi = $filename;
            $laporan->status_laporan = 'Revisi';
            $laporan->save();

            // 6. Kirim Email dengan logging detail
            \Log::info('Mengirim email ke: ' . $laporan->mahasiswa->email);
            
            Mail::to($laporan->mahasiswa->email)
                ->cc($dospem->email)
                ->send(new LaporanRevisiNotification($laporan));

            \Log::info('Email berhasil dikirim');

            return response()->json([
                'success' => true, 
                'message' => 'File revisi berhasil diunggah dan email terkirim'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Error sendRevisi: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'trace' => config('app.debug') ? $e->getTrace() : null
            ], 500);
        }
    }
}