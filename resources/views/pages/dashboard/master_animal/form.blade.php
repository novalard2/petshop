@extends('layouts.nice')
@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">
                <i class="bi bi-paw-fill me-2"></i>
                {{ $data ? 'Edit Animal' : 'Tambah Animal' }}
            </h3>
            <small>
                Lengkapi data hewan dengan benar.
            </small>
        </div>
        <div class="card-body">
            <form action="{{ $data ? route('animal.update',$data->id) : route('animal.tambah') }}"
                  method="POST">
                @csrf
                @if($data)
                <div class="mb-3">
                    <label class="form-label">
                        ID Animal
                    </label>
                    <input
                        type="text"
                        class="form-control"
                        value="{{ $data->id }}"
                        readonly>
                </div>
                @endif
                @if(Auth::user()->role=='admin')
                <div class="mb-3">
                    <label class="form-label">
                        User
                    </label>
                    <select
                        name="user_id"
                        class="form-control">
                        <option value="">
                            -- Pilih User --
                        </option>
                        @foreach($users as $user)
                        <option
                            value="{{ $user->id }}"
                            {{ $data && $data->user_id==$user->id ? 'selected' : '' }}>
                            {{ $user->email }}
                        </option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">
                                Nama Hewan
                            </label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ $data->name ?? '' }}" placeholder="Masukan Nama Hewan">
                        </div>
                    </div>
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
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">
                                Jenis Hewan
                            </label>
                            <select
                                name="type_id"
                                class="form-control">
                                <option value="">
                                    Pilih Jenis Hewan
                                </option>
                                @foreach($types as $type)
                                <option
                                    value="{{ $type->id }}"
                                    {{ $data && $data->type_id==$type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                                @endforeach
                            </select>
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
                                <option value="">
                                    Pilih Jenis Kelamin
                                </option>
                                <option
                                    value="jantan"
                                    {{ $data && $data->jenis_kelamin=='jantan' ? 'selected':'' }}>
                                    Jantan
                                </option>
                                <option
                                    value="betina"
                                    {{ $data && $data->jenis_kelamin=='betina' ? 'selected':'' }}>
                                    Betina
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-end gap-2">
                    <a
                        href="{{ route('animal.index') }}"
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