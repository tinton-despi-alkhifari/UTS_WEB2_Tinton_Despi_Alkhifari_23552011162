<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MahasiswaController;

Route::get('/', function () { return redirect()->route('login'); });

// --- RUTE GUEST (Belum Login) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register/mahasiswa', [AuthController::class, 'showRegisterMahasiswa'])->name('register.mahasiswa');
    Route::post('/register/mahasiswa', [AuthController::class, 'registerMahasiswa']);

    Route::get('/register/user', [AuthController::class, 'showRegisterUser'])->name('register.user');
    Route::post('/register/user', [AuthController::class, 'registerUser']);
});

// --- RUTE AUTH (Sudah Login) ---
Route::middleware('auth')->group(function () {
    Route::get('/home', function () { return view('home'); })->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Matakuliah (Bisa diakses semua, logika dibatasi di dalam controller)
    Route::resource('matakuliah', MatakuliahController::class);

    // Khusus Admin
    Route::resource('users', UserController::class)->except(['create', 'store', 'show']);
    Route::resource('jurusan', JurusanController::class);
    Route::resource('mahasiswa', MahasiswaController::class);

    // Khusus Mahasiswa
    Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');
    Route::post('/krs', [KrsController::class, 'store'])->name('krs.store');
});