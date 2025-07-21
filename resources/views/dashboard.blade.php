<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard TokoLabs</title>
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
      <li class="dashboard active"><a href="#"><i class="fa-solid fa-gauge-high"></i> <span class="menu-text">Dashboard</span></a></li>
      <li><a href="akun"><i class="fa-solid fa-user-gear"></i> <span class="menu-text">Manajemen Akun</span></a></li>
      <li><a href="produk"><i class="fa-solid fa-cloud-arrow-down"></i> <span class="menu-text">Scrapping Produk</span></a></li>
      <li><a href="analitik"><i class="fa-solid fa-chart-line"></i> <span class="menu-text">Analisis Produk</span></a></li>
      <li><a href="rekomendasi"><i class="fa-solid fa-star"></i> <span class="menu-text">Rekomendasi Produk</span></a></li>
      <li><a href="etalase"><i class="fa-solid fa-calendar-days"></i> <span class="menu-text">Etalase live</span></a></li>
    </ul>
  </aside>

  <!-- Main Content -->
  <div class="main-content" id="mainContent">
    <div class="navbar">
      <div class="nav-title">Dashboard</div>
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

    <!-- Dashboard -->
    <div class="dashboard">
      <div class="chart-grid">
        <div class="chart-half">
          <h4>Total Penjualan Bulanan</h4>
          <canvas id="lineChart"></canvas>
        </div>
        <div class="chart-half">
          <h4>Produk Tren Naik</h4>
          <canvas id="pieChart"></canvas>
        </div>
        <div class="chart-full">
          <h3>Penjualan Terlaris & Viral</h3>
          <canvas id="barChart"></canvas>
        </div>
      </div>

      <!-- tabel -->
      <div class="produk-tabel">
        <h3>Data Produk Populer</h3>
        <table>
          <thead>
            <tr>
              <th>Nama Produk</th>
              <th>Harga</th>
              <th>Terjual</th>
              <th>Komisi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>[3 Pcs] Implora Permanent Hair Color - Warna Alami Tahan Lama</td>
              <td>Rp15.000</td>
              <td>10RB+</td>
              <td><span class="badge-komisi rendah">9%</span></td>
            </tr>
            <tr>
              <td>Lip Cream Matte Implora 4g - Soft Brown</td>
              <td>Rp20.000</td>
              <td>8RB+</td>
              <td><span class="badge-komisi tinggi">15%</span></td>
            </tr>
            <tr>
              <td>Eyebrow Pencil Waterproof - Hitam Natural</td>
              <td>Rp12.000</td>
              <td>6RB+</td>
              <td><span class="badge-komisi tinggi">13%</span></td>
            </tr>
            <tr>
              <td>Maskara Lentik Volume Implora</td>
              <td>Rp18.000</td>
              <td>4RB+</td>
              <td><span class="badge-komisi rendah">9%</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Script Chart -->
<script>
  new Chart(document.getElementById("lineChart"), {
    type: 'line',
    data: {
      labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul"],
      datasets: [{
        label: "Total Penjualan",
        data: [5000000, 5800000, 6000000, 7500000, 9000000, 11000000, 12300000],
        borderColor: "#10b981",
        backgroundColor: "rgba(16, 185, 129, 0.2)",
        fill: true,
        tension: 0.4
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: { beginAtZero: true }
      }
    }
  });

  new Chart(document.getElementById("pieChart"), {
    type: 'doughnut',
    data: {
      labels: ["Hijab Instan", "Tas Wanita", "Jam Tangan"],
      datasets: [{
        data: [34, 25, 21],
        backgroundColor: ['#3b82f6', '#6366f1', '#10b981']
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' }
      }
    }
  });

  new Chart(document.getElementById("barChart"), {
    type: 'bar',
    data: {
      labels: ["Tas Ransel", "Sneakers", "Jaket", "Hijab", "Smartwatch"],
      datasets: [{
        label: "Penjualan (Rp)",
        data: [4500000, 4200000, 3900000, 3600000, 3000000],
        backgroundColor: '#4f46e5'
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: { beginAtZero: true }
      }
    }
  });

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
