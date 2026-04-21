@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8 text-center">
        <h1 class="fw-bold text-primary">Selamat Datang, {{ Auth::user()->name }}!</h1>
        <p class="text-muted fs-5">Anda login sebagai: <span class="badge bg-secondary">{{ strtoupper(Auth::user()->role) }}</span></p>
        <p>Silakan gunakan menu navigasi di atas untuk menggunakan fitur sistem akademik.</p>
    </div>
</div>
@endsection