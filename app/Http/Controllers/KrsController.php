<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\Auth;

class KrsController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::where('nim', Auth::user()->username)->first();
        if (!$mahasiswa) return redirect()->route('home')->with('error', 'Data akademik mahasiswa tidak ditemukan!');

        $matakuliah_tersedia = Matakuliah::where('id_jurusan', $mahasiswa->id_jurusan)->get();
        $matakuliah_diambil = $mahasiswa->matakuliah->pluck('id_matakuliah')->toArray();

        return view('krs.index', compact('mahasiswa', 'matakuliah_tersedia', 'matakuliah_diambil'));
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::where('nim', Auth::user()->username)->first();
        $mahasiswa->matakuliah()->sync($request->matakuliah);
        return redirect()->back()->with('success', 'KRS berhasil diperbarui!');
    }
}