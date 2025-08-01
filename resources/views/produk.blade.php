<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Produk - TokoLabs</title>
  <link rel="stylesheet" href="{{ asset('assets/css/produk.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
  <aside class="sidebar" id="sidebar">
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
      <li><a href="dashboard"><i class="fa-solid fa-gauge-high"></i> <span class="menu-text">Dashboard</span></a></li>
      <li class="produk active"><a href="#"><i class="fa-solid fa-cart-shopping"></i> <span class="menu-text">Produk</span></a></li>
      <li><a href="schedule"><i class="fa-solid fa-calendar-days"></i> <span class="menu-text">Scheduler</span></a></li>
      <li><a href="etalase"><i class="fa-solid fa-user-gear"></i> <span class="menu-text">Manajemen & Etalase</span></a></li>
    </ul>
  </aside>

  <!-- Main Content -->
  <div class="main-content" id="mainContent">
    <div class="navbar">
      <div class="nav-title">Data Produk</div>
      <div class="user-area">
        <div class="greeting">Hi, {{ $user->username ?? $user->name }}</div>
        <div class="avatar">
          <img 
            src="{{ $user->img_profile ? asset('img_profiles/' . $user->img_profile) : asset('assets/img/profil.jpg') }}" 
            alt="Profil" />
        </div>
        <div class="dropdown">
          <div class="dropdown-toggle" onclick="toggleDropdown()">
            <i class="fa-solid fa-chevron-down chevron-icon"></i>
          </div>
          <div class="dropdown-menu" id="dropdownMenu">
            <a href="{{ route('profile') }}">Pengaturan Akun</a>
            <a href="#" onclick="konfirmasiLogout()" class="logout-link">Logout</a>
          </div>
        </div>
      </div>
    </div>

 <!-- Halaman Produk -->
<div class="halaman-produk-container">
  <div class="filter-search">
    <input type="text" class="search-bar" placeholder="Search...">
    <div class="dropdown-group">
      <select class="filter-select">
        <option disabled selected>Pilih Kategori</option>
<option value="aksesori_fashion">Aksesori Fashion</option>
<option value="buku_alat_tulis">Buku & Alat Tulis</option>
<option value="elektronik">Elektronik</option>
<option value="fashion_bayi_anak">Fashion Bayi & Anak</option>
<option value="fashion_muslim">Fashion Muslim</option>
<option value="fotografi">Fotografi</option>
<option value="handphone_aksesoris">Handphone & Aksesoris</option>
<option value="hobi_koleksi">Hobi & Koleksi</option>
<option value="ibu_bayi">Ibu & Bayi</option>
<option value="jam_tangan">Jam Tangan</option>
<option value="kesehatan">Kesehatan</option>
<option value="komputer_aksesoris">Komputer & Aksesoris</option>
<option value="makanan_minuman">Makanan & Minuman</option>
<option value="olahraga_outdoor">Olahraga & Outdoor</option>
<option value="otomotif">Otomotif</option>
<option value="pakaian_pria">Pakaian Pria</option>
<option value="pakaian_wanita">Pakaian Wanita</option>
<option value="perawatan_tubuh">Perawatan & Kecantikan</option>
<option value="perlengkapan_rumah">Perlengkapan Rumah</option>
<option value="sepatu_pria">Sepatu Pria</option>
<option value="sepatu_wanita">Sepatu Wanita</option>
<option value="tas_wanita">Tas Wanita</option>
<option value="tas_pria">Tas Pria</option>
<option value="perhiasan_aksesoris">Perhiasan & Aksesori</option>
      </select>
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
<div class="produk-container" id="produkContainer">
  @foreach ($product as $item )
    <div class="produk-item">
    <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="produk-img" />
    <div class="produk-info">
      <div class="produk-header">
        <span class="produk-label">Mall ORI</span>
        <span class="produk-harga">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
      </div>
      <div class="produk-nama">{{ \Illuminate\Support\Str::limit($item->name, 40) }}</div>
      <div class="produk-rating-terjual">
        <div class="produk-rating">
          <span class="rating-icon">⭐</span>{{ $item->rating }}
        </div>
        <div class="produk-terjual">{{ $item->total_sales }} terjual</div>
      </div>
    </div>
  </div>
  @endforeach
