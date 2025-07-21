<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Manajemen Akun - TokoLabs</title>
  <link rel="stylesheet" href="{{ asset('assets/css/akun.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
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
      <li class="akun active"><a href="#"><i class="fa-solid fa-user-gear"></i> <span class="menu-text">Manajemen Akun</span></a></li>
      <li><a href="produk"><i class="fa-solid fa-cloud-arrow-down"></i> <span class="menu-text">Scrapping Produk</span></a></li>
      <li><a href="analitik"><i class="fa-solid fa-chart-line"></i> <span class="menu-text">Analisis Produk</span></a></li>
      <li><a href="rekomendasi"><i class="fa-solid fa-star"></i> <span class="menu-text">Rekomendasi Produk</span></a></li>
      <li><a href="etalase"><i class="fa-solid fa-calendar-days"></i> <span class="menu-text">Etalase live</span></a></li>
    </ul>
  </aside>

  <!-- Main Content -->
  <div class="main-content" id="mainContent">
    <div class="navbar">
      <div class="nav-title">Manajemen Akun</div>
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

      <!-- Konten Akun -->
      <section class="akun-wrapper">
        <div class="akun-header">
          <h2></h2>
          <button class="btn-tambah"><i class="fa fa-plus"></i> Tambah Akun</button>
        </div>

        <div class="table-container">
          <table class="akun-table">
            <thead>
              <tr>
                <th>Email</th>
                <th>Username</th>
                <th>Status</th>
                <th>Detail</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>user1@email.com</td>
                <td>user_shopee_01</td>
                <td><span class="badge sukses">Berhasil</span></td>
                <td><button class="btn-detail"><i class="fa fa-eye"></i> Lihat</button></td>
                <td class="aksi-btns">
                  <button class="btn-edit"><i class="fa fa-edit"></i></button>
                  <button class="btn-hapus"><i class="fa fa-trash"></i></button>
                </td>
              </tr>
              <tr>
                <td>user2@email.com</td>
                <td>user_aff_02</td>
                <td><span class="badge gagal">Gagal</span></td>
                <td><button class="btn-detail"><i class="fa fa-eye"></i> Lihat</button></td>
                <td class="aksi-btns">
                  <button class="btn-edit"><i class="fa fa-edit"></i></button>
                  <button class="btn-hapus"><i class="fa fa-trash"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
    </div>
  </div>

  <script>
    function toggleDropdown() {
    const menu = document.getElementById("dropdownMenu");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
  }

  function konfirmasiLogout() {
    const yakin = confirm("Apakah Anda yakin ingin logout?");
    if (yakin) window.location.href = "/";
  }

  document.addEventListener('click', function(event) {
    const dropdown = document.querySelector('.dropdown');
    const menu = document.getElementById("dropdownMenu");
    if (!dropdown.contains(event.target)) {
      menu.style.display = "none";
    }
  });

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
