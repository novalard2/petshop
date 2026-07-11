@extends('layouts.nice')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">
                <i class="bi bi-tags-fill me-2"></i>
                {{ $data ? 'Edit Category' : 'Tambah Category' }}
            </h3>
            <small>
                Lengkapi data kategori produk.
            </small>
        </div>
        <div class="card-body">
            <form action="{{ $data ? route('category.update',$data->id) : route('category.tambah') }}"
                  method="POST">
                @csrf
                @if($data)
                <div class="mb-3">
                    <label class="form-label">
                        ID Category
                    </label>
                    <input
                        type="text"
                        class="form-control"
                        value="{{ $data->id }}"
                        readonly>
                </div>
                @endif
                <div class="mb-4">
                    <label class="form-label">
                        Nama Category
                    </label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ $data->name ?? '' }}"
                        placeholder="Masukkan nama category">
                </div>
                <hr>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('category.index') }}"
                       class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>
                    <button
                        type="submit"
                        class="btn btn-primary">
                        <i class="bi bi-check-circle"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection