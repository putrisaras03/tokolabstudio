<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Admin - Tokolabs</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body>
  <div class="container">
    <div class="left">
      <img src="/assets/img/tokolabs.png" alt="Ilustrasi Login Tokolabs" />
    </div>
    <div class="right">
      <h2>Welcome Back!</h2>
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
          <i class="fas fa-envelope"></i>
          <input type="text" name="email" placeholder=" " value="{{ old('email') }}" required />
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

        {{-- Tampilkan error hanya dari login --}}
        @if ($errors->has('email') || $errors->has('password'))
          <p style="color:red; margin-top:10px;">{{ $errors->first() }}</p>
        @endif
      </form>
    </div>
  </div>

  <!-- Modal Lupa Password -->
  <div id="modal" class="modal" style="display:none; align-items:center; justify-content:center; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5);">
    <div class="modal-box" style="background:#fff; padding:20px; border-radius:8px; max-width:400px; width:100%; text-align:center;">
      <img src="/assets/img/tokolabs.png" alt="Lock Icon" style="max-width: 100px; margin-bottom: 10px;">
      <h3>Lupa Password</h3>

      {{-- Form OTP --}}
      <form method="POST" action="{{ route('password.sendOtp') }}">
        @csrf

        <div class="form-group">
          <i class="fas fa-envelope"></i>
          <input type="text" name="phone" placeholder=" " value="{{ old('phone') }}" required />
          <label>Masukkan Nomor WhatsApp</label>
        </div>

        {{-- Error OTP --}}
        @if ($errors->has('phone'))
            <small style="color: #ff0000; display:block; margin-bottom:10px;">{{ $errors->first('phone') }}</small>
        @endif

        {{-- Sukses OTP --}}
        @if (session('success'))
            <small style="color: #008000; display:block; margin-bottom:10px;">{{ session('success') }}</small>
        @endif

        <div class="modal-buttons" style="display:flex; justify-content:center; gap:10px;">
          <button type="submit" class="send" style="padding:10px 20px; background:#28a745; color:#fff; border:none; border-radius:4px; cursor:pointer;">Kirim</button>
          <button type="button" class="close" onclick="closeModal()" style="padding:10px 20px; background:#dc3545; color:#fff; border:none; border-radius:4px; cursor:pointer;">Tutup</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Script -->
  <script>
    function openModal() {
      document.getElementById('modal').style.display = 'flex';
    }

    function closeModal() {
      document.getElementById('modal').style.display = 'none';
    }

    window.onclick = function(event) {
      const modal = document.getElementById('modal');
      if (event.target == modal) {
        closeModal();
      }
    }

    // Auto-buka modal jika error/sukses dari OTP
    @if ($errors->has('phone') || session('success'))
      openModal();
    @endif
  </script>
</body>
</html>
