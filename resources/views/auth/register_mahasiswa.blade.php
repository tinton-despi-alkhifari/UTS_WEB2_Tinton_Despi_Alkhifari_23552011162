@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-5">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-md-5">
                <h3 class="fw-bold text-center mb-4">Daftar Mahasiswa</h3>
                <form action="{{ route('register.mahasiswa') }}" method="POST">
                    @csrf
                    <div class="mb-3"><input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required></div>
                    <div class="mb-3"><input type="text" name="username" class="form-control" placeholder="NIM" required></div>
                    <div class="mb-3">
                        <select name="id_jurusan" class="form-select" required>
                            <option value="" disabled selected>Pilih Jurusan</option>
                            @foreach($jurusans as $j) <option value="{{ $j->id_jurusan }}">{{ $j->nama_jurusan }}</option> @endforeach
                        </select>
                    </div>
                    <div class="mb-4"><input type="password" name="password" class="form-control" placeholder="Password" required></div>
                    <button type="submit" class="btn btn-primary w-100 rounded-pill">Daftar Sekarang</button>
                </form>
                <div class="text-center mt-3"><small><a href="{{ route('login') }}">Sudah punya akun? Login</a></small></div>
            </div>
        </div>
    </div>
</div>
@endsection