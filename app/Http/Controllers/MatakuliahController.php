<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;
use App\Models\Mahasiswa;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Auth;

class MatakuliahController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $jurusans = Jurusan::all(); 

        if (in_array($user->role, ['admin', 'user', 'user'])) {
            $matakuliahs = Matakuliah::with('jurusan')->get();
        } elseif ($user->role == 'mahasiswa') {
            $mhs = Mahasiswa::where('nim', $user->username)->first();
            $matakuliahs = $mhs ? $mhs->matakuliah : collect(); 
        } else {
            $matakuliahs = collect();
        }
        return view('matakuliah.index', compact('matakuliahs', 'jurusans'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') abort(403);
        Matakuliah::create($request->all());
        return redirect()->back()->with('success', 'Mata kuliah baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') abort(403);
        Matakuliah::findOrFail($id)->update($request->all());
        return redirect()->back()->with('success', 'Data mata kuliah berhasil diperbarui!');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') abort(403);
        $matkul = Matakuliah::findOrFail($id);
        $matkul->mahasiswa()->detach(); // Putus relasi KRS
        $matkul->delete();
        return redirect()->back()->with('success', 'Mata kuliah berhasil dihapus!');
    }
}