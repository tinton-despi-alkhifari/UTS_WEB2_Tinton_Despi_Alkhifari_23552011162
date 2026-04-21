@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-5">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <h3 class="fw-bold mb-1">Masuk ke Sistem</h3>
                    <p class="text-muted small">Silakan pilih peran Anda</p>
                </div>

                @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
                @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

                <ul class="nav nav-pills nav-fill mb-4 bg-light rounded-pill p-1" id="loginTab">
                    <li class="nav-item"><button class="nav-link active rounded-pill fw-bold" data-bs-toggle="tab" data-bs-target="#mhs">Mahasiswa</button></li>
                    <li class="nav-item"><button class="nav-link rounded-pill fw-bold" data-bs-toggle="tab" data-bs-target="#umum">User Umum</button></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="mhs">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf <input type="hidden" name="login_type" value="mahasiswa">
                            <div class="mb-3"><input type="text" name="username" class="form-control" placeholder="NIM" required></div>
                            <div class="mb-4"><input type="password" name="password" class="form-control" placeholder="Password" required></div>
                            <button type="submit" class="btn btn-primary w-100 rounded-pill">Masuk</button>
                        </form>
                        <div class="text-center mt-3"><small><a href="{{ route('register.mahasiswa') }}">Daftar Mahasiswa Baru</a></small></div>
                    </div>
                    <div class="tab-pane fade" id="umum">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf <input type="hidden" name="login_type" value="umum">
                            <div class="mb-3"><input type="text" name="username" class="form-control" placeholder="Username" required></div>
                            <div class="mb-4"><input type="password" name="password" class="form-control" placeholder="Password" required></div>
                            <button type="submit" class="btn btn-dark w-100 rounded-pill">Masuk</button>
                        </form>
                        <div class="text-center mt-3"><small><a href="{{ route('register.user') }}">Daftar User Umum Baru</a></small></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection