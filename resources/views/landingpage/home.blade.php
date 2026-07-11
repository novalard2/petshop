@extends('layouts.landing_page')
@section('content')
<div class="hero">
  <div class="hero-left">
    <h1>Selamat datang di petshop kami</h1>
    <div class="hero-tagline">Hallo Pets Lover !!</div>
    <p>Tempat terbaik untuk memenuhi kebutuhan hewan peliharaan Anda. Kami menyediakan berbagai produk berkualitas seperti makanan, aksesoris, dan perlengkapan perawatan untuk kucing, anjing, dan hewan lainnya.</p>
    <a href="about" class="btn-primary">Learn more</a>
  </div>

  <div class="hero-cards">
    <!-- Service Pet card -->
    <div class="pet-card">
      <a href="service">
        <img src="{{ asset('assets/images/grooming.jpg') }}" alt="Service Pet" />
      </a>
      <div class="card-label">Service Pet</div>
    </div>
    <!-- Store Pet card -->
    <div class="pet-card">
      <a href="store">
        <img src="{{ asset('assets/images/service.jpg') }}"alt="Store Pet">
      </a>
      <div class="card-label">Store Pet</div>
    </div>
  </div>
</div>

 <!-- ABOUT SECTION -->
<div class="about-section">

  <!-- LEFT: TEXT -->
  <div class="about-left">
    <div class="about-title">
      <i class="fa-solid fa-cat"></i>About
    </div>
    <p>
      Selamat datang di Pet Shop kami, tempat terbaik untuk memenuhi semua kebutuhan hewan peliharaan kesayangan Anda. Kami hadir untuk membantu para pecinta hewan dalam memberikan perawatan terbaik dengan produk berkualitas dan layanan terpercaya.
      <br>
      Kami menyediakan berbagai kebutuhan hewan seperti makanan, aksesoris, vitamin, serta layanan grooming untuk menjaga kebersihan dan kesehatan hewan peliharaan Anda. Dengan pelayanan yang ramah dan profesional, kami selalu berusaha memberikan pengalaman terbaik bagi setiap pelanggan.
    </p>
  </div>

  <!-- RIGHT: CARDS -->
  <div class="cards-grid">

    <div class="feature-card">
        <div class="card-icon">
            <i class="bi bi-check2-circle"></i>
        </div>

        <div class="card-content">
            <h3>Produk Berkualitas Tinggi</h3>
            <p>
                Kami menyediakan berbagai produk berkualitas tinggi untuk memenuhi kebutuhan hewan peliharaan Anda, mulai dari makanan, aksesoris hingga perlengkapan perawatan terbaik.
            </p>
        </div>
    </div>

    <div class="feature-card">
        <div class="card-icon">
            <i class="fa-solid fa-dog"></i>
        </div>

        <div class="card-content">
            <h3>Pelayanan Perawatan Hewan</h3>
            <p>
                Kami berkomitmen memberikan pelayanan terbaik dengan penuh perhatian dan kasih sayang untuk setiap hewan peliharaan Anda.
            </p>
        </div>
    </div>

    <div class="feature-card">
        <div class="card-icon">
            <i class="bi bi-heart-pulse-fill"></i>
        </div>

        <div class="card-content">
            <h3>Layanan Kesehatan</h3>
            <p>
                Kami menyediakan layanan kesehatan terbaik agar hewan peliharaan Anda tetap sehat, nyaman, dan bahagia.
            </p>
        </div>
    </div>

    <div class="feature-card">
        <div class="card-icon">
            <i class="bi bi-arrow-through-heart"></i>
        </div>

        <div class="card-content">
            <h3>Perawatan Khusus</h3>
            <p>
                Setiap hewan memiliki kebutuhan yang berbeda sehingga kami memberikan perawatan yang disesuaikan dengan kondisi dan karakter hewan Anda.
            </p>
        </div>
    </div>

  </div>
</div>
@endsection