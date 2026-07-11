@extends('layouts.landing_page')

@section('content')

<div class="cart-page">
    <div class="cart-box">
        <div class="cart-header-custom">
            <h2>
                <i class="fa-solid fa-cart-shopping"></i>
                Keranjang Belanja
            </h2>
        </div>

        <div class="cart-content">

            @if(count($cart) > 0)

                <div class="cart-products">
                    @foreach($cart as $id => $item)
                        @php
                            $subtotal = $item['harga'] * $item['qty'];
                        @endphp

                        <div class="cart-item">
                            <div class="cart-left">
                                <img
                                    src="{{ asset('storage/product/' . $item['gambar']) }}"
                                    class="cart-image"
                                    alt="{{ $item['nama'] }}"
                                >
                            </div>
                            <div class="cart-item-info">
                                <h4>{{ $item['nama'] }}</h4>
                                <p class="cart-price">
                                    Rp {{ number_format($item['harga'],0,',','.') }}
                                </p>
                                <p class="cart-subtotal">
                                    Subtotal :
                                    <strong>
                                        Rp {{ number_format($subtotal,0,',','.') }}
                                    </strong>
                                </p>
                            </div>

                            <div class="cart-item-action">
                                <div class="qty-box">
                                    <form action="{{ route('cart.decrease', $id) }}" method="POST" class="qty-form">
                                        @csrf
                                        <button type="submit" class="qty-btn minus">
                                            -
                                        </button>
                                    </form>
                                    <span class="qty-number">
                                        {{ $item['qty'] }}
                                    </span>
                                    <form action="{{ route('cart.increase', $id) }}" method="POST" class="qty-form">
                                        @csrf
                                        <button type="submit" class="qty-btn plus">
                                            +
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="cart-footer">
                    <h3>
                        Total :
                        Rp {{ number_format($total,0,',','.') }}
                    </h3>
                    <div class="cart-action">
                        <a href="{{ route('store') }}" class="cart-btn-back">
                            <i class="bi bi-arrow-left-circle-fill"></i> Kembali
                        </a>
                        <a href="{{ route('checkout') }}" class="cart-checkout-btn">
                            <i class="bi bi-cart-check-fill"></i> Checkout
                        </a>
                    </div>
                </div>
            @else
                <div class="empty-cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <h3>Keranjang masih kosong</h3>
                    <a href="{{ route('store') }}" class="shop-btn">
                        Belanja Sekarang
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
