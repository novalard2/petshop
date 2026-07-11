@extends('layouts.nice')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-0">
                    <i class="fas fa-users me-2"></i>
                    Master Users
                </h3>
                <small>Kelola seluruh data pengguna.</small>
            </div>
            <a href="{{ route('user.form') }}" class="btn btn-light">
                <i class="bi bi-plus-square-fill"></i>
                Tambah User
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="70">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">
                                {{ $value->name }}
                            </td>
                            <td>
                                {{ $value->email }}
                            </td>
                            <td>
                                @if($value->role == 'admin')
                                    <span class="badge bg-danger text-white">
                                        Admin
                                    </span>
                                @else
                                    <span class="badge bg-success text-white">
                                        User
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('user.form',$value->id) }}"
                                       class="btn btn-warning btn-sm me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if(auth()->id() != $value->id)
                                    <form action="{{ route('user.delete',$value->id) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus user ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="fas fa-users fa-3x text-secondary mb-3"></i>
                                <h5>Belum ada data user.</h5>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection