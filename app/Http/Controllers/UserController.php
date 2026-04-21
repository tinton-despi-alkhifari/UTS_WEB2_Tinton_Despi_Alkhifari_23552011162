<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') abort(403);
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') abort(403);
        $user = User::findOrFail($id);
        $user->update(['username' => $request->username, 'password' => $request->password, 'role' => $request->role]);
        return redirect()->back()->with('success', 'Data kredensial pengguna berhasil diperbarui!');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') abort(403);
        $user = User::findOrFail($id);
        
        if ($user->role == 'mahasiswa') {
            \App\Models\Mahasiswa::where('nim', $user->username)->delete();
        }
        $user->delete();
        return redirect()->back()->with('success', 'Akun User beserta data terkaitnya berhasil dihapus!');
    }
}