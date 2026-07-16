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