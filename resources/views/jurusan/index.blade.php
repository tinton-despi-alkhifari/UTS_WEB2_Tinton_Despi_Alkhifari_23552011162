@extends('layouts.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4 mt-3">
    <div class="card-header bg-white d-flex justify-content-between pt-4 px-4">
        <h5 class="fw-bold text-dark"><i class="bi bi-building text-primary me-2"></i>Data Program Studi</h5>
        <button class="btn btn-primary rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#addJurusanModal">
            <i class="bi bi-plus-circle me-1"></i> Tambah Jurusan
        </button>
    </div>
    
    <div class="card-body p-4">
        @if(session('success')) 
            <div class="alert alert-success border-0 bg-success text-white rounded-3 shadow-sm py-2 px-3 mb-4"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}</div> 
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th width="5%">No</th><th>Nama Jurusan</th><th width="15%" class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @foreach($jurusans as $index => $j)
                    <tr>
                        <td class="text-muted">{{ $index + 1 }}</td>
                        <td class="fw-semibold">{{ $j->nama_jurusan }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1" data-bs-toggle="modal" data-bs-target="#editJurusanModal{{ $j->id_jurusan }}"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-light text-danger rounded-circle shadow-sm" data-bs-toggle="modal" data-bs-target="#globalDeleteModal" data-url="{{ route('jurusan.destroy', $j->id_jurusan) }}" data-message="Peringatan: Yakin ingin menghapus jurusan <strong>{{ $j->nama_jurusan }}</strong>? Semua data mahasiswa dan matakuliah terkait mungkin ikut terhapus."><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>

                    <div class="modal fade" id="editJurusanModal{{ $j->id_jurusan }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered"><div class="modal-content rounded-4 border-0 shadow">
                            <form action="{{ route('jurusan.update', $j->id_jurusan) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-header border-bottom-0 pb-0"><h5 class="modal-title fw-bold">Edit Jurusan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                <div class="modal-body">
                                    <label class="small text-muted fw-bold mb-1">Nama Jurusan</label>
                                    <input type="text" name="nama_jurusan" class="form-control rounded-3" value="{{ $j->nama_jurusan }}" required>
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

<div class="modal fade" id="addJurusanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered"><div class="modal-content rounded-4 border-0 shadow">
        <form action="{{ route('jurusan.store') }}" method="POST">
            @csrf
            <div class="modal-header border-bottom-0 pb-0"><h5 class="modal-title fw-bold">Tambah Jurusan Baru</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <label class="small text-muted fw-bold mb-1">Nama Jurusan</label>
                <input type="text" name="nama_jurusan" class="form-control rounded-3" placeholder="Contoh: Teknik Informatika" required>
            </div>
            <div class="modal-footer border-top-0 pt-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Data</button>
            </div>
        </form>
    </div></div>
</div>
@endsection