<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Rekomendasi Produk - TokoLabs</title>
  <link rel="stylesheet" href="{{ asset('assets/css/kategori.css') }}">
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
      <li><a href="dashboard"><i class="fa-solid fa-gauge-high"></i> <span class="menu-text">Dashboard</span></a></li>
      <li class="etalase active"><a href="#"><i class="fa-solid fa-cart-shopping"></i> <span class="menu-text">Rekomendasi Produk</span></a></li>
      <li><a href="schedule"><i class="fa-solid fa-calendar-days"></i> <span class="menu-text">Scheduler</span></a></li>
      <li><a href="akun"><i class="fa-solid fa-gear"></i> <span class="menu-text">Pengaturan Akun</span></a></li>
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
      <!-- Hi, Welda dan avatar saja -->
      <div class="greetingg">Hi, Welda!</div>
      <div class="avatar">
        <img src="/assets/img/profil.jpg" alt="Profil" />
      </div>
    </div>
  </div>

  <div class="kembali-wrapper">
  <button class="btn-kembali" onclick="window.history.back()">
    <span>Kembali</span>
  </button>
</div>

  <div class="kategori-wrapper">
  <div class="kategori-saat-ini">
    <h3>kategori saat ini</h3>
  <div class="kategori-box">
    <div class="left">
      <img src="https://img.icons8.com/external-photo3ideastudio-flat-photo3ideastudio/64/external-makeup-supermarket-photo3ideastudio-flat-photo3ideastudio.png" alt="Perawatan & Kecantikan">
      <span>Perawatan & Kecantikan</span>
    </div>
    <button class="hapus-btn">
      <img src="https://cdn-icons-png.flaticon.com/128/484/484662.png" alt="hapus">
    </button>
  </div>

  <div class="kategori-tersedia">
  <h3 class="kategori-title">kategori tersedia</h3>
  <h3></h3>
   <h3></h3>
  <div class="kategori-item">
    <img src="https://img.icons8.com/color/48/diamond.png" alt="Aksesoris">
    <span>Aksesoris</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/emoji/48/baby-bottle-emoji.png" alt="Ibu & Bayi">
    <span>Ibu & Bayi</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/emoji/48/dress.png" alt="Pakaian Wanita">
    <span>Pakaian Wanita</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/color/48/open-book--v1.png" alt="Buku & Alat Tulis">
    <span>Buku & Alat Tulis</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/color/48/watches-front-view.png" alt="Jam Tangan">
    <span>Jam Tangan</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/external-photo3ideastudio-flat-photo3ideastudio/64/external-makeup-supermarket-photo3ideastudio-flat-photo3ideastudio.png" alt="Perawatan & Kecantikan">
    <span>Perawatan & Kecantikan</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/color/48/tv.png" alt="Elektronik">
    <span>Elektronik</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/external-icongeek26-flat-icongeek26/64/external-Medication-obesity-icongeek26-flat-icongeek26.png" alt="Kesehatan">
    <span>Kesehatan</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/external-nawicon-flat-nawicon/64/external-frying-pan-kitchen-nawicon-flat-nawicon.png" alt="Perlengkapan Rumah">
    <span>Perlengkapan Rumah</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/color/48/onesie.png" alt="Fashion Bayi & Anak">
    <span>Fashion Bayi & Anak</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/color/48/laptop--v1.png" alt="Komputer & Aksesoris">
    <span>Komputer & Aksesoris</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/emoji/48/mans-shoe.png" alt="Sepatu Pria">
    <span>Sepatu Pria</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/color/48/mosque.png" alt="Fashion Muslim">
    <span>Fashion Muslim</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/color/48/food-bar.png" alt="Makanan & Minuman">
    <span>Makanan & Minuman</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/external-smashingstocks-flat-smashing-stocks/66/external-Heels-shoes-and-footwear-smashingstocks-flat-smashing-stocks.png" alt="Sepatu Wanita">
    <span>Sepatu Wanita</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/color/48/old-time-camera.png" alt="Fotografi">
    <span>Fotografi</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/color/48/badminton.png" alt="Olahraga & Outdoor">
    <span>Olahraga & Outdoor</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/external-sbts2018-lineal-color-sbts2018/58/external-ballons-fathers-day-sbts2018-lineal-color-sbts2018.png" alt="Souvenir & Perlengkapan Pesta">
    <span>Souvenir & Perlengkapan Pesta</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/color/48/smartphone.png" alt="Handphone & Aksesoris">
    <span>Handphone & Aksesoris</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/color/48/motorbike-helmet.png" alt="Otomotif">
    <span>Otomotif</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/external-solidglyph-m-oki-orlando/32/external-waist-mens-fashion-solid-solidglyph-m-oki-orlando.png" alt="Tas Pria">
    <span>Tas Pria</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/emoji/48/guitar-emoji.png" alt="Hobi & Koleksi">
    <span>Hobi & Koleksi</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/fluency/50/polo-shirt.png" alt="Pakaian Pria">
    <span>Pakaian Pria</span>
  </div>
  <div class="kategori-item">
    <img src="https://img.icons8.com/fluency/50/bag-front-view.png" alt="Tas Wanita">
    <span>Tas Wanita</span>
  </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const kategoriSaatIniContainer = document.querySelector(".kategori-saat-ini");

    document.querySelectorAll(".kategori-item").forEach(item => {
      item.addEventListener("click", function () {
        const imgSrc = item.querySelector("img").src;
        const altText = item.querySelector("img").alt;
        const labelText = item.querySelector("span").innerText;

        // Cek apakah sudah ada di kategori saat ini
        const sudahAda = [...document.querySelectorAll(".kategori-saat-ini .kategori-box span")]
          .some(span => span.innerText === labelText);
        if (sudahAda) return;

        // Buat elemen baru
        const newKategoriBox = document.createElement("div");
        newKategoriBox.className = "kategori-box";

        newKategoriBox.innerHTML = `
          <div class="left">
            <img src="${imgSrc}" alt="${altText}">
            <span>${labelText}</span>
          </div>
          <button class="hapus-btn">
            <img src="https://cdn-icons-png.flaticon.com/128/484/484662.png" alt="hapus">
          </button>
        `;

        kategoriSaatIniContainer.appendChild(newKategoriBox);

        // Hapus dari kategori tersedia
        item.remove();

        // Tambahkan event ke tombol hapus
        newKategoriBox.querySelector(".hapus-btn").addEventListener("click", function () {
          // Buat kembali kategori-item dan masukkan ke bawah
          const newItem = document.createElement("div");
          newItem.className = "kategori-item";
          newItem.innerHTML = `
            <img src="${imgSrc}" alt="${altText}">
            <span>${labelText}</span>
          `;
          // Tambah event klik ke elemen baru
          newItem.addEventListener("click", arguments.callee);
          document.querySelector(".kategori-tersedia").appendChild(newItem);
          newKategoriBox.remove();
        });
      });
    });
  });
</script>