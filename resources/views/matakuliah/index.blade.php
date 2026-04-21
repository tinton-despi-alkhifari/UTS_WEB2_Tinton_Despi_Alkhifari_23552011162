@extends('layouts.app')
@section('content')
<div class="card border-0 shadow-sm rounded-4 mt-3">
    <div class="card-header bg-white d-flex justify-content-between pt-4 px-4">
        <h5 class="fw-bold">Data Mata Kuliah</h5>
        @if(Auth::user()->role == 'admin')
            <button class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#addModal">+ Tambah Matkul</button>
        @endif
    </div>
    <div class="card-body p-4">
        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        <table class="table table-hover">
            <thead class="table-light"><tr><th>No</th><th>Nama Mata Kuliah</th><th>SKS</th><th>Jurusan</th>@if(Auth::user()->role=='admin')<th>Aksi</th>@endif</tr></thead>
            <tbody>
                @foreach($matakuliahs as $index => $mk)
                <tr>
                    <td>{{ $index + 1 }}</td><td>{{ $mk->nama_matakuliah }}</td><td>{{ $mk->sks }}</td><td>{{ $mk->jurusan->nama_jurusan ?? 'Semua' }}</td>
                    @if(Auth::user()->role == 'admin')
                    <td>
                        <button class="btn btn-sm btn-light text-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $mk->id_matakuliah }}"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-sm btn-light text-danger" data-bs-toggle="modal" data-bs-target="#globalDeleteModal" data-url="{{ route('matakuliah.destroy', $mk->id_matakuliah) }}"><i class="bi bi-trash"></i></button>
                    </td>
                    @endif
                </tr>

                @if(Auth::user()->role == 'admin')
                <div class="modal fade" id="editModal{{ $mk->id_matakuliah }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('matakuliah.update', $mk->id_matakuliah) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-body">
                                    <input type="text" name="nama_matakuliah" class="form-control mb-3" value="{{ $mk->nama_matakuliah }}" required>
                                    <input type="number" name="sks" class="form-control mb-3" value="{{ $mk->sks }}" required>
                                    <select name="id_jurusan" class="form-select" required>
                                        @foreach($jurusans as $j) <option value="{{ $j->id_jurusan }}" {{ $mk->id_jurusan == $j->id_jurusan ? 'selected' : '' }}>{{ $j->nama_jurusan }}</option> @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@if(Auth::user()->role == 'admin')
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('matakuliah.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="text" name="nama_matakuliah" class="form-control mb-3" placeholder="Nama Matkul" required>
                    <input type="number" name="sks" class="form-control mb-3" placeholder="SKS" required>
                    <select name="id_jurusan" class="form-select" required>
                        <option value="">Pilih Jurusan</option>
                        @foreach($jurusans as $j) <option value="{{ $j->id_jurusan }}">{{ $j->nama_jurusan }}</option> @endforeach
                    </select>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection