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
      <li><a href="profile"><i class="fa-solid fa-gear"></i> <span class="menu-text">Pengaturan Akun</span></a></li>
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
        <div class="greetingg">Hi, {{ auth()->user()->username ?? auth()->user()->name }}!</div>
          <a href="{{ route('profile') }}">
            <div class="avatar" style="cursor: pointer;">
              <img src="{{ auth()->user()->img_profile ? asset('img_profiles/' . auth()->user()->img_profile) : asset('assets/img/profil.jpg') }}" 
                  alt="Profil" />
          </div>
        </a>
      </div>
    </div>

  <div class="kembali-wrapper">
  <button class="btn-kembali" onclick="window.history.back()">
    <span>Kembali</span>
  </button>
</div>

<div class="kategori-wrapper">
    <div class="kategori-header">
    <h3>Kategori saat ini</h3>
    <button class="btn-simpan">
      <i class="fa-solid fa-save"></i> Simpan
      </button>
  </div>
  <div class="kategori-saat-ini">
    @if(isset($liveAccount) && $liveAccount)
      <form id="formKategori" method="POST" action="{{ route('live_accounts.categories.update', $liveAccount->id) }}">
        @csrf
        @method('PUT')

        <div id="kategoriTerpilihContainer">
          @forelse ($liveAccount->categories as $kategori)
            <div class="kategori-box" data-id="{{ $kategori->id }}">
              <div class="left" style="display:flex; align-items:center; gap:8px;">
                @if(!empty($kategori->icon_url))
                  <img src="{{ $kategori->icon_url }}" alt="{{ $kategori->name }}" style="width:24px; height:24px; object-fit:contain;">
                @else
                  <span style="width:24px; height:24px; display:inline-block; background:#ccc;"></span>
                @endif
                <span>{{ $kategori->name }}</span>
              </div>

              <form method="POST" action="{{ route('live_accounts.categories.destroy', ['liveAccountId' => $liveAccount->id, 'categoryId' => $kategori->id]) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="hapus-btn" onclick="return confirm('Yakin ingin menghapus kategori ini?')" style="background:none; border:none; cursor:pointer;">
                  <img src="https://cdn-icons-png.flaticon.com/128/484/484662.png" alt="hapus" style="width:20px; height:20px;">
                </button>
              </form>

              <input type="hidden" name="categories[]" value="{{ $kategori->id }}">
            </div>
          @empty
            <p>Anda belum memilih Kategori</p>
          @endforelse
        </div>
      </form>
    @else
      <p>Anda belum memilih Kategori</p>
    @endif
  </div>
</div>


  <div class="kategori-tersedia">
  <h3 class="kategori-title">kategori tersedia</h3>
  <h3></h3>
   <h3></h3>
  @foreach ($categories as $category)
    <div class="kategori-item">
      <img src="{{ $category->icon_url }}" alt="{{ $category->name }}">
      <span>{{ $category->name }}</span>
    </div>
  @endforeach
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

        // Hapus dulu teks "Anda belum memilih Kategori" jika ada
        const pesanKosong = kategoriSaatIniContainer.querySelector("p");
        if (pesanKosong) {
          pesanKosong.remove();
        }
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

        // Hapus kategori dari kategori saat ini
        newKategoriBox.remove();

        // Jika tidak ada kategori tersisa di kategori-saat-ini selain <h3>, tampilkan pesan kosong
        if (kategoriSaatIniContainer.querySelectorAll(".kategori-box").length === 0) {
          const pesanKosong = document.createElement("p");
          pesanKosong.textContent = "Anda belum memilih Kategori";
          kategoriSaatIniContainer.appendChild(pesanKosong);
        }
        });
      });
    });
  });

  function updateKategoriDisplay(kategori) {
  const container = document.querySelector('.kategori-saat-ini');
  if (kategori) {
    container.innerHTML = `
      <h3>Kategori saat ini</h3>
      <div class="kategori-box">
        <div class="left">
          <img src="${kategori.icon}" alt="${kategori.nama}">
          <span>${kategori.nama}</span>
        </div>
        <button class="hapus-btn">
          <img src="https://cdn-icons-png.flaticon.com/128/484/484662.png" alt="hapus">
        </button>
      </div>
    `;
  } else {
    container.innerHTML = `
      <h3>Kategori saat ini</h3>
      <p>Anda belum memilih Kategori</p>
    `;
  }
}
</script>