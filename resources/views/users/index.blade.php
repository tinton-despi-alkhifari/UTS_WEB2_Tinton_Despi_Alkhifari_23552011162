@extends('layouts.app')
@section('content')
<div class="card border-0 shadow-sm rounded-4 mt-3">
    <div class="card-header bg-white pt-4 px-4"><h5 class="fw-bold text-dark">Manajemen Akun Pengguna</h5></div>
    <div class="card-body p-4">
        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        <table class="table table-hover">
            <thead class="table-light">
                <tr><th>No</th><th>Nama</th><th>Username/NIM</th><th>Password</th><th>Role</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @foreach($users as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td><td>{{ $item->name }}</td><td>{{ $item->username }}</td><td>{{ $item->password }}</td><td>{{ $item->role }}</td>
                    <td>
                        <button class="btn btn-sm btn-light text-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}"><i class="bi bi-pencil"></i></button>
                        @if(Auth::user()->id !== $item->id)
                            <button class="btn btn-sm btn-light text-danger rounded-circle" data-bs-toggle="modal" data-bs-target="#globalDeleteModal" data-url="{{ route('users.destroy', $item->id) }}"><i class="bi bi-trash"></i></button>
                        @endif
                    </td>
                </tr>

                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header"><h5 class="modal-title">Edit User</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                            <form action="{{ route('users.update', $item->id) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-body">
                                    <select name="role" class="form-select mb-3">
                                        <option value="admin" {{ $item->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="mahasiswa" {{ $item->role == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                        <option value="user" {{ $item->role == 'user' ? 'selected' : '' }}>User</option>
                                    </select>
                                    <input type="text" name="username" class="form-control mb-3" value="{{ $item->username }}" required>
                                    <input type="text" name="password" class="form-control" value="{{ $item->password }}" required>
                                </div>
                                <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection