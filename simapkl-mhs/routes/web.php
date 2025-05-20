<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DospemContoller;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PerusahaanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
})->name('login')
;

// Group dengan prefix 'login'
Route::prefix('login')->group(function () {
        Route::get('/mahasiswa', function () {
            return view('auth.loginMhs');
        })->name('login.mahasiswa');

        Route::post('/mahasiswa', [AuthController::class, 'loginMhs'])
            ->name('login.mahasiswa.post');

        Route::get('/dospem', function () {
            return view('auth.loginDospem');
        })->name('login.dospem');

        Route::post('/dospem', [AuthController::class,'loginDospem'])
            ->name('login.dospem.post');

        Route::get('/perusahaan', function () {
            return view('auth.loginPerusahaan');
        })->name('login.perusahaan');

        Route::post('/perusahaan', [AuthController::class,'loginPerusahaan'])
            ->name('login.perusahaan.post');
    }
);


// // Mahasiswa only
// Route::middleware(['auth:mahasiswa'])->group(function () {
//     Route::get('/mahasiswa/dashboard', [MahasiswaController ::class, 'index'])
//     ->name('dashboard.mahasiswa');
// });

// // Dosen only
// Route::middleware(['auth:dospem'])->group(function () {
//     Route::get('/dosen/dashboard', [DospemContoller::class, 'index'])
//     ->name('dashboard.dospem');
// });

// // Perusahaan only
// Route::middleware(['auth:perusahaan'])->group(function () {
//     Route::get('/perusahaan/dashboard', [PerusahaanController::class, 'index'])
//     ->name('dashboard.perusahaan');
// });


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


Route::prefix('dashboard')->group(function () {
        Route::middleware('auth:mahasiswa')->group(function () {
            Route::get('/mahasiswa', function () {
                return view('dashboard.mahasiswa');
            })->name('dashboard.mahasiswa');
        });

        Route::middleware('auth:dospem')->group(function () {
            Route::get('/dospem', function () {
                return view('dashboard.dospem');
            })->name('dashboard.dospem');
        });

        Route::middleware('auth:perusahaan')->group(function () {
            Route::get('/perusahaan', function () {
                return view('dashboard.perusahaan');
            })->name('dashboard.perusahaan');
        });
    }

);