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
      <li><a href="akun"><i class="fa-solid fa-user-gear"></i> <span class="menu-text">Manajemen Akun</span></a></li>
      <li class="produk active"><a href="#"><i class="fa-solid fa-cloud-arrow-down"></i> <span class="menu-text">Scrapping Produk</span></a></li>
      <li><a href="analitik"><i class="fa-solid fa-chart-line"></i> <span class="menu-text">Analisis Produk</span></a></li>
      <li><a href="rekomendasi"><i class="fa-solid fa-star"></i> <span class="menu-text">Rekomendasi Produk</span></a></li>
      <li><a href="etalase"><i class="fa-solid fa-calendar-days"></i> <span class="menu-text">Etalase live</span></a></li>
    </ul>
  </aside>

  <!-- Main Content -->
  <div class="main-content" id="mainContent">
    <div class="navbar">
      <div class="nav-title">Scrapping Produk</div>
      <div class="user-area">
        <div class="greeting">Hi, Welda!</div>
        <div class="avatar">
          <img src="/assets/img/profil.jpg" alt="Profil" />
        </div>
        <div class="dropdown">
          <div class="dropdown-toggle" onclick="toggleDropdown()">
            <i class="fa-solid fa-chevron-down chevron-icon"></i>
          </div>
          <div class="dropdown-menu" id="dropdownMenu">
            <a href="#">Ubah Kata Sandi</a>
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
        <option>Kategori</option>
        <option>Elektronik</option>
        <option>Fashion</option>
        <option value="makeup">Makeup</option>
        <option value="skincare">Skincare</option>
      </select>
      <select class="sort-select">
        <option>Urutkan</option>
        <option>Harga Terendah</option>
        <option>Harga Tertinggi</option>
        <option>Rating Tertinggi</option>
        <option>Terbaru</option>
      </select>
    </div>
    </div>

  <div class="produk-card">
    <table class="produk-tabel">
      <thead>
        <tr>
          <th>Gambar</th>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Total Terjual</th>
          <th>Komisi</th>
          <th>Rating</th>
          <th>Stok</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><img src="/assets/img/implora.png" class="produk-img" /></td>
          <td>Nama Produk A</td>
          <td>Rp120.000</td>
          <td>200</td>
          <td><span class="komisi-badge tinggi">15%</span></td>
          <td>4.8</td>
          <td>34</td>
        </tr>
        <!-- Tambah produk lain di sini -->
      </tbody>
    </table>
  </div>
</div>

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
