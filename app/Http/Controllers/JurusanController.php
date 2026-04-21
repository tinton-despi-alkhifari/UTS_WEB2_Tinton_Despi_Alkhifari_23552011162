<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Auth;

class JurusanController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') abort(403);
        
        $jurusans = Jurusan::all();
        return view('jurusan.index', compact('jurusans'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'nama_jurusan' => 'required|string|max:255'
        ]);

        Jurusan::create($request->all());

        return redirect()->back()->with('success', 'Jurusan baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'nama_jurusan' => 'required|string|max:255'
        ]);

        $jurusan = Jurusan::findOrFail($id);
        $jurusan->update($request->all());

        return redirect()->back()->with('success', 'Data jurusan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();

        return redirect()->back()->with('success', 'Jurusan berhasil dihapus permanen!');
    }
}