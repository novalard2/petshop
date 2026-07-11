@extends('layouts.nice')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">
                <i class="bi bi-bookmark-fill me-2"></i>
                {{ $data ? 'Edit Type Hewan' : 'Tambah Type Hewan' }}
            </h3>
            <small>
                Lengkapi data type hewan.
            </small>
        </div>
        <div class="card-body">
            <form action="{{ $data ? route('type.update',$data->id) : route('type.tambah') }}"
                  method="POST">
                @csrf
                @if($data)
                <div class="mb-3">
                    <label class="form-label">
                        ID Type
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
                        Type Hewan
                    </label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ $data->name ?? '' }}"
                        placeholder="Masukkan type hewan">
                </div>
                <hr>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('type.index') }}"
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