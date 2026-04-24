@extends('layouts.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4 mt-3">
    <div class="card-header bg-white d-flex justify-content-between pt-4 px-4">
        <h5 class="fw-bold text-dark"><i class="bi bi-person-badge text-primary me-2"></i>Data Mahasiswa</h5>
    </div>

    <div class="card-body p-4">
        @if(session('success')) 
            <div class="alert alert-success border-0 bg-success text-white rounded-3 shadow-sm py-2 px-3 mb-4"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}</div> 
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th width="5%">No</th><th>NIM</th><th>Nama Lengkap</th><th>Program Studi</th><th>Password</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @foreach($mahasiswas as $index => $mhs)
                    <tr>
                        <td class="text-muted">{{ $index + 1 }}</td>
                        <td class="text-primary fw-bold">{{ $mhs->nim }}</td>
                        <td class="fw-semibold">{{ $mhs->nama }}</td>
                        <td>{{ $mhs->jurusan->nama_jurusan ?? '-' }}</td>
                        <td><span class="badge bg-light text-dark border px-2 py-1" style="font-family: monospace;">{{ $mhs->password }}</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1" data-bs-toggle="modal" data-bs-target="#editMahasiswaModal{{ $mhs->nim }}"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-light text-danger rounded-circle shadow-sm" data-bs-toggle="modal" data-bs-target="#globalDeleteModal" data-url="{{ route('mahasiswa.destroy', $mhs->nim) }}" data-message="Peringatan: Yakin ingin menghapus data <strong>{{ $mhs->nama }}</strong>? Akun login dan riwayat KRS-nya akan ikut terhapus secara permanen."><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>

                    <div class="modal fade" id="editMahasiswaModal{{ $mhs->nim }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered"><div class="modal-content rounded-4 border-0 shadow">
                            <form action="{{ route('mahasiswa.update', $mhs->nim) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-header border-bottom-0 pb-0"><h5 class="modal-title fw-bold">Edit Mahasiswa</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="small text-muted fw-bold">NIM (Username)</label>
                                        <input type="text" class="form-control rounded-3 bg-light" value="{{ $mhs->nim }}" readonly title="NIM tidak bisa diubah">
                                    </div>
                                    <div class="mb-3">
                                        <label class="small text-muted fw-bold">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control rounded-3" value="{{ $mhs->nama }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="small text-muted fw-bold">Jurusan</label>
                                        <select name="id_jurusan" class="form-select rounded-3" required>
                                            @foreach(\App\Models\Jurusan::all() as $j)
                                                <option value="{{ $j->id_jurusan }}" {{ $mhs->id_jurusan == $j->id_jurusan ? 'selected' : '' }}>{{ $j->nama_jurusan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="small text-muted fw-bold">Password Login</label>
                                        <input type="text" name="password" class="form-control rounded-3" value="{{ $mhs->password }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer border-top-0 pt-0">
                                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan</button>
                                </div>
                            </form>
                        </div></div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
