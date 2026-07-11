@extends('layouts.nice')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">
                <i class="bi bi-people-fill me-2"></i>
                {{ $data ? 'Edit User' : 'Tambah User' }}
            </h3>
            <small>
                Lengkapi data user dengan benar.
            </small>
        </div>
        <div class="card-body">
            <form action="{{ $data ? route('user.update',$data->id) : route('user.tambah') }}"
                  method="POST">
                @csrf
                @if($data)
                <div class="mb-3">
                    <label class="form-label">
                        ID User
                    </label>
                    <input
                        type="text"
                        class="form-control"
                        value="{{ $data->id }}"
                        readonly>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">
                                Nama User
                            </label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ $data->name ?? '' }}"
                                placeholder="Masukkan nama user">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">
                                Email
                            </label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ $data->email ?? '' }}"
                                placeholder="Masukkan email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">
                                Role
                            </label>
                            <select
                                name="role"
                                class="form-control">
                                <option value="">Pilih Role</option>
                                @foreach($roles as $role)
                                <option
                                    value="{{ $role }}"
                                    {{ old('role',$data->role ?? '') == $role ? 'selected' : '' }}>
                                    {{ ucfirst($role) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">
                                Password
                            </label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="{{ $data ? 'Kosongkan jika tidak diubah' : 'Masukkan password' }}">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('user.index') }}"
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