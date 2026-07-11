@extends('layouts.nice')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-0">
                    <i class="fas fa-user-tie me-2"></i>
                    Master Karyawan
                </h3>
                <small>Kelola seluruh data karyawan.</small>
            </div>
            <a href="{{ route('karyawan.form') }}" class="btn btn-light">
                <i class="bi bi-plus-square-fill"></i>
                Tambah Karyawan
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tgl Lahir</th>
                            <th>Gender</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Jabatan</th>
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
                            <td>{{ $value->email }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($value->tgl_lahir)->format('d M Y') }}
                            </td>
                            <td>
                                @if($value->jenis_kelamin == 'Laki-laki')
                                    <span class="badge bg-primary text-white">
                                        Laki-laki
                                    </span>
                                @else
                                    <span class="badge bg-danger text-white">
                                        Perempuan
                                    </span>
                                @endif
                            </td>
                            <td>{{ $value->alamat }}</td>
                            <td>{{ $value->no_hp }}</td>
                            <td>
                                <span class="badge bg-success text-white">
                                    {{ $value->jabatan }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('karyawan.form',$value->id) }}"
                                       class="btn btn-warning btn-sm me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('karyawan.delete',$value->id) }}"
                                          method="POST"
                                          class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data karyawan ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <i class="fas fa-user-tie fa-3x text-secondary mb-3"></i>
                                <h5>Belum ada data karyawan.</h5>
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