<?php

namespace App\Http\Controllers;
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

 public function loginMhs()
    {
        $credentials = request()->only('nim', 'password');

        if (auth('mahasiswa')->attempt($credentials)) {
            return redirect()->intended(route('dashboard.mahasiswa'));
        }

        return back()->withErrors([
            'nim' => 'The provided credentials do not match our records.',
        ]);
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