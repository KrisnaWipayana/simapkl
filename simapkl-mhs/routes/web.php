<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Group dengan prefix 'login'
Route::prefix('login')->group(function () {
        Route::get('/mahasiswa', function () {
            return view('auth.loginMhs');
        })->name('login.mahasiswa');
        Route::post('/mahasiswa', [AuthController::class, 'loginMhs'])
            ->middleware('guest')
            ->name('login.mahasiswa.post');

        Route::get('/dospem', function () {
            return view('auth.loginDospem');
        })->name('login.dospem');

        Route::post('/dospem', [AuthController::class,'loginDospem'])
            ->middleware('guest')
            ->name('login.dospem.post');

        Route::get('/perusahaan', function () {
            return view('auth.loginPerusahaan');
        })->name('login.perusahaan');

        Route::post('/perusahaan', [AuthController::class,'loginPerusahaan'])
            ->middleware('guest')
            ->name('login.perusahaan.post');
    }
);

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