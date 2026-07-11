@extends('layouts.nice')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-0">
                    <i class="fas fa-tags me-2"></i>
                    Master Category
                </h3>
                <small>Kelola seluruh kategori produk.</small>
            </div>
            <a href="{{ route('category.form') }}" class="btn btn-light">
                <i class="bi bi-plus-square-fill"></i>
                Tambah Category
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="70">No</th>
                            <th>Nama Category</th>
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
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('category.form',$value->id) }}"
                                       class="btn btn-warning btn-sm me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('category.delete',$value->id) }}"
                                          method="POST"
                                          class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            onclick="return confirm('Yakin ingin menghapus category ini?')"
                                            class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5">
                                <i class="fas fa-folder-open fa-3x text-secondary mb-3"></i>
                                <h5>Belum ada category.</h5>
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