</div>

<div class="pagination-wrapper" id="paginationBottom"></div>
<script>
  const itemsPerPage = 18;
  const produkContainer = document.getElementById("produkContainer");
  const produkItems = Array.from(produkContainer.getElementsByClassName("produk-item"));
  const paginationTop = document.getElementById("paginationTop");
  const paginationBottom = document.getElementById("paginationBottom");

  let currentPage = 1;
  const totalPages = Math.ceil(produkItems.length / itemsPerPage);

  function showPage(page) {
    currentPage = page;

    produkItems.forEach((item, index) => {
      item.style.display = (index >= (page - 1) * itemsPerPage && index < page * itemsPerPage)
        ? "block" : "none";
    });

    renderPaginationTop(currentPage);
    renderPaginationBottom(currentPage);
  }

  function renderPaginationTop(activePage) {
    paginationTop.innerHTML = "";

    const pageInfo = document.createElement("span");
    pageInfo.className = "page-info";
    pageInfo.textContent = `${activePage}/${totalPages}`;
    paginationTop.appendChild(pageInfo);

    const btnPrev = document.createElement("button");
    btnPrev.innerHTML = "&lt;";
    btnPrev.disabled = activePage === 1;
    btnPrev.onclick = () => showPage(activePage - 1);
    paginationTop.appendChild(btnPrev);

    const btnNext = document.createElement("button");
    btnNext.innerHTML = "&gt;";
    btnNext.disabled = activePage === totalPages;
    btnNext.onclick = () => showPage(activePage + 1);
    paginationTop.appendChild(btnNext);
  }

  function renderPaginationBottom(activePage) {
    paginationBottom.innerHTML = "";

    const btnPrev = document.createElement("button");
    btnPrev.innerHTML = "&lt;";
    btnPrev.disabled = activePage === 1;
    btnPrev.onclick = () => showPage(activePage - 1);
    paginationBottom.appendChild(btnPrev);

    const maxPagesShown = 5;
    let startPage = Math.max(1, activePage - 2);
    let endPage = Math.min(totalPages, startPage + maxPagesShown - 1);
    if (endPage - startPage < maxPagesShown - 1) {
      startPage = Math.max(1, endPage - maxPagesShown + 1);
    }

    for (let i = startPage; i <= endPage; i++) {
      const btn = document.createElement("button");
      btn.textContent = i;
      if (i === activePage) {
        btn.classList.add("active");
        btn.disabled = true;
      }
      btn.onclick = () => showPage(i);
      paginationBottom.appendChild(btn);
    }

    if (endPage < totalPages) {
      const dots = document.createElement("span");
      dots.textContent = "...";
      paginationBottom.appendChild(dots);
    }

    const btnNext = document.createElement("button");
    btnNext.innerHTML = "&gt;";
    btnNext.disabled = activePage === totalPages;
    btnNext.onclick = () => showPage(activePage + 1);
    paginationBottom.appendChild(btnNext);
  }

  showPage(1);
</script>

  <script>
  // Toggle dropdown menu saat avatar diklik
  function toggleDropdown() {
    const menu = document.getElementById("dropdownMenu");
    if (menu) {
      menu.style.display = menu.style.display === "block" ? "none" : "block";
    }
  }

  // Konfirmasi logout
  function konfirmasiLogout() {
    const yakin = confirm("Apakah Anda yakin ingin logout?");
    if (yakin) {
      window.location.href = "/";
    }
  }

  // Sembunyikan dropdown jika klik di luar
  document.addEventListener("click", function (event) {
    const dropdown = document.querySelector(".dropdown");
    const menu = document.getElementById("dropdownMenu");
    if (dropdown && menu && !dropdown.contains(event.target)) {
      menu.style.display = "none";
    }
  });

  // Toggle sidebar jika tombol tersedia
  document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const mainContent = document.getElementById("mainContent");
    const toggleBtn = document.getElementById("toggleSidebar");

    if (sidebar && mainContent && toggleBtn) {
      toggleBtn.addEventListener("click", function () {
        sidebar.classList.toggle("collapsed");
        mainContent.classList.toggle("expanded");
      });
    }
  });
</script>
</body>
</html>