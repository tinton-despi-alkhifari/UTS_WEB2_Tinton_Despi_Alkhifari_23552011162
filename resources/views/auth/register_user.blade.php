@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-5">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-md-5">
                <h3 class="fw-bold text-center mb-4">Daftar User Umum</h3>
                <form action="{{ route('register.user') }}" method="POST">
                    @csrf
                    <div class="mb-3"><input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required></div>
                    <div class="mb-3"><input type="text" name="username" class="form-control" placeholder="Username Pilihan" required></div>
                    <div class="mb-4"><input type="password" name="password" class="form-control" placeholder="Password" required></div>
                    <button type="submit" class="btn btn-dark w-100 rounded-pill">Daftar Sekarang</button>
                </form>
                <div class="text-center mt-3"><small><a href="{{ route('login') }}">Sudah punya akun? Login</a></small></div>
            </div>
        </div>
    </div>
</div>
@endsection