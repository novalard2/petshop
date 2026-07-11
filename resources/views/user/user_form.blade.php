@extends('layouts.landing_page')

@section('content')

<div class="animal-form-container">

    <div class="animal-form-card">
        <h2>Tambah Hewan</h2>
        <p>Lengkapi data hewan peliharaanmu.</p>
        @if(isset($data))
            <form action="{{ route('user.animal.update', $data->id) }}" method="POST">
        @else
            <form action="{{ route('user.animal.tambah') }}" method="POST">
        @endif
            @csrf
            <div class="form-group">
                <label>Nama Hewan</label>
                <input type="text" name="name" placeholder="Nama Hewan" value="{{ old('name', $data->name ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $data->tgl_lahir ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Jenis Hewan</label>
                <select name="type_id" required>
                    <option value="">Pilih Jenis Hewan</option>
                    @foreach($types as $type)
                        <option
                            value="{{ $type->id }}"
                            {{ old('type_id', $data->type_id ?? '') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option
                        value="jantan"
                        {{ old('jenis_kelamin', $data->jenis_kelamin ?? '') == 'jantan' ? 'selected' : '' }}>
                        Jantan
                    </option>
                    <option
                        value="betina"
                        {{ old('jenis_kelamin', $data->jenis_kelamin ?? '') == 'betina' ? 'selected' : '' }}>
                        Betina
                    </option>
                </select>
            </div>
            <button type="submit" class="btn-save" id="submitBtn">
                {{ isset($data) ? 'Update Hewan' : 'Simpan Hewan' }}
            </button>
        </form>
    </div>
</div>
@endsection