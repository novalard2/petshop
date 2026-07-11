@extends('layouts.landing_page')

@section('content')
<div class="checkout-container">
    <div class="checkout-card">
        <h3>Data Pemesan</h3>
        <table class="user-info">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ Auth::user()->name }}</td>
            </tr>

            <tr>
                <td>Email</td>
                <td>:</td>
                <td>{{ Auth::user()->email }}</td>
            </tr>

            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ Auth::user()->alamat }}</td>
            </tr>

            <tr>
                <td>No HP</td>
                <td>:</td>
                <td>{{ Auth::user()->no_hp }}</td>
            </tr>
        </table>
    </div>

    <div class="checkout-card">
        <h3>Produk</h3>
        @foreach($cart as $id => $item)
        <div class="product-item">
            <img src="{{ asset('storage/product/' . $item['gambar']) }}">
            <div class="info">
                <h4>{{ $item['nama'] }}</h4>
                <p>Harga :
                    Rp {{ number_format($item['harga']) }}
                </p>
                <p>Qty :
                    {{ $item['qty'] }}
                </p>
            </div>
            <div class="subtotal">
                Rp {{ number_format($item['harga'] * $item['qty']) }}
            </div>
        </div>
        @endforeach
    </div>

    <div class="checkout-summary">
        <hr>
        <br>
        <h2>
            Total Belanja : Rp {{ number_format($total) }}
        </h2>
        <hr>
        <div class="checkout-action">
            <a href="{{ route('cart.index') }}" class="checkout-back-btn">
                <i class="bi bi-arrow-left-circle-fill"></i> Kembali
            </a>
            <form action="{{ route('order.proses') }}" method="POST" class="checkout-form">
                @csrf
                <button type="submit" class="checkout-pay-btn" id="submitBtn">
                    Bayar Sekarang
                </button>
            </form>
        </div>
    </div>
</div>
@endsection