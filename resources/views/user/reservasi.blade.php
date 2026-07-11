@extends('layouts.landing_page')

@section('content')
<div class="animal-form-container">
    <div class="animal-form-card">
        <h2>Reservasi Layanan</h2>
        <p>Silakan pilih hewan yang akan menggunakan layanan.</p>
        <form action="{{ route('service.wa',$product->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Layanan</label>
                <input
                    type="text"
                    value="{{ $product->nama_product }}"
                    readonly>
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input
                    type="text"
                    value="Rp {{ number_format($product->harga,0,',','.') }}"
                    readonly>
            </div>
            <div class="form-group">
                <label>Pilih Hewan</label>
                @if($animals->count())
                    <select
                        name="animal_id"
                        class="form-control"
                        required>
                        <option value="">
                            -- Pilih Hewan --
                        </option>
                        @foreach($animals as $animal)
                            <option value="{{ $animal->id }}">
                                {{ $animal->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="reservasi-btn-save" id="submitBtn">
                        <i class="bi bi-whatsapp"></i>
                        Reservasi via WhatsApp
                    </button>
                    <a href="{{ route('service') }}" class="reservasi-btn-back">
                        <i class="bi bi-arrow-left"></i>
                        Kembali ke Service
                    </a>
                @else
                    <div class="alert alert-warning">
                        Anda belum memiliki data hewan.
                        <br>
                        Silakan tambahkan data hewan terlebih dahulu untuk melakukan reservasi.
                    </div>
                    <a href="{{ route('user.animal.form') }}" class="reservasi-btn-save">
                        <i class="bi bi-plus-circle"></i>
                        Tambah Hewan
                    </a>
                    <a href="{{ route('service') }}" class="reservasi-btn-back">
                        <i class="bi bi-arrow-left"></i>
                        Nanti Saja
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection