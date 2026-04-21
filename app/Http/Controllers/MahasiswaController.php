<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $mahasiswas = Mahasiswa::with('jurusan')->get();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim|unique:users,username',
            'nama' => 'required|string|max:255',
            'id_jurusan' => 'required',
            'password' => 'required|string|min:4'
        ]);

        // 1. Simpan ke tabel Users agar bisa Login
        User::create([
            'name' => $request->nama,
            'username' => $request->nim,
            'password' => $request->password,
            'role' => 'mahasiswa'
        ]);

        // 2. Simpan ke tabel Mahasiswas untuk data akademik
        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'id_jurusan' => $request->id_jurusan,
            'password' => $request->password,
            'role' => 'mahasiswa'
        ]);

        return redirect()->back()->with('success', 'Data mahasiswa dan akun login berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'nama' => 'required|string|max:255',
            'id_jurusan' => 'required',
            'password' => 'required|string|min:4'
        ]);

        $mhs = Mahasiswa::findOrFail($id);
        
        // 1. Update data akademik
        $mhs->update([
            'nama' => $request->nama,
            'id_jurusan' => $request->id_jurusan,
            'password' => $request->password
        ]);

        // 2. Update data login di tabel Users
        User::where('username', $mhs->nim)->update([
            'name' => $request->nama,
            'password' => $request->password
        ]);

        return redirect()->back()->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $mhs = Mahasiswa::findOrFail($id);
        $nim = $mhs->nim; // Simpan NIM sebelum dihapus

        // 1. Hapus data akademik (Ini juga otomatis hapus KRS berkat onDelete Cascade)
        $mhs->delete();

        // 2. Hapus akun login-nya
        User::where('username', $nim)->delete();

        return redirect()->back()->with('success', 'Data mahasiswa dan seluruh riwayatnya berhasil dihapus permanen!');
    }
}