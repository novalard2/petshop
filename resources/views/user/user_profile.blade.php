@extends('layouts.landing_page')

@section('content')
<div class="animal-form-container">
    <div class="animal-form-card">
        <h2>Profile Saya</h2>
        <p>Lengkapi data diri Anda.</p>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('user.profile.update') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input
                    type="email"
                    value="{{ $user->email }}"
                    readonly>
            </div>

            <div class="form-group">
                <label>No Handphone</label>
                <input
                    type="text"
                    name="no_hp"
                    value="{{ old('no_hp', $user->no_hp) }}"
                    inputmode="numeric"
                    pattern="[0-9]+"
                    oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                    maxlength="15"
                    required>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea
                    name="alamat"
                    rows="4"
                    required>{{ old('alamat', $user->alamat) }}</textarea>
            </div>

            <button type="submit" class="btn-save" id="submitBtn">
                Simpan Profile
            </button>
        </form>
    </div>
</div>

@endsection