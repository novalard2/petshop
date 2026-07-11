@extends('layouts.landing_page')

@section('content')
<div class="service-page">
    <div class="service-menu">
    <button class="service-tab active" data-target="grooming">
        <i class="bi bi-scissors"></i>
        Grooming
    </button>

    <button class="service-tab" data-target="hotel">
        <i class="bi bi-house-heart-fill"></i>
        Pet Hotel
    </button>
    </div>

    <div id="grooming" class="service-content active">
        {{-- Grooming --}}
        <h2 class="section-title">GROOMING</h2>
        <div class="service-grid">
            @foreach($data_grooming as $product)
                <div class="service-card">
                    <div class="card-title">
                        {{ $product->nama_product }}
                    </div>
                    <div class="card-desc">
                        {{ $product->description }}
                    </div>
                    {{-- <div class="feature-item">
                        {{ ucfirst($product->jenis_hewan ?? 'Semua Hewan') }}
                    </div> --}}
                    <div class="card-price">
                        Rp {{ number_format($product->harga,0,',','.') }}
                    </div>
                    <a href="{{ route('service.form',$product->id) }}" class="btn-reservasi">
                        <i class="bi bi-whatsapp"></i>
                        Reservasi Sekarang
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div id="hotel" class="service-content">
        {{-- hotel --}}
        <h2 class="section-title">PET HOTEL</h2>
        <div class="service-grid">
            @foreach($data_hotel as $product)
                <div class="service-card">
                    <div class="card-title">
                        {{ $product->nama_product }}
                    </div>
                    <div class="card-desc">
                        {{ $product->description }}
                    </div>
                    {{-- <div class="feature-item">
                        {{ ucfirst($product->jenis_hewan ?? 'Semua Hewan') }}
                    </div> --}}
                    <div class="card-price">
                        Rp {{ number_format($product->harga,0,',','.') }}
                    </div>
                    <a href="{{ route('service.form',$product->id) }}" class="btn-reservasi">
                        <i class="bi bi-whatsapp"></i>
                        Reservasi Sekarang
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
    <script>
        const tabs = document.querySelectorAll('.service-tab');
        const contents = document.querySelectorAll('.service-content');

        tabs.forEach(tab => {

            tab.addEventListener('click', function(){

                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));

                this.classList.add('active');

                document
                    .getElementById(this.dataset.target)
                    .classList.add('active');

            });

        });
    </script>
@endsection