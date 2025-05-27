<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Mahasiswa;
use Database\Seeders\lowongan;
use Database\Seeders\perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use function Laravel\Prompts\select;

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
                'perusahaans.alamat as alamat_perusahaan'
            )
            ->get();

        // Ambil semua skill untuk setiap lowongan
        $skillLowonganMap = [];
        foreach ($lowongan as $lwg) {
            $skills = DB::table('lowongan_skill')
                ->join('skills', 'lowongan_skill.skill_id', '=', 'skills.id')
                ->where('lowongan_skill.lowongan_id', $lwg->id)
                ->pluck('skills.nama');
            $skillLowonganMap[$lwg->id] = $skills;
        }

        $mahasiswaId = Auth::guard('mahasiswa')->user()->id;

        $laporanMingguan = DB::table('laporan_mingguan')
            ->where('mahasiswa_id', $mahasiswaId)
            ->get();

        $laporanAkhir = DB::table('laporan_akhir')->where('mahasiswa_id', $mahasiswaId)->get();
        $cv = DB::table('cv')->get();

        // Kirim $skillLowonganMap ke view
        return view('dashboard.mahasiswa', compact('laporanMingguan', 'laporanAkhir', 'mahasiswa', 'cv', 'lowongan', 'skillLowonganMap'));
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

        $mahasiswaId = Auth::guard('mahasiswa')->user()->id;

        $skillMahasiswa = DB::table('mahasiswa_skill')
        ->join('skills', 'mahasiswa_skill.skill_id', '=', 'skills.id')
        ->where('mahasiswa_skill.mahasiswa_id', $mahasiswaId)
        ->pluck('skills.nama');

        // Ambil skill yang dibutuhkan lowongan
        $skillLowongan = DB::table('lowongan_skill')
        ->join('skills', 'lowongan_skill.skill_id', '=', 'skills.id')
        ->where('lowongan_skill.lowongan_id', $lowongan->id)
        ->pluck('skills.nama');

        return view('dashboard.lowongan-details', compact('lowongan', 'skillMahasiswa', 'skillLowongan'));
    }

    public function profileMahasiswa(Request $request)
{
    $user = Auth::guard('mahasiswa')->user();

    // Ambil data mahasiswa
    $mahasiswa = DB::table('mahasiswas')
        ->where('id', $user->id)
        ->first();

    $mahasiswaId = Auth::guard('mahasiswa')->user()->id;

    // Ambil skill mahasiswa (join ke tabel skills)
    $skills = DB::table('mahasiswa_skill')
        ->join('skills', 'mahasiswa_skill.skill_id', '=', 'skills.id')
        ->where('mahasiswa_skill.mahasiswa_id', $user->id)
        ->select('skills.nama')
        ->get();

    $skillMahasiswa = DB::table('mahasiswa_skill')
        ->join('skills', 'mahasiswa_skill.skill_id', '=', 'skills.id')
        ->where('mahasiswa_skill.mahasiswa_id', $mahasiswaId)
        ->pluck('skills.nama');

    $perusahaan = DB::table('perusahaans')
        ->where('id', $mahasiswa->perusahaan_id)
        ->select('nama as nama_perusahaan')
        ->first();

    $lowongan = DB::table('lowongans')
        ->where('id', $mahasiswa->lowongan_id)
        ->select('judul as nama_lowongan')
        ->first();

    $prodi = DB::table('prodis')
    ->where('id', $mahasiswa->prodi_id)
    ->select('nama as nama_prodi')
    ->first();
        
    $jurusan = DB::table('jurusans')
    ->where('id', $mahasiswa->jurusan_id)
    ->select('nama as nama_jurusan')
    ->first();

    return view('dashboard.profile-mhs', compact('mahasiswa', 'skills', 'prodi', 'jurusan', 'perusahaan', 'lowongan', 'skillMahasiswa'));
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

    public function updateProfile(Request $request)
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:mahasiswas,email,' . $mahasiswa->id,
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        $mahasiswa->nama = $request->nama;
        $mahasiswa->email = $request->email;

        if ($request->hasFile('avatar')) {
            if ($mahasiswa->foto && Storage::exists($mahasiswa->foto)) {
                Storage::delete($mahasiswa->foto);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $mahasiswa->foto = $path;
        }

        $mahasiswa->save();

        return redirect()->back()->with('success', 'Profil & skill berhasil diperbarui.');
    }

    public function addSkill(Request $request)
    {
        $request->validate([
            'skill_id' => 'required|exists:skills,id',
        ]);
        $mahasiswa = Auth::guard('mahasiswa')->user();
        $mahasiswa->skills()->syncWithoutDetaching([$request->skill_id]);
        return response()->json(['success' => true]);
    }

    public function removeSkill(Request $request)
    {
        $request->validate([
            'skill_id' => 'required|exists:skills,id',
        ]);
        $mahasiswa = Auth::guard('mahasiswa')->user();
        $mahasiswa->skills()->detach($request->skill_id);
        return response()->json(['success' => true]);
    }

    public function searchSkills(Request $request)
    {
        $query = $request->input('q');
        $skills = \App\Models\Skill::where('nama', 'like', '%' . $query . '%')->limit(10)->get();
        return response()->json($skills);
    }
}