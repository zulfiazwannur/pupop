<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Mitra</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    body {
      background-color: #F7FAFC;
      color: #2D3748;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .navbar {
      background-color: #2BB6C4;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 1000;
      padding: 16px 45px;
      border-bottom-left-radius: 28px;
      border-bottom-right-radius: 28px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    }

    .nav-left {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .nav-center {
      display: flex;
      gap: 36px;
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
    }

    .nav-link {
      color: rgba(255, 255, 255, 0.9);
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      transition: all 0.2s ease;
    }

    .nav-link:hover {
      color: #ffffff;
      font-weight: 700;
    }

    .nav-actions {
      display: flex;
      align-items: center;
      gap: 22px;
    }

    .nav-icon-btn {
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.2s;
    }
    .nav-icon-btn:hover {
      transform: scale(1.1);
    }

    .container {
      max-width: 1080px;
      margin: 40px auto;
      padding: 0 24px;
      width: 100%;
    }

    .profile-card-main {
      background: #ffffff;
      border-radius: 24px;
      padding: 32px 40px;
      border: 1px solid rgba(226, 232, 240, 0.6);
      margin-bottom: 24px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }

    .profile-top-info {
      display: flex;
      align-items: center;
      gap: 24px;
    }

    .avatar-wrapper {
      position: relative;
      width: 105px;
      height: 105px;
      border-radius: 50%;
      border: 4px solid #fff;
      box-shadow: 0 4px 10px rgba(0,0,0,0.08);
      background-color: #E53935;
    }
    .avatar-wrapper img {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      object-fit: cover;
    }
    .verified-badge {
      position: absolute;
      bottom: 0px;
      right: 0px;
      width: 28px;
      height: 28px;
      background: #00796B;
      border: 3px solid #fff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
    }

    .user-info-text .name-row {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 8px;
    }
    .user-info-text h2 {
      font-size: 24px;
      font-weight: 800;
      color: #005B66;
    }
    .premium-tag {
      background-color: #E0F2F1;
      color: #00796B;
      font-size: 10px;
      font-weight: 700;
      padding: 4px 10px;
      border-radius: 12px;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }
    .location-row {
      display: flex;
      align-items: center;
      gap: 6px;
      color: #718096;
      font-size: 14px;
      font-weight: 500;
    }

    .profile-divider {
      border: none;
      border-top: 1px solid #E2E8F0;
      margin: 28px 0;
    }

    .profile-stats-row {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
    }
    .stat-block .s-val {
      font-size: 18px;
      font-weight: 800;
      color: #1a202c;
      margin-bottom: 4px;
    }
    .stat-block .s-label {
      font-size: 13px;
      color: #718096;
      font-weight: 500;
    }

    .settings-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
      margin-bottom: 24px;
    }
    .setting-card {
      background: #ffffff;
      border-radius: 24px;
      padding: 28px 32px;
      border: 1px solid rgba(226, 232, 240, 0.6);
      box-shadow: 0 4px 15px rgb(0 0 0 / 0.18);
      display: flex;
      flex-direction: column;
      cursor: pointer;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .setting-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgb(0 0 0 / 0.25);
    }
    .s-icon-bg {
      width: 40px;
      height: 40px;
      background: #E6F7F8;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #00796B;
      margin-bottom: 16px;
    }
    .setting-card h3 {
      font-size: 16px;
      font-weight: 800;
      color: #005B66;
      margin-bottom: 6px;
    }
    .setting-card p {
      font-size: 13px;
      color: #718096;
      line-height: 1.5;
    }

    .profile-bottom-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #ffffff;
      border: 1px solid rgba(226, 232, 240, 0.6);
      box-shadow: 0 4px 15px rgba(0,0,0,0.02);
      border-radius: 24px;
      padding: 20px 32px;
    }
    .account-status {
      font-size: 14px;
      color: #718096;
    }
    .account-status span {
      color: #00796B;
      font-weight: 700;
    }
    .profile-actions {
      display: flex;
      gap: 16px;
    }
    .btn-outline {
      background: transparent;
      border: 1px solid #005B66;
      color: #005B66;
      padding: 10px 24px;
      border-radius: 30px;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.2s;
    }
    .btn-outline:hover { background: #E6F7F8; }

    .btn-danger {
      background: #C62828;
      border: none;
      color: #fff;
      padding: 10px 24px;
      border-radius: 30px;
      font-weight: 600;
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      transition: background 0.2s;
    }
    .btn-danger:hover { background: #b71c1c; }
  </style>
</head>
<body>
@include('partials.flash')

<nav class="navbar">
  <div class="nav-left">
    <div class="logo-container">
      <img src="{{ asset('img/mitra/LOGO.png') }}" alt="Logo" class="logo-icon-main" style="height: 50px">
    </div>
  </div>

  <div class="nav-center">
    <a href="{{ route('mitra.home') }}" class="nav-link">Home</a>
    <a href="{{ route('mitra.manajemen') }}" class="nav-link">Mitra Manajemen</a>
    <a href="{{ route('mitra.riwayat') }}" class="nav-link">Riwayat</a>
  </div>

  <div class="nav-actions">
    <div class="nav-icon-btn">
      <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/></svg>
    </div>
    <div class="nav-icon-btn" id="navProfile">
      <svg width="22" height="22" fill="currentColor" viewBox="0 0 16 16"><path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>
    </div>
  </div>
</nav>

<div id="profileView">
  <main class="container">

    <div class="profile-card-main">
      <div class="profile-top-info">
        <div class="avatar-wrapper">
          <img src="{{ $fotoProfil }}" alt="Profile Picture">
          <div class="verified-badge">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
          </div>
        </div>
        <div class="user-info-text">
          <div class="name-row">
            <h2>{{ $user->name }}</h2>
            <span class="premium-tag">PREMIUM MEMBER</span>
          </div>
          <div class="location-row">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
            {{ $lokasi?->alamat ?? ($user->lokasi ?: 'Lokasi belum diisi') }}
          </div>
        </div>
      </div>

      <hr class="profile-divider">

      <div class="profile-stats-row">
        <div class="stat-block">
          <div class="s-val">{{ $layananSelesai }}</div>
          <div class="s-label">Layanan Selesai</div>
        </div>
        <div class="stat-block">
          <div class="s-val">{{ number_format($user->poin, 0, ',', '.') }}</div>
          <div class="s-label">Poin Mitra</div>
        </div>
        <div class="stat-block">
          <div class="s-val">{{ $user->created_at->format('Y') }}</div>
          <div class="s-label">Bergabung sejak</div>
        </div>
      </div>
    </div>

    <div class="settings-grid">
      <div class="setting-card" onclick="pmBuka()" style="cursor:pointer;">
        <div class="s-icon-bg">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        </div>
        <h3>Informasi Akun</h3>
        <p>Kelola detail profil, ubah foto, atau hapus akun.</p>
      </div>

      <div class="setting-card">
        <div class="s-icon-bg">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
        </div>
        <h3>Manajemen Mitra</h3>
        <p>Atur tim dan anggota mitra di bawah naungan Anda.</p>
      </div>

      <div class="setting-card">
        <div class="s-icon-bg">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
        </div>
        <h3>Bantuan</h3>
        <p>Pusat bantuan dan panduan penggunaan aplikasi.</p>
      </div>

      <div class="setting-card">
        <div class="s-icon-bg">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
        </div>
        <h3>Kebijakan Privasi</h3>
        <p>Informasi mengenai keamanan dan data pribadi<br>Anda.</p>
      </div>
    </div>

    <div class="profile-bottom-bar">
      <div class="account-status">
        Status Mitra: <span>Aktif</span>
      </div>
      <div class="profile-actions">
        <form method="POST" action="{{ route('logout') }}" style="display:contents">
          @csrf
          <input type="hidden" name="tujuan" value="signin">
          <button type="submit" class="btn-outline">Ganti Akun</button>
        </form>
        <form method="POST" action="{{ route('logout') }}" style="display:contents" onsubmit="return confirm('Apakah Anda yakin ingin keluar?')">
          @csrf
          <input type="hidden" name="tujuan" value="signup">
          <button type="submit" class="btn-danger">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            Keluar
          </button>
        </form>
      </div>
    </div>
  </main>
</div>

@include('partials.profile-modal')

</body>
</html>
