<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Handler
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (!Auth::guard('mahasiswa')->check()) {
            // Redirect ke halaman login jika belum login
            return redirect()->route('welcome');
        }
        return $next($request);
    }
}