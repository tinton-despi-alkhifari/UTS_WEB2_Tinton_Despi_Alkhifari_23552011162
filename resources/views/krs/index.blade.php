@extends('layouts.app')
@section('content')
<div class="card border-0 shadow-sm rounded-4 mt-4">
    <div class="card-header bg-white pt-4 px-4"><h5 class="fw-bold">Form Pengisian KRS</h5></div>
    <div class="card-body p-4 bg-light">
        <p class="mb-1"><strong>Nama:</strong> {{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})</p>
        <p class="mb-0"><strong>Jurusan:</strong> {{ $mahasiswa->jurusan->nama_jurusan ?? '-' }}</p>
    </div>
    <div class="card-body p-4">
        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        
        <form action="{{ route('krs.store') }}" method="POST">
            @csrf
            <h6 class="fw-bold text-muted mb-3">Pilih Mata Kuliah</h6>
            <div class="list-group mb-4">
                @foreach($matakuliah_tersedia as $mk)
                <label class="list-group-item d-flex gap-3">
                    <input class="form-check-input flex-shrink-0" type="checkbox" name="matakuliah[]" value="{{ $mk->id_matakuliah }}" 
                           {{ in_array($mk->id_matakuliah, $matakuliah_diambil) ? 'checked' : '' }}>
                    <span>
                        <strong>{{ $mk->nama_matakuliah }}</strong>
                        <small class="d-block text-muted">{{ $mk->sks }} SKS</small>
                    </span>
                </label>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary rounded-pill w-100">Simpan KRS</button>
        </form>
    </div>
</div>
@endsection