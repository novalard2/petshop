@extends('layouts.nice')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">
                <i class="bi bi-person-badge-fill me-2"></i>
                {{ $data ? 'Edit Karyawan' : 'Tambah Karyawan' }}
            </h3>
            <small>
                Lengkapi data karyawan dengan benar.
            </small>
        </div>
        <div class="card-body">
            <form action="{{ $data ? route('karyawan.update',$data->id) : route('karyawan.tambah') }}"
                  method="POST">
                @csrf
                @if($data)
                <div class="mb-3">
                    <label class="form-label">
                        ID Karyawan
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
                                Nama
                            </label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ $data->name ?? '' }}"
                                placeholder="Masukkan nama">
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
                                Tanggal Lahir
                            </label>
                            <input
                                type="date"
                                name="tgl_lahir"
                                class="form-control"
                                value="{{ $data->tgl_lahir ?? '' }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">
                                Jenis Kelamin
                            </label>
                            <select
                                name="jenis_kelamin"
                                class="form-control">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="laki"
                                    {{ $data && $data->jenis_kelamin=='laki' ? 'selected' : '' }}>
                                    Laki-Laki
                                </option>
                                <option value="perempuan"
                                    {{ $data && $data->jenis_kelamin=='perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">
                        Alamat
                    </label>
                    <textarea
                        name="alamat"
                        rows="4"
                        class="form-control"
                        placeholder="Masukkan alamat">{{ $data->alamat ?? '' }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">
                                Nomor Handphone
                            </label>
                            <input
                                type="text"
                                name="no_hp"
                                class="form-control"
                                value="{{ $data->no_hp ?? '' }}"
                                placeholder="08xxxxxxxxxx">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">
                                Jabatan
                            </label>
                            <select
                                name="jabatan"
                                class="form-control">
                                <option value="">Pilih Jabatan</option>
                                <option value="kasir"
                                    {{ $data && $data->jabatan=='kasir' ? 'selected' : '' }}>
                                    Kasir
                                </option>
                                <option value="kurir"
                                    {{ $data && $data->jabatan=='kurir' ? 'selected' : '' }}>
                                    Kurir
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('karyawan.index') }}"
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