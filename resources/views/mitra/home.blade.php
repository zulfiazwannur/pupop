<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Mitra</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2 family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    body {
      background-color: #f2f9fa;
      color: #2D3748;
      min-height: 100vh;
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
      box-shadow: 0 8px 20px rgb(200 199 199);
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

    .nav-link.active, .nav-link:hover {
      color: #ffffff;
      font-weight: 700;
    }

    .nav-right {
      display: flex;
      align-items: center;
      gap: 24px;
    }

    .icon-btn {
      background: none;
      border: none;
      color: white;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.2s;
    }

    .icon-btn:hover {
      transform: scale(1.05);
    }

    .dashboard-container {
      max-width: 1280px;
      margin: 32px auto;
      padding: 0 40px;
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .top-row {
      display: grid;
      grid-template-columns: 1.4fr 1fr;
      gap: 24px;
      align-items: stretch;
    }

    .welcome-banner {
      background: white;
      border-radius: 24px;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      box-shadow: 0 10px 25px rgba(0, 122, 140, 0.03);
    }

    .welcome-banner img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .quick-stats {
      background: white;
      border-radius: 24px;
      padding: 28px 32px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
      box-shadow: 0 10px 25px rgba(0, 122, 140, 0.03);
    }

    .stat-box {
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .stat-header {
      display: flex;
      align-items: center;
      gap: 10px;
      color: #718096;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .stat-icon {
      width: 35px;
      height: 35px;
      object-fit: contain;
    }

    .stat-value {
      font-size: 26px;
      font-weight: 800;
      color: #1A202C;
      margin-bottom: 6px;
    }

    .stat-action {
      font-size: 11px;
      color: #007A8C;
      text-decoration: none;
      font-weight: 700;
    }

    .stat-action:hover {
      text-decoration: underline;
    }

    .main-grid {
      display: grid;
      grid-template-columns: 1.4fr 1fr;
      gap: 24px;
    }

    .grid-column {
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .card {
      background: white;
      border-radius: 24px;
      padding: 28px 32px;
      box-shadow: 0 10px 25px rgba(0, 122, 140, 0.03);
      display: flex;
      flex-direction: column;
    }

    .card-title {
      font-size: 18px;
      font-weight: 700;
      color: #1A202C;
      margin-bottom: 4px;
    }

    .card-subtitle {
      font-size: 13px;
      color: #A0AEC0;
      margin-bottom: 24px;
    }

    .features-layout {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 16px;
    }

    .feature-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background: rgba(38, 182, 196, 0.2);
      border: none;
      border-radius: 20px;
      padding: 17px 12px;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .feature-item:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      background: rgba(38, 182, 196, 0.3);
    }

    .feature-icon-wrapper {
      width: 45px;
      height: 45px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 12px;
    }

    .feature-icon {
      width: 80%;
      height: 100%;
      object-fit: contain;
    }

    .feature-label {
      font-size: 13px;
      font-weight: 700;
      color: #4A5568;
      text-align: center;
    }

    .schedule-box {
      background: #f4fafb;
      border-radius: 16px;
      padding: 16px 20px;
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 20px;
      border: 1px solid #eef7f8;
    }

    .schedule-icon {
      width: 45px;
      height: 45px;
      object-fit: contain;
      background: rgba(38, 182, 196, 0.2);
      border: none;
      border-radius: 10px;
      padding: 5px 5px;
    }

    .schedule-details p {
      font-size: 12px;
      color: #718096;
      margin-bottom: 2px;
    }

    .schedule-date {
      font-size: 14px;
      font-weight: 700;
      color: #006877;
    }

    .schedule-time {
      font-size: 11px;
      color: #a0aec0;
    }

    .storage-header-row {
      display: flex;
      justify-content: space-between;
      align-items: baseline;
      margin-bottom: 4px;
    }

    .storage-total {
      text-align: right;
    }

    .storage-total-label {
      font-size: 12px;
      color: #a0aec0;
      display: block;
    }

    .storage-total-value {
      font-size: 20px;
      font-weight: 700;
      color: #006877;
    }

    .progress-container {
      background: #edf2f7;
      border-radius: 100px;
      height: 14px;
      width: 100%;
      margin-top: 16px;
      margin-bottom: 24px;
      overflow: hidden;
    }

    .progress-bar {
      background: #1cb4c4;
      height: 100%;
      width: 80%;
      border-radius: 100px;
    }

    .storage-actions {
      display: grid;
      grid-template-columns: 1.2fr 1fr;
      gap: 16px;
    }

    .history-list {
      display: flex;
      flex-direction: column;
      margin-bottom: 20px;
    }

    .history-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 14px 0;
      border-bottom: 1px solid #edf2f7;
    }

    .history-text {
      font-size: 14px;
      color: #718096;
    }

    .history-text strong {
      color: #4A5568;
      font-weight: 700;
    }

    .check-icon {
      width: 20px;
      height: 20px;
      background: #1cb4c4;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 11px;
      font-weight: bold;
    }

    .check-icon::after {
      content: "✓";
    }

    .btn {
      padding: 12px 24px;
      border-radius: 100px;
      font-size: 14px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.2s;
      text-align: center;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .btn-primary {
      background: #1cb4c4;
      color: white;
      border: none;
    }

    .btn-primary:hover {
      background: #1593a1;
    }

    .btn-outline {
      background: transparent;
      color: #006877;
      border: 2px solid #006877;
    }

    .btn-outline:hover {
      background: #eef7f8;
    }

    .btn-secondary {
      background: #daecee;
      color: #5a7578;
      border: none;
    }

    .btn-secondary:hover {
      background: #cbdfe1;
    }

    .btn-full {
      width: 100%;
    }

    .btn-icon-img {
      width: 18px;
      height: 18px;
      object-fit: contain;
    }

    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.4);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 9999;
      font-family: 'Poppins', sans-serif;
      padding: 20px;
    }

    .modal-content {
      background-color: #ffffff;
      width: 100%;
      max-width: 900px;
      border-radius: 24px;
      position: relative;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      display: flex;
      flex-direction: column;
      overflow: hidden;
      animation: modalMuncul 0.3s ease-out;
    }

    @keyframes modalMuncul {
      from { opacity: 0; transform: translateY(20px) scale(0.95); }
      to { opacity: 1; transform: translateY(0) scale(1); }
    }

    .close-btn {
      position: absolute;
      top: 24px;
      right: 24px;
      width: 36px;
      height: 36px;
      background-color: #000000;
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      border: none;
      z-index: 10;
      transition: background 0.2s;
    }

    .close-btn:hover {
      background-color: #333333;
    }

    .close-btn svg {
      width: 16px;
      height: 16px;
      stroke-width: 3px;
    }

    .modal-body {
      padding: 40px 50px;
      padding-bottom: 30px;
    }

    .modal-title {
      font-size: 38px;
      font-weight: 800;
      color: #000000;
      margin-bottom: 24px;
      line-height: 1.2;
    }

    .desc-box {
      border: 1.5px solid #E2E8F0;
      border-radius: 16px;
      padding: 24px 30px;
      font-size: 17px;
      line-height: 1.6;
      color: #1A202C;
      margin-bottom: 30px;
    }

    .sdg-image-wrapper {
      width: 100%;
      display: flex;
      justify-content: center;
    }

    .sdg-img {
      width: 100%;
      max-width: 100%;
      height: auto;
      object-fit: contain;
    }

    .modal-footer {
      background-color: #E2E8F0;
      padding: 16px 50px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-footer-left {
      font-size: 11px;
      color: #4A5568;
      font-weight: 500;
    }

    .modal-footer-right {
      display: flex;
      gap: 20px;
    }

    .modal-footer-right a {
      font-size: 11px;
      color: #4A5568;
      text-decoration: none;
      font-weight: 500;
    }

    .modal-footer-right a:hover {
      color: #000;
    }

    @media (max-width: 768px) {
      .modal-body { padding: 30px 20px; }
      .modal-footer { flex-direction: column; gap: 10px; padding: 16px 20px; text-align: center; }
      .desc-box { font-size: 14px; padding: 16px; }
      .modal-title { font-size: 28px; }
    }
  </style>
</head>
<body>
@include('partials.flash')

<nav class="navbar">
  <div class="nav-left">
    <div class="logo-container">
      <img src="{{ asset('img/mitra/LOGO.png') }}" alt="Logo Icon" class="logo-icon-main" style="height: 50px">
    </div>
  </div>

  <div class="nav-center">
    <a href="#" class="nav-link active">Home</a>
    <a href="{{ route('mitra.manajemen') }}" class="nav-link">Mitra Manajemen</a>
    <a href="{{ route('mitra.riwayat') }}" class="nav-link">Riwayat</a>
  </div>

  <div class="nav-right">
    <button class="icon-btn" title="Notifikasi">
      <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/></svg>
    </button>
    <button class="icon-btn" title="Profil" onclick="window.location.href='{{ route('mitra.profile') }}'">
      <svg width="22" height="22" fill="currentColor" viewBox="0 0 16 16"><path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>
    </button>
  </div>
</nav>

<main class="dashboard-container">

  <div class="top-row">
    <div class="welcome-banner">
      <img src="{{ asset('img/mitra/Group 182.png') }}" alt="Selamat Datang {{ $user->name }}">
      <p style="margin-top:6px;font-size:14px;font-weight:600;color:#005B66;">Selamat datang, {{ $user->name }}</p>
    </div>

    <div class="quick-stats">
      <div class="stat-box">
        <div class="stat-header">
          <img src="{{ asset('img/mitra/7.png') }}" alt="Poin" class="stat-icon">
          <span>Poin Anda</span>
        </div>
        <div class="stat-value">{{ number_format($user->poin, 0, ',', '.') }} poin</div>
        <a href="#" class="stat-action">Tukarkan poin ke voucher, yuk</a>
      </div>
      <div class="stat-box">
        <div class="stat-header">
          <img src="{{ asset('img/mitra/8.png') }}" alt="Saldo" class="stat-icon">
          <span>Saldo Anda</span>
        </div>
        <div class="stat-value">Rp. {{ number_format($user->saldo, 0, ',', '.') }}</div>
        <a href="{{ route('mitra.tarik') }}" class="stat-action">Ayo, cairkan saldo kamu</a>
      </div>
    </div>
  </div>

  <div class="main-grid">

    <div class="grid-column">
      <div class="card">
        <h2 class="card-title">Fitur Kemitraan</h2>
        <p class="card-subtitle">Fitur lengkap transaksi penjualan anda</p>

        <div class="features-layout">
          <div class="feature-item">
            <div class="feature-icon-wrapper"><img src="{{ asset('img/mitra/1.png') }}" alt="Laporan" class="feature-icon" onclick="window.location.href ='{{ route('mitra.laporan') }}'"></div>
            <span class="feature-label">Laporan</span>
          </div>
          <div class="feature-item">
            <div class="feature-icon-wrapper"><img src="{{ asset('img/mitra/2.png') }}" alt="Pickup" class="feature-icon" onclick="window.location.href ='{{ route('mitra.pickup') }}'"></div>
            <span class="feature-label">Pickup</span>
          </div>
          <div class="feature-item">
            <div class="feature-icon-wrapper"><img src="{{ asset('img/mitra/3.png') }}" alt="Terima Setor" class="feature-icon" onclick="window.location.href ='{{ route('mitra.terima') }}'"></div>
            <span class="feature-label">Terima Setor</span>
          </div>
          <div class="feature-item">
            <div class="feature-icon-wrapper"><img src="{{ asset('img/mitra/4.png') }}" alt="Tarik Saldo" class="feature-icon" onclick="window.location.href ='{{ route('mitra.tarik') }}'"></div>
            <span class="feature-label">Tarik Saldo</span>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="storage-header-row">
          <div>
            <h2 class="card-title">Status Penampungan</h2>
            <p class="card-subtitle" style="margin-bottom: 0;">Kapasitas penyimpanan unit mitra saat ini</p>
          </div>
          <div class="storage-total">
            <span class="storage-total-label">Total ditampung:</span>
            <span class="storage-total-value">{{ number_format($usaha?->terisi ?? 0, 2, ',', '.') }} pcs</span>
          </div>
        </div>

        <div class="progress-container">
          <div class="progress-bar" style="width: {{ $usaha?->persenTerisi() ?? 0 }}%"></div>
        </div>

        <div class="storage-actions">
          <button class="btn btn-primary" id="btnMintaPickup" onclick="window.location.href ='{{ route('mitra.pickup') }}'">
            <img src="{{ asset('img/mitra/5.png') }}" alt="Truck" class="btn-icon-img" style="filter: brightness(0) invert(1);">
            Minta Pickup Lebih Cepat
          </button>
          <button class="btn btn-secondary" id="btnDetailPenyimpanan" onclick="window.location.href ='{{ route('mitra.usaha.edit') }}'">Detail Penyimpanan</button>
        </div>
      </div>
    </div>

    <div class="grid-column">
      <div class="card">
        <h2 class="card-title">Jadwal Pickup</h2>
        <p class="card-subtitle">&nbsp;</p>

        <div class="schedule-box">
          <img src="{{ asset('img/mitra/6.png') }}" alt="Fast Truck" class="schedule-icon">
          <div class="schedule-details">
            <p>Pickup berikutnya:</p>
            @if ($pickup)
            <div class="schedule-date">{{ $pickup->tanggal->locale('id')->translatedFormat('l, d F Y') }}</div>
            <div class="schedule-time">{{ $pickup->lokasi?->nama }}</div>
            @else
            <div class="schedule-date">Belum ada jadwal</div>
            <div class="schedule-time">Ajukan pickup lewat tombol di bawah</div>
            @endif
          </div>
        </div>

        <button class="btn btn-outline btn-full" id="btnLihatJadwal" onclick="window.location.href ='{{ route('mitra.pickup') }}'">Lihat Jadwal Lengkap</button>
      </div>

      <div class="card">
        <h2 class="card-title">Riwayat Transaksi</h2>
        <p class="card-subtitle">&nbsp;</p>

        <div class="history-list">
          @forelse ($riwayat as $r)
          <div class="history-item" @if ($loop->last) style="border-bottom: none;" @endif>
            @if ($r->tipe === 'setor')
              <span class="history-text"><strong>{{ $r->nama }}</strong> setor {{ number_format($r->jumlah_pcs, 2, ',', '.') }} pcs popok</span>
            @else
              <span class="history-text" style="color: #4A5568; font-weight: 600;">{{ $r->nama }}:<br><span style="color: #1cb4c4;">{{ $r->tipe === 'tarik' ? '- ' : '+ ' }}Rp.{{ number_format($r->nominal, 0, ',', '.') }}{{ $r->poin ? ', + ' . $r->poin . ' Poin' : '' }}</span></span>
            @endif
            <div class="check-icon"></div>
          </div>
          @empty
          <div class="history-item" style="border-bottom: none;">
            <span class="history-text">Belum ada transaksi.</span>
          </div>
          @endforelse
        </div>

        <button class="btn btn-primary btn-full" id="btnSelengkapnya" onclick="window.location.href ='{{ route('mitra.riwayat') }}'">Selengkapnya</button>
      </div>
    </div>

  </div>
</main>

<div class="modal-overlay" id="aboutPopup">
  <div class="modal-content">

    <button class="close-btn" id="closePopupBtn" aria-label="Tutup">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </svg>
    </button>

    <div class="modal-body">
      <h1 class="modal-title">About Website</h1>

      <div class="desc-box">
        Website manajemen limbah popok berbasis website dengan mengintegrasikan ekonomi sirkular melalui penukaran popok menjadi poin dan poin ditukar menjadi produk dimana popok nantinya akan diolah menjadi produk bernilai seperti pupuk dan lain lain. Hal ini selaras dengan Konsep Pembangunan Berkelanjutan atau Sustainable Development Goals (SDGs)
      </div>

      <div class="sdg-image-wrapper">
        <img src="{{ asset('img/mitra/SDGSs.png') }}" alt="Sustainable Development Goals" class="sdg-img">
      </div>

    </div>

    <div class="modal-footer">
      <div class="modal-footer-left">
        © 2026 PuPoP. Towards a Zero-Waste Future.
      </div>
      <div class="modal-footer-right">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">SDG Commitment</a>
        <a href="#">Contact</a>
      </div>
    </div>

  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const popup = document.getElementById("aboutPopup");
    const closeBtn = document.getElementById("closePopupBtn");

    if (!sessionStorage.getItem('aboutPopupShown')) {
      setTimeout(() => {
        popup.style.display = "flex";
      }, 300);

      sessionStorage.setItem('aboutPopupShown', 'true');
    }

    closeBtn.addEventListener("click", function() {
      popup.style.display = "none";
    });
  });
</script>
</body>
</html>
