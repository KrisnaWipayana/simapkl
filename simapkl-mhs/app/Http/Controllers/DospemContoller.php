<?php

namespace App\Http\Controllers;

use App\Models\Dospem;
use Illuminate\Http\Request;

class DospemContoller extends Controller
{
    function index(Request $request)
    {
        // Mengambil data mahasiswa dari database
        $dospem = Dospem::all();

        // Mengembalikan view dengan data mahasiswa
        return view('dashboard.dospem', compact('dospem'));
    }
}
