<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PetShop</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="{{ secure_asset('landing_page.css') }}">
</head>
  <body>
  <!-- NAVBAR -->
<nav>
  <div class="nav">
      <a href="{{ route('home') }}" class="logo">
          <span>Pet</span>Shop
      </a>
  </div>
  <button class="menu-toggle" onclick="toggleMenu()">
      ☰
  </button>
  <ul class="nav-links" id="navMenu">
    <li><a href="{{ route('home') }}" >Home</a></li>
    <li><a href="{{ route('about') }}" >About</a></li>
    <li><a href="{{ route('store') }}" >Store</a></li>
    <li><a href="{{ route('service') }}">Service</a></li>
    <li><a href="{{ route('contact') }}">Contact</a></li>
  </ul>

  <div class="nav-icons">
    <a href="{{ route('cart.index') }}">
      <button title="Keranjang" class="cart-btn">
          <i class="fa-solid fa-cart-shopping"></i>
          <span class="cart-count">
              {{ count(session('cart', [])) }}
          </span>
      </button>
    </a>
      
    @auth
      <div class="user-menu">
          <div class="user-avatar">
              {{ strtoupper(substr(Auth::user()->name,0,1)) }}
          </div>
          <div class="user-dropdown">
              <p>Nama : {{ Auth::user()->name }}</p>
              <hr>
              <p>{{ Auth::user()->email }}</p>
              <hr>
              <p><a href="{{route('user.animal')}}">
              <i class="bi bi-bookmark-plus-fill"></i>
              Hewan Saya</a>
              </p>
              <hr>
              <p><a href="{{route('user.profile')}}">
              <i class="bi bi-person-circle"></i>
              Profile Saya</a>
              </p>
              <hr>
              <p><a href="{{route('orders.index')}}">
              <i class="bi bi-bag-check-fill"></i>
              Pesanan Saya</a></p>
              <hr>
              @auth
                @if(Auth::user()->role == 'admin')
                    <p><a href="{{ route('dashboard') }}">Beralih Ke Dashboard</a></p>
                @endif
              @endauth

              <form id="logoutForm" class="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" id="logoutBtn">
                    Logout
                </button>
            </form>
          </div>
      </div>
    @endauth
      
    @guest
    <a href="{{ route('auth.login') }}">
      <button title="Login">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
          <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
        </svg>
      </button>
    </a>
    @endguest  
  </div>
</nav>

  <main>
    <div class="p-2">
      @yield('content')
    </div>
  </main>

  <footer>
    <div class="footer-logo"><span>Pet</span>Shop</div>
    <p class="footer-copy">© 2026 PetShop. All team noval/pipeh/mario/azka.</p>
  </footer>
  
<script>
  function toggleMenu() {
    document.getElementById('navMenu').classList.toggle('show');
  }

  const avatar = document.querySelector('.user-avatar');
  const dropdown = document.querySelector('.user-dropdown');

  if(avatar && dropdown){
    avatar.addEventListener('click', function(e){
        e.stopPropagation();
        dropdown.classList.toggle('show');
    });

    dropdown.addEventListener('click', function(e){
        e.stopPropagation();
    });

    document.addEventListener('click', function(){
        dropdown.classList.remove('show');
    });
  }
</script>

<script>
  document.querySelectorAll('.cart-form').forEach(form => {

    form.addEventListener('submit', function(e){

        e.preventDefault();

        const btn = form.querySelector('button[type="submit"]');

        btn.disabled = true;
        btn.innerHTML = `<i class="fa-solid fa-spinner fa-spin"></i>`;

        setTimeout(() => {
            form.submit();
        }, 150);

    });

  });
</script>


<script>
document.querySelectorAll('form:not(.logout-form)').forEach(form => {

  if(form.classList.contains('cart-form')){
      return;
  }

  form.addEventListener('submit', function(){

      const btn = form.querySelector('button[type="submit"]');
      if(!btn) return;

      btn.disabled = true;

      // Tambah / Kurang Qty
      if(form.classList.contains('qty-form')){
          btn.innerHTML = `<i class="fa-solid fa-spinner fa-spin"></i>`;
      }

      else{
          btn.innerHTML = `
              <span class="spinner"></span>
              Memproses...
          `;
      }

  });

});
</script>


<script>
  const logoutForm = document.getElementById('logoutForm');

  if(logoutForm){
      logoutForm.addEventListener('submit', function(e){
          e.preventDefault();

          Swal.fire({
              title: 'Logout?',
              text: 'Apakah Anda yakin ingin keluar?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#162E93',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, Logout',
              cancelButtonText: 'Batal'
          }).then((result)=>{

              if(result.isConfirmed){

                  logoutForm.submit();

              }
          });
      });
  }
</script>
</body>
</html>
