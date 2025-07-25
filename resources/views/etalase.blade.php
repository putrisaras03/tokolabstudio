<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Produk - TokoLabs</title>
  <link rel="stylesheet" href="{{ asset('assets/css/ubah_password.css') }}">
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
      <li><a href="produk"><i class="fa-solid fa-cart-shopping"></i> <span class="menu-text">Produk</span></a></li>
      <li><a href="schedule"><i class="fa-solid fa-calendar-days"></i> <span class="menu-text">Scheduler</span></a></li>
      
      <li class="produk active"><a href="#"><i class="fa-solid fa-cart-shopping"></i> <span class="menu-text">Produk</span></a></li>
      <li><a href="etalase"><i class="fa-solid fa-user-gear"></i> <span class="menu-text">Manajemen & Etalase</span></a></li>
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

    <div class="container-etalase">
  <h2>Manajemen Etalase</h2>

  <div class="etalase-actions">
    <button class="btn btn-tambah">+ Tambah Etalase</button>
  </div>

  <div class="etalase-list">
    <div class="etalase-item">
      <span class="etalase-nama">Elektronik</span>
      <div class="etalase-buttons">
        <button class="btn-edit">Edit</button>
        <button class="btn-hapus">Hapus</button>
      </div>
    </div>

    <div class="etalase-item">
      <span class="etalase-nama">Fashion</span>
      <div class="etalase-buttons">
        <button class="btn-edit">Edit</button>
        <button class="btn-hapus">Hapus</button>
      </div>
    </div>

    <!-- Tambahkan etalase lain di sini -->
  </div>
</div>