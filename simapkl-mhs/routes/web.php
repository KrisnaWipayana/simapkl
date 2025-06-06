<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\DospemController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PerusahaanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Group dengan prefix 'login'
Route::prefix('login')->group(
    function () {
        Route::get('/mahasiswa', function () {
            return view('auth.loginMhs');
        })->name('login.mahasiswa');

        Route::post('/mahasiswa', [AuthController::class, 'loginMhs'])
            ->name('login.mahasiswa.post');

        Route::get('/dospem', function () {
            return view('auth.loginDospem');
        })->name('login.dospem');

        Route::post('/dospem', [AuthController::class, 'loginDospem'])
            ->name('login.dospem.post');

        Route::get('/perusahaan', function () {
            return view('auth.loginPerusahaan');
        })->name('login.perusahaan');

        Route::post('/perusahaan', [AuthController::class, 'loginPerusahaan'])
            ->name('login.perusahaan.post');
    }
);

Route::post('/logout/mahasiswa', function () {
    Auth::guard('mahasiswa')->logout();
    return redirect()->route('login.mahasiswa')->with('success', 'Berhasil logout');
})->name('logout.mahasiswa');

Route::post('/logout/dospem', function () {
    Auth::guard('dospem')->logout();
    return redirect()->route('login.dospem')->with('success', 'Berhasil logout');
})->name('logout.dospem');

Route::post('/logout/perusahaan', function () {
    Auth::guard('perusahaan')->logout();
    return redirect()->route('login.perusahaan')->with('success', 'Berhasil logout');
})->name('logout.perusahaan');


Route::prefix('dashboard')->group(
    function () {
        Route::middleware('auth:mahasiswa')->group(function () {
            Route::get('/mahasiswa', [MahasiswaController::class, 'index'])
                ->name('dashboard.mahasiswa');

            Route::get('/mahasiswa/lowongan/{id}', [MahasiswaController::class, 'lowonganDetails'])
                ->name('dashboard.lowongan.details');

            Route::get('/mahasiswa/profile', [MahasiswaController::class, 'profileMahasiswa'])
                ->name('dashboard.profile.mhs');

            Route::put('/mahasiswa/profile', [MahasiswaController::class, 'updateProfile'])
                ->name('profile.update');

            Route::post('/upload-cv', [MahasiswaController::class, 'uploadCV'])
                ->name('cv.upload');

            Route::get('/skills/search', [MahasiswaController::class, 'searchSkills'])
                ->name('skills.search');

            Route::post('/profile/skill/add', [MahasiswaController::class, 'addSkill'])
                ->name('profile.skill.add');

            Route::post('/profile/skill/remove', [MahasiswaController::class, 'removeSkill'])
                ->name('profile.skill.remove');

            Route::get('/dashboard/berkas', [BerkasController::class, 'index'])
                ->name('dashboard.berkas.mhs');

            // Laporan Mingguan
            Route::post('/laporan/mingguan/upload', [LaporanController::class, 'uploadMingguan'])
                ->name('laporan.mingguan.upload');
            Route::delete('/laporan/mingguan/{id}', [LaporanController::class, 'deleteLaporanMingguan'])
                ->name('laporan.mingguan.delete');

            // Laporan Akhir
            Route::post('/laporan/akhir/upload', [LaporanController::class, 'uploadAkhir'])
                ->name('laporan.akhir.upload');
            Route::get('/download/laporan/{id}', [LaporanController::class, 'downloadLaporanAkhir'])
                ->name('laporan.akhir.download');
            Route::delete('/laporan/akhir/{id}', [LaporanController::class, 'deleteLaporanAkhir'])
                ->name('laporan.akhir.delete');
            Route::get('/laporan/akhir/download/{id}', [LaporanController::class, 'downloadLaporanAkhir'])
                ->name('laporan.akhir.download');

            // CV
            Route::delete('/cv/{id}', [BerkasController::class, 'deleteCV'])
                ->name('cv.delete');
            Route::get('/cv/download/{id}', [BerkasController::class, 'downloadCV'])
                ->name('cv.download');

            // Application
            Route::get('/application/form/{lowonganId}', [MahasiswaController::class, 'emailForm'])
                ->name('application.email');
            Route::post('/application/send', [MahasiswaController::class, 'sendEmail'])
                ->name('send.email');
        });

        Route::middleware('auth:dospem')->group(function () {
            Route::get('/dospem', [DospemController::class, 'index'])
                ->name('dashboard.dospem');
        });

        Route::middleware('auth:perusahaan')->group(function () {
            Route::get('/perusahaan', function () {
                return view('dashboard.perusahaan');
            })->name('dashboard.perusahaan');
        });
    }

);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
