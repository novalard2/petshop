@extends('layouts.landing_page')

@section('content')
<form action="{{ route('store') }}" method="get">
    <div class="search-wrap">
      <div class="search-bar">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"/>
          <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" name="search" placeholder="Cari Product" id="searchInput" oninput="category()" />
        <button type="submit" class="search-btn">
        Cari
        </button>
      </div>
    </div>
</form>

<div class="store-section">
    <div class="product-grid" id="productGrid">
        @foreach ($products as $value)
            <div class="product-card" 
                data-name="{{ strtolower($value->nama_product) }}"
                data-category="{{ strtolower($value->category->name ?? '') }}">
                <img class="product-img"
                    src="{{ asset('storage/product/' . $value->foto) }}"
                    alt="{{ $value->nama_product }}">
                <div class="product-name">
                    {{ $value->nama_product }}
                </div>
                @auth
                <form action="{{ route('add.cart') }}" method="POST" class="cart-form">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $value->id }}">
                        <div class="product-footer">
                            <span class="product-price">
                                Rp. {{ number_format($value->harga, 0, ',', '.') }}
                            </span>

                            @if($value->stok > 0)
                                <button type="submit" class="btn-cart">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        width="14" height="14"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="9" cy="21" r="1"/>
                                        <circle cx="20" cy="21" r="1"/>
                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                                    </svg>
                                </button>
                            @else
                                <span class="stock-empty">
                                    Habis
                                </span>
                            @endif
                        </div>
                </form>
                @endauth
                @guest
                    <div class="product-footer">
                        <span class="product-price">
                            Rp. {{ number_format($value->harga, 0, ',', '.') }}
                        </span>

                        @if($value->stok > 0)
                            <button type="button"
                                    class="btn-cart"
                                    onclick="showLoginAlert()">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    width="14"
                                    height="14"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="9" cy="21" r="1"/>
                                    <circle cx="20" cy="21" r="1"/>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                                </svg>
                            </button>
                        @else
                            <span class="stock-empty">
                                Habis
                            </span>
                        @endif
                    </div>
                @endguest
            </div>
        @endforeach
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        
    function showLoginAlert() {
        Swal.fire({
            icon: 'warning',
            title: 'Login Untuk Berbelanja',
            text: 'Anda harus login terlebih dahulu untuk berbelanja.',
            confirmButtonText: 'Login',
            showCancelButton: true,
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('auth.login') }}";
            }
        });
    }

    function category() {
    let input = document.getElementById('searchInput').value.toLowerCase().trim();
    let products = document.querySelectorAll('.product-card');

        products.forEach(product => {
            let name = product.dataset.name || '';
            let category = product.dataset.category || '';

            if (
                input === '' ||
                name.includes(input) ||
                category.includes(input)
            ) {
                product.style.display = '';
            } else {
                product.style.display = 'none';
            }
        });
    }
</script>
@endsection

