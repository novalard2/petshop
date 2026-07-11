@extends('layouts.landing_page')

@section('content')
<!-- CONTACT SECTION -->
<div class="contact-section">
  <div class="contact-inner">

    <!-- LEFT: INFO -->
    <div class="contact-info">
      <h2><span>Pet</span>Shop</h2>
      <p class="tagline">Tempat terbaik untuk hewan peliharaan Anda 🐾</p>

      <div class="info-item">
        <div class="info-icon"><i class="bi bi-geo-alt" style="color: #FFFAF0"></i></div>
        <div class="info-text">
          <span class="info-label">Alamat</span>
          <span class="info-value">Jl. Nyengcle Ds. Selawangi,<br>Tanjungsari, 1945</span>
        </div>
      </div>

      <div class="info-item">
        <div class="info-icon"><i class="bi bi-telephone" style="color: #FFFAF0"></i></div>
        <div class="info-text">
          <span class="info-label">Telepon</span>
          <span class="info-value">+62 813-8182-1654</span>
        </div>
      </div>

      <div class="info-item">
        <div class="info-icon"><i class="bi bi-envelope-at" style="color: #FFFAF0"></i></div>
        <div class="info-text">
          <span class="info-label">Email</span>
          <span class="info-value">hello@petshop.id</span>
        </div>
      </div>

      <div class="info-item">
        <div class="info-icon"><i class="bi bi-clock" style="color: #FFFAF0"></i></div>
        <div class="info-text">
          <span class="info-label">Jam Operasional</span>
          <span class="info-value">Senin – Sabtu: 08.00 – 20.00<br>Minggu: 09.00 – 17.00</span>
        </div>
      </div>

      <div class="social-row">
        <a href="https://www.instagram.com/novalardsyhh?igsh=MTQxbnc3dW9seWVibw%3D%3D&utm_source=qr" class="social-btn" title="Instagram"><i class="bi bi-instagram"></i></a>
        <a href="https://wa.me/6281381821654" class="social-btn" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
        <a class="social-btn" title="Facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://www.tiktok.com/@novalardsyhh" class="social-btn" title="TikTok"><i class="bi bi-tiktok"></i></a>
      </div>
    </div>

    <!-- RIGHT: FORM -->
    <div class="contact-form">
      <h3>Kirim Pesan kepada Kami</h3>
      
      <p class="p">Ada yang ingin ditanyakan? Hubungi kami sekarang dan 
        dapatkan informasi mengenai produk, stok, maupun layanan dengan cepat dan mudah.
      </p>

      <div class="contact-feature">
        <div class="feature">
            <span>✓</span>
            <div>
                <h4>Fast Response</h4>
                <p>Kami membalas pesan secepat mungkin.</p>
            </div>
        </div>

        <div class="feature">
            <span>✓</span>
            <div>
                <h4>Konsultasi Gratis</h4>
                <p>Tanyakan produk atau kebutuhan hewan peliharaan Anda.</p>
            </div>
        </div>

        <div class="feature">
            <span>✓</span>
            <div>
                <h4>Buka Setiap Hari</h4>
                <p>Layanan tersedia sesuai jam operasional.</p>
            </div>
        </div>
      </div>



      <a class="btn-send" href="{{ route('send-wa') }}"
        target="_blank">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <line x1="22" y1="2" x2="11" y2="13"/>
              <polygon points="22 2 15 22 11 13 2 9 22 2"/>
          </svg>
          Kirim Pesan
      </a>
    </div>

  </div>
</div>
<div class="toast" id="toast"></div>

@endsection

