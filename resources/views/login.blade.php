<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Admin - Tokolabs</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  </style>
</head>
<body>
  <div class="container">
    <div class="left">
      <img src="/assets/img/tokolabs.png" alt="Ilustrasi Login Tokolabs" />
    </div>
    <div class="right">
      <h2>Welcome Back!</h2>
      <form method="POST" action="/login">
        @csrf

        <div class="form-group">
          <i class="fas fa-envelope"></i>
          <input type="text" name="email" placeholder=" " required />
          <label>Email</label>
        </div>

        <div class="form-group">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" placeholder=" " required />
          <label>Password</label>
        </div>

        <div class="forgot-link">
          <a href="javascript:void(0)" onclick="openModal()">Lupa Password?</a>
        </div>

        <button type="submit">Login</button>

        @if ($errors->any())
          <p style="color:red; margin-top:10px;">{{ $errors->first() }}</p>
        @endif
      </form>
    </div>
  </div>

  <!-- Modal -->
  <!-- Modal -->
<div id="modal" class="modal">
  <div class="modal-box">
    <img src="/assets/img/tokolabs.png" alt="Lock Icon" style="max-width: 100px; margin-bottom: 10px;">
    <h3>Lupa Password</h3>
    
    <div class="form-group">
      <i class="fas fa-envelope"></i>
      <input type="email" placeholder=" " required />
      <label>Masukkan Email</label>
    </div>

    <div class="modal-buttons">
      <button class="send">Kirim</button>
      <button class="close" onclick="closeModal()">Tutup</button>
    </div>
  </div>
</div>

  <script>
    function openModal() {
      document.getElementById('modal').style.display = 'flex';
    }

    function closeModal() {
      document.getElementById('modal').style.display = 'none';
    }

    // Tutup modal jika klik di luar kotak
    window.onclick = function(event) {
      const modal = document.getElementById('modal');
      if (event.target == modal) {
        closeModal();
      }
    }
  </script>
</body>
</html>
