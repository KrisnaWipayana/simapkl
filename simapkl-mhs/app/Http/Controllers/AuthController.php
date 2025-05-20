<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
 public function showLoginMhs()
    {
        return view('auth.loginMhs');
    }
    
public function showLoginDospem()
    {
        return view('auth.loginDospem');
    }

public function showLoginPerusahaan()
    {
        return view('auth.loginPerusahaan');
    }

 public function loginMhs(Request $request)
    {
        $request->validate([
            'nim'    => 'required|string',
            'password' => 'required|min:6',
        ]);

        $credentials = Mahasiswa::where('nim', $request->nim)->first();

        if (!$credentials || !Hash::check($request->password, $credentials->password)) {
            return back()->with('fail', 'NIM atau Password salah.');
        }

        Auth::guard('mahasiswa')->login($credentials);
        return redirect()->intended('/dashboard/mahasiswa');
    }

 public function loginDospem()
    {
        $credentials = request()->only('nip', 'password');
        
        if (auth()->attempt($credentials)) {
            return redirect()->intended('/dashboard/dospem');
        }

        return back()->withErrors([
            'nip' => 'The provided credentials do not match our records.',
        ]);
    }

 public function loginPerusahaan()
    {
        $credentials = request()->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->intended('/dashboard/perusahaan');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
        {
            auth()->logout();
            return redirect('/');
        }
}