<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Mitra</title>
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

    .management-container {
      max-width: 1280px;
      margin: 40px auto;
      padding: 0 40px;
      display: flex;
      flex-direction: column;
      gap: 32px;
    }

    .management-header-row {
      display: grid;
      grid-template-columns: 1.8fr 1fr;
      gap: 32px;
      align-items: center;
    }

    .welcome-mitra-box {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .welcome-mitra-img {
      height: 90px;
      width: auto;
      object-fit: contain;
    }

    .atur-toko-card {
      background: white;
      border-radius: 24px;
      padding: 24px 32px;
      display: flex;
      align-items: center;
      gap: 20px;
      box-shadow: 0 10px 25px rgb(0 0 0 / 0.15);
    }

    .daun-icon {
      width: 45px;
      height: 45px;
      object-fit: contain;
    }

    .atur-toko-text .title {
      font-size: 18px;
      font-weight: 700;
      color: #0F373E;
    }

    .atur-toko-text .subtitle {
      font-size: 15px;
      color: #718096;
      margin-top: 2px;
    }

    .management-grid-3 {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 32px;
    }

    .menu-card {
      background: white;
      border-radius: 24px;
      padding: 40px 32px;
      box-shadow:  0 10px 25px rgb(0 0 0 / 0.15);
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }

    .menu-icon-wrapper {
      width: 60px;
      height: 60px;
      background-color: #F0FAF9;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 24px;
    }

    .menu-icon-wrapper svg {
      width: 28px;
      height: 28px;
      color: #0F6A70;
    }

    .menu-title {
      font-size: 20px;
      font-weight: 700;
      color: #0F6A70;
      margin-bottom: 16px;
    }

    .menu-desc {
      font-size: 13.5px;
      color: #718096;
      line-height: 1.6;
      margin-bottom: 32px;
      min-height: 64px;
    }

    .btn-action {
      background-color: #2BB6C4;
      color: white;
      border: none;
      border-radius: 100px;
      padding: 14px 28px;
      font-size: 14px;
      font-weight: 700;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      width: 100%;
      transition: background 0.2s;
      text-decoration: none;
    }

    .btn-action:hover {
      background-color: #1FA0AE;
    }

    .btn-action svg {
      width: 18px;
      height: 18px;
    }

    .summary-activity-card {
      background: white;
      border-radius: 24px;
      padding: 24px 40px;
      box-shadow: 0 10px 25px rgb(0 0 0 / 0.15);
    }

    .summary-title {
      font-size: 12px;
      font-weight: 800;
      color: #718096;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      margin-bottom: 16px;
    }

    .summary-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      align-items: center;
    }

    .summary-item {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .summary-label {
      font-size: 13px;
      color: #A0AEC0;
      font-weight: 500;
    }

    .summary-value {
      font-size: 18px;
      font-weight: 700;
      color: #4A5568;
    }

    .val-date {
      color: #0F6A70;
    }

    .badge-status {
      background-color: #E2F6F8;
      color: #0F6A70;
      font-size: 13px;
      font-weight: 700;
      padding: 4px 14px;
      border-radius: 100px;
      display: inline-block;
      width: fit-content;
    }

    .val-level {
      color: #A0522D;
    }

    @media (max-width: 992px) {
      .management-header-row, .management-grid-3 {
        grid-template-columns: 1fr;
        gap: 24px;
      }
      .summary-grid {
        grid-template-columns: 1fr 1fr;
        gap: 20px;
      }
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
    <a href="{{ route('mitra.home') }}" class="nav-link">Home</a>
    <a href="#" class="nav-link active">Mitra Manajemen</a>
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

<main class="management-container">

  <div class="management-header-row">
    <div class="welcome-mitra-box">
      <img src="{{ asset('img/mitra/Group 1833.png') }}" alt="Hallo Mitra Mascot" class="welcome-mitra-img" style="height: 165px">
    </div>

    <div class="atur-toko-card">
      <img src="{{ asset('img/mitra/daun.png') }}" alt="Leaf Icon" class="daun-icon">
      <div class="atur-toko-text">
        <div class="title">Mitra Manajemen</div>
        <div class="subtitle">Atur Toko Kamu</div>
      </div>
    </div>
  </div>

  <div class="management-grid-3">

    <div class="menu-card">
      <div class="menu-icon-wrapper">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
      </div>
      <div class="menu-title">Lokasi Baru / Pindah Toko</div>
      <div class="menu-desc">Masukkan alamat lokasi baru agar tim kami dapat memperbarui data mitra Anda dengan akurat.</div>
      <button class="btn-action" id="btnPerbaruiLokasi">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
        Perbarui Lokasi
      </button>
    </div>

    <div class="menu-card">
      <div class="menu-icon-wrapper">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
      </div>
      <div class="menu-title">Data Usaha</div>
      <div class="menu-desc">Perbarui data bisnis dan profil usaha Anda secara berkala agar informasi yang tersaji selalu up to date.</div>
      <button class="btn-action" id="btnPerbaruiDataToko">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
        Perbarui Data Toko
      </button>
    </div>

    <div class="menu-card">
      <div class="menu-icon-wrapper">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
      </div>
      <div class="menu-title">Status Operasional</div>
      <div class="menu-desc">Informasi jam operasional, kesiapan stok, dan status aktifitas mitra Anda untuk pelanggan.</div>
      <button class="btn-action" id="btnCekStatus">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
        Cek Status
      </button>
    </div>

  </div>

  <div class="summary-activity-card">
    <div class="summary-title">Ringkasan Aktivitas</div>
    <div class="summary-grid">

      <div class="summary-item">
        <span class="summary-label">Update Terakhir</span>
        <span class="summary-value val-date">{{ ($usaha?->updated_at ?? $user->created_at)->format('d M Y') }}</span>
      </div>

      <div class="summary-item">
        <span class="summary-label">Status Lokasi</span>
        <div>
          <span class="badge-status">{{ $daftarLokasi->isEmpty() ? 'Belum ada lokasi' : 'Terverifikasi' }}</span>
        </div>
      </div>

      <div class="summary-item">
        <span class="summary-label">Jam Operasional</span>
        <span class="summary-value">{{ $usaha ? $usaha->jam_buka . ' - ' . $usaha->jam_tutup : '-' }}</span>
      </div>

      <div class="summary-item">
        <span class="summary-label">Partner Level</span>
        <span class="summary-value val-level">{{ $level }}</span>
      </div>

    </div>
  </div>


  <div class="summary-activity-card" id="daftar-lokasi" style="margin-top: 24px;">
    <div class="summary-title" style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">
      <span>Daftar Lokasi Mitra</span>
      <a href="{{ route('mitra.lokasi.create') }}" class="btn-action" style="text-decoration:none;width:auto;padding:10px 22px;">+ Tambah Lokasi</a>
    </div>
    <div style="overflow-x:auto;">
      <table style="width:100%;border-collapse:collapse;font-size:14px;">
        <thead>
          <tr style="text-align:left;color:#718096;font-size:12px;">
            <th style="padding:8px 6px;">Nama</th><th style="padding:8px 6px;">Kota</th><th style="padding:8px 6px;">Alamat</th><th style="padding:8px 6px;">Jam</th><th style="padding:8px 6px;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($daftarLokasi as $lok)
          <tr style="border-top:1px solid #E2E8F0;">
            <td style="padding:12px 6px;font-weight:600;">{{ $lok->nama }}</td>
            <td style="padding:12px 6px;">{{ $lok->kota }}</td>
            <td style="padding:12px 6px;">{{ $lok->alamat }}</td>
            <td style="padding:12px 6px;">{{ $lok->jam_buka }} - {{ $lok->jam_tutup }}</td>
            <td style="padding:12px 6px;white-space:nowrap;">
              <a href="{{ route('mitra.lokasi.edit', $lok->id) }}" style="color:#00796B;font-weight:600;text-decoration:none;">Ubah</a>
              &nbsp;
              <form method="POST" action="{{ route('mitra.lokasi.destroy', $lok->id) }}" style="display:inline" onsubmit="return confirm(@js('Hapus lokasi ' . $lok->nama . '?'))">
                @csrf
                @method('DELETE')
                <button type="submit" style="border:none;background:none;color:#C62828;font-weight:600;cursor:pointer;font-family:inherit;font-size:14px;">Hapus</button>
              </form>
            </td>
          </tr>
          @empty
          <tr><td colspan="5" style="padding:20px 6px;color:#718096;">Belum ada lokasi. Klik "Tambah Lokasi".</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="summary-activity-card" style="margin-top: 24px;">
    <div class="summary-title">Data Usaha</div>
    @if ($usaha)
    <div class="summary-grid">
      <div class="summary-item"><span class="summary-label">Nama Usaha</span><span class="summary-value">{{ $usaha->nama_usaha }}</span></div>
      <div class="summary-item"><span class="summary-label">Jenis Usaha</span><span class="summary-value">{{ $usaha->jenis_usaha ?: '-' }}</span></div>
      <div class="summary-item"><span class="summary-label">Telepon</span><span class="summary-value">{{ $usaha->telepon ?: '-' }}</span></div>
      <div class="summary-item"><span class="summary-label">Status Operasional</span><span class="summary-value">{{ $usaha->status_buka ? 'Buka' : 'Tutup' }}</span></div>
    </div>
    @else
    <p style="color:#718096;font-size:14px;">Data usaha belum diisi. Klik "Perbarui Data Toko" untuk mengisinya.</p>
    @endif
  </div>
</main>

<script>
  document.addEventListener("DOMContentLoaded", function() {

    const btnLokasi = document.getElementById("btnPerbaruiLokasi");
    const btnDataToko = document.getElementById("btnPerbaruiDataToko");
    const btnStatus = document.getElementById("btnCekStatus");

    btnLokasi.addEventListener("click", function() {
      document.getElementById('daftar-lokasi').scrollIntoView({behavior: 'smooth'});
    });

    btnDataToko.addEventListener("click", function() {
      window.location.href = '{{ route('mitra.usaha.edit') }}';
    });

    btnStatus.addEventListener("click", function() {
      window.location.href = '{{ route('mitra.status') }}';
    });
  });
</script>

</body>
</html>
