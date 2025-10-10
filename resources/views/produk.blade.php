<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Rekomendasi Produk - TokoLabs</title>
  <link rel="stylesheet" href="{{ asset('assets/css/produk.css') }}?v={{ time() }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
      <div class="menu-container">
        <div class="logo">
          <div class="brand">
            <i class="fa-solid fa-shop"></i>
            <span class="brand-text">TokoLabs</span>
          </div>
          <div class="bars-wrapper" id="toggleSidebar">
            <i class="fa-solid fa-bars"></i>
          </div>
        </div>
        <ul>
          <li><a href="{{ url('dashboard') }}"><i class="fa-solid fa-gauge-high"></i> <span class="menu-text">Dashboard</span></a></li>
          <li class="produk active"><a href="#"><i class="fa-solid fa-cart-shopping"></i> <span class="menu-text">Rekomendasi Produk</span></a></li>
          <li><a href="{{ url('schedule') }}"><i class="fa-solid fa-calendar-days"></i> <span class="menu-text">Scheduler</span></a></li>
          <li><a href="{{ url('akun') }}"><i class="fa-solid fa-gear"></i> <span class="menu-text">Pengaturan Akun</span></a></li>
        </ul>
      </div>
      <div class="logout-wrapper">
        <a href="#" onclick="konfirmasiLogout()" class="logout-btn">
          <i class="fa-solid fa-right-from-bracket"></i>
          <span class="logout-text">Keluar</span>
        </a>
      </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
      <div class="navbar">
        <div class="nav-title">Rekomendasi Produk</div>
        <div class="user-area">
          <div class="greetingg">Hi, {{ auth()->user()->username ?? auth()->user()->name }}!</div>
          <a href="{{ route('profile') }}">
            <div class="avatar" style="cursor: pointer;">
              <img src="{{ auth()->user()->img_profile ? asset('img_profiles/' . auth()->user()->img_profile) : asset('assets/img/profil.jpg') }}" alt="Profil" />
            </div>
          </a>
        </div>
      </div>

      <!-- Halaman Produk -->
      <div class="halaman-produk-container">
        <div class="filter-search">
          <input type="text" class="search-bar" placeholder="Search...">
          <div class="dropdown-group">
            <select class="sort-select">
              <option disabled selected>Urutkan</option>
              <option value="harga_terendah">Harga Terendah</option>
              <option value="harga_tertinggi">Harga Tertinggi</option>
              <option value="rating_tertinggi">Rating Tertinggi</option>
              <option value="terlaris">Terlaris</option>
              <option value="terbaru">Terbaru</option>
            </select>
          </div>
        </div>
        
        <div class="pagination-wrapper" id="paginationTop"></div>

        <!-- Grid Produk -->
        <div class="produk-container" id="produkContainer">
          <div class="produk-grid">
            @forelse ($products as $item)
              <a href="{{ route('produk.detail', $item->item_id) }}" class="produk-item-link">
                <div class="produk-item">
                  <img src="{{ $item->image_full_url }}" alt="Gambar Produk" class="produk-img">
                  <div class="produk-info">
                    <div class="produk-header">
                      <div class="produk-rating">
                        <span class="rating-icon">⭐</span>{{ number_format($item->rating_star ?? 0, 1) }}
                      </div>
                      <span class="produk-harga">{{ $item->price_formatted }}</span>
                    </div>
                    <div class="produk-nama">
                      {{ \Illuminate\Support\Str::limit($item->title ?? $item->name ?? '-', 40) }}
                    </div>
                    <div class="produk-rating-terjual">
                      <div class="produk-terjual">{{ $item->sold_formatted }}</div>
                    </div>
                  </div>
                </div>
              </a>
            @empty
              <p>Tidak ada produk ditemukan.</p>
            @endforelse
          </div>
        </div>

        <div class="buat-link-container">
          <button class="btn-buat-link">
            <i class="fa-solid fa-circle-plus"></i> Buat Link masal
          </button>
        </div>

        <!-- Pagination Laravel -->
        <div class="pagination-wrapper">
          {{ $products->links() }}
        </div>
      </div>
    </div>
  </div>

  <script>
    function konfirmasiLogout() {
      if (confirm("Apakah Anda yakin ingin logout?")) {
        window.location.href = "/";
      }
    }

    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const toggleBtn = document.getElementById('toggleSidebar');

    toggleBtn.addEventListener('click', function () {
      sidebar.classList.toggle('collapsed');
      mainContent.classList.toggle('expanded');
    });
  </script>
</body>
</html>
