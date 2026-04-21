<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm() { return view('auth.login'); }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if ($request->login_type == 'mahasiswa') {
            $user = User::where('username', $username)->where('password', $password)->where('role', 'mahasiswa')->first();
        } else {
            $user = User::where('username', $username)->where('password', $password)->whereIn('role', ['admin', 'user', 'user'])->first();
        }

        if ($user) {
            Auth::login($user);
            return redirect()->route('home');
        }
        return back()->with('error', 'Kredensial tidak ditemukan, salah role, atau password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // --- REGISTRASI MAHASISWA ---
    public function showRegisterMahasiswa()
    {
        $jurusans = \App\Models\Jurusan::all();
        return view('auth.register_mahasiswa', compact('jurusans'));
    }

    public function registerMahasiswa(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'id_jurusan' => 'required',
            'password' => 'required|string|min:4',
        ], ['username.unique' => 'NIM ini sudah terdaftar.']);

        User::create(['name' => $request->name, 'username' => $request->username, 'password' => $request->password, 'role' => 'mahasiswa']);
        \App\Models\Mahasiswa::create(['nim' => $request->username, 'nama' => $request->name, 'id_jurusan' => $request->id_jurusan, 'password' => $request->password, 'role' => 'mahasiswa']);

        return redirect()->route('login')->with('success', 'Akun Mahasiswa berhasil dibuat!');
    }

    // --- REGISTRASI USER UMUM ---
    public function showRegisterUser() { return view('auth.register_user'); }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:4',
        ], ['username.unique' => 'Username ini sudah digunakan.']);

        User::create(['name' => $request->name, 'username' => $request->username, 'password' => $request->password, 'role' => 'user']);
        return redirect()->route('login')->with('success', 'Akun User Umum berhasil dibuat!');
    }
}