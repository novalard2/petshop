@extends('layouts.nice')

@section('content')
    <div class="container mt-2">
        <div class="card">
            <div class="card-body">
                <h4 class="text-md">Form Users</h4>
                <form action="{{ $data ==null ? route('user.tambah'):route('user.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if ($data !== null)
                    <div class="mb-3">
                        <label for="id" class="form-label">id Users</label>
                        <input type="text" name="id_user" class="form-control" id="name" value="{{ $data->id??'' }}" readonly placeholder="ini ID">
                    </div>

                     @endif
                    <div class="mb-3">
                        <label for="nama_user" class="form-label">Nama Users</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $data->name??'' }}" placeholder="Masukan Nama">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $data->email??'' }}" placeholder="Masukan Email">
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" value="{{ $data->password??'' }}" class="form-control" placeholder="Masukan Password">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection