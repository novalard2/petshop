@extends('layouts.landing_page')

@section('content')
<form action="{{ route('store') }}" method="get" class="search-form">
    <div class="search-wrap">
      <div class="search-bar">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"/>
          <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" name="search" placeholder="Cari Product" id="searchInput"/>
        <button type="submit" class="search-btn">
        Cari
        </button>
      </div>
    </div>
</form>

<div class="store-section">
    <div class="product-grid" id="productGrid">
        
        @include('landingpage.partials.product-card')

    </div>
    <div class="load-more-wrapper">
        @if( empty($search) && $products->hasMorePages())
            <div class="load-more-wrapper" id="loadMoreWrapper">
                <button id="loadMore" class="load-more-btn" data-page="2">
                    Lihat Produk Lainnya
                </button>
            </div>
        @endif
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
    let loadMore = document.getElementById('loadMoreWrapper');

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

         if(loadMore){
            loadMore.style.display = input === '' ? 'flex' : 'none';
        }
    }

    const btn = document.getElementById('loadMore');
    if(btn){
        btn.addEventListener('click', function(){
            let page = this.dataset.page;
            btn.disabled = true;
            btn.innerHTML = `
                <i class="fa-solid fa-spinner fa-spin"></i>
                Memuat...
            `;
            fetch(`/store?page=${page}`,{
                headers:{
                    "X-Requested-With":"XMLHttpRequest"
                }
            })
            .then(res=>res.json())
            .then(data=>{
                document
                    .getElementById('productGrid')
                    .insertAdjacentHTML('beforeend', data.html);
                if(data.hasMore){
                    page++;
                    btn.dataset.page = page;
                    btn.disabled = false;
                    btn.innerHTML = "Lihat Produk Lainnya";
                }else{
                    btn.outerHTML = `
                        <div class="all-product-message">
                            <i class="bi bi-check-circle-fill"></i>
                            Semua produk telah ditampilkan
                        </div>
                    `;
                }
            });
        });
    }
</script>
@endsection

