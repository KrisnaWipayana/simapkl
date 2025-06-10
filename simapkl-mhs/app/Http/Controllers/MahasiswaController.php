<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Lowongan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Mail\ApplicationSent;
use App\Models\CV;
use App\Models\Dospem;
use Database\Seeders\perusahaan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

        $laporanMingguan = DB::table('laporan_mingguans')
            ->where('mahasiswa_id', $mahasiswaId)
            ->get();

        $laporanAkhir = DB::table('laporan_akhirs')->where('mahasiswa_id', $mahasiswaId)->get();
        $cv = DB::table('cvs')->get();

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
                'perusahaans.alamat as alamat_perusahaan'
            )
            ->where('lowongans.id', $request->id)
            ->first();

        $mahasiswaId = Auth::guard('mahasiswa')->user()->id;

        $skillMahasiswa = DB::table('mahasiswa_skill')
            ->join('skills', 'mahasiswa_skill.skill_id', '=', 'skills.id')
            ->where('mahasiswa_skill.mahasiswa_id', $mahasiswaId)
            ->pluck('skills.nama', 'skills.id');

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

        $dospem = DB::table('pembimbings')
            ->join('dospems', 'pembimbings.dospem_id', "=", 'dospems.id')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->select('dospems.nama as nama_dospem', 'pembimbings.dospem_id')
            ->first();

        $dosens = Dospem::all();

        return view('dashboard.profile-mhs', compact('mahasiswa', 'skills', 'prodi', 'jurusan', 'perusahaan', 'lowongan', 'skillMahasiswa', 'dospem', 'dosens'));
    }

    public function uploadCV(Request $request)
    {
        try {
            $request->validate([
                'cv' => 'required|file|mimes:pdf,doc,docx|max:10240', // 10MB max
            ]);

            $user = Auth::guard('mahasiswa')->user();
            if (!Auth::guard('mahasiswa')->check()) {
                return response()->json(['success' => false, 'message' => 'Silakan login kembali.'], 401);
            }

            if (!$request->hasFile('cv')) {
                return response()->json(['success' => false, 'message' => 'File tidak ditemukan.'], 400);
            }

            // Delete old CV if exists
            if ($user->cv) {
                Storage::delete('public/cv/' . $user->cv->file_cv);
            }

            // Store new CV
            $file = $request->file('cv');
            $fileName = 'cv_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('cv', $fileName, 'public');

            // Update or create CV record
            $cv = $user->cv()->updateOrCreate(
                ['mahasiswa_id' => $user->id],
                ['file_cv' => $fileName]
            );

            return response()->json(['success' => true, 'message' => 'CV berhasil diupload!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan. Silakan coba lagi.'], 500);
        }
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::guard('mahasiswa')->user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:mahasiswas,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        // Ambil model Mahasiswa berdasarkan id user
        $mahasiswa = \App\Models\Mahasiswa::findOrFail($user->id);

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

    // public function updateStatus(Request $request)
    // {

    //     $user = Auth::guard('mahasiswa')->user();
    //     $lowonganId = $request->input('lowongan_id'); // Pastikan lowongan_id dikirim dari form

    //     DB::table('mahasiswas')
    //         ->where('id', $user->id)
    //         ->update([
    //             'lowongan_id' => $lowonganId,
    //             'perusahaan_id' => DB::table('lowongans')->where('id', $lowonganId)->value('perusahaan_id'),
    //         ]);
    // }

    public function searchSkills(Request $request): JsonResponse
    {
        try {
            $query = $request->input('q');
            $skills = \App\Models\Skill::where('nama', 'like', '%' . $query . '%')
                ->limit(10)
                ->get(['id', 'nama as text']); // Ubah 'nama' menjadi 'text' untuk kompatibilitas select2

            return response()->json($skills);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function addSkill(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'skill_id' => 'required|exists:skills,id',
            ]);

            $mahasiswa = Auth::guard('mahasiswa')->user();

            // Cek apakah skill sudah ada
            if ($mahasiswa->skills()->where('skill_id', $request->skill_id)->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Skill sudah ditambahkan sebelumnya'
                ], 400);
            }

            $mahasiswa->skills()->attach($request->skill_id);

            $skill = \App\Models\Skill::find($request->skill_id);

            return response()->json([
                'success' => true,
                'message' => 'Skill berhasil ditambahkan',
                'skill' => [
                    'id' => $skill->id,
                    'nama' => $skill->nama
                ]
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function removeSkill(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'skill_id' => 'required|exists:skills,id',
            ]);

            $mahasiswa = Auth::guard('mahasiswa')->user();
            $mahasiswa->skills()->detach($request->skill_id);

            return response()->json([
                'success' => true,
                'message' => 'Skill berhasil dihapus'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function emailForm(Request $request, $lowonganId)
    {
        $lowongan = Lowongan::findOrFail($lowonganId);
        $user = Auth::guard('mahasiswa')->user();

        return view('dashboard.application-email', [
            'email' => $user->email,
            'subject' => $lowongan->judul . ' - ' . $user->nama,
            'lowongan' => $lowongan,
        ]);
    }

    public function sendEmail(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string',
            'email_message' => 'required|string',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $cvPath = $request->file('cv')->store('cvs');

        Mail::to('perusahaan@example.com')->send(new ApplicationSent(
            $request->email,
            $request->subject,
            $request->email_message,
            $cvPath
        ));

        return back()->with('success', 'Lamaran berhasil dikirim!');
    }

    public function searchDospem(Request $request): JsonResponse
    {
        try {
            $query = $request->input('q');
            $dospems = Dospem::where('nama', 'like', '%' . $query . '%')
                ->limit(10)
                ->get(['id', 'nama as text', 'nip']);

            return response()->json($dospems);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function assignDospem(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'dospem_id' => 'required|exists:dospems,id',
            ]);

            $mahasiswa = Auth::guard('mahasiswa')->user();

            // Cek apakah sudah ada pembimbing
            $existingPembimbing = DB::table('pembimbings')
                ->where('mahasiswa_id', $mahasiswa->id)
                ->first();

            if ($existingPembimbing) {
                // Update pembimbing yang sudah ada
                DB::table('pembimbings')
                    ->where('id', $existingPembimbing->id)
                    ->update(['dospem_id' => $request->dospem_id]);
            } else {
                // Buat pembimbing baru
                DB::table('pembimbings')->insert([
                    'dospem_id' => $request->dospem_id,
                    'mahasiswa_id' => $mahasiswa->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            $dospem = Dospem::find($request->dospem_id);

            return response()->json([
                'success' => true,
                'message' => 'Dosen pembimbing berhasil ditetapkan',
                'dospem' => [
                    'id' => $dospem->id,
                    'nama' => $dospem->nama,
                    'nip' => $dospem->nip
                ]
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
