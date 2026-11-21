<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pick Up</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <script src="https://unpkg.com/@phosphor-icons/web"></script>

  <style>

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #f7fafc;
      color: #2d3748;
      padding-bottom: 40px;
    }

    .header-wrapper {
      background: #2BB6C4;
      padding: 24px;
      border-radius: 0 0 40px 40px;
      box-shadow: 0 8px 25px rgba(0,0,0,.08);
    }

    .header-card {
      background: white;
      border-radius: 24px;
      height: 73px;
      display: flex;
      align-items: center;
      gap: 20px;
      padding: 0 30px;
    }

    .back-btn {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: #EAF9FA;
      border: none;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      color: #2BB6C4;
      transition: background 0.2s;
    }

    .back-btn:hover {
      background-color: #d1f0f2;
    }

    .header-text h2 {
      color: #2BB6C4;
      font-size: 18px;
      font-weight: 700;
      line-height: 1.2;
    }

    .header-text p {
      color: #718096;
      font-size: 12px;
      font-weight: 400;
    }

    .content-container {
      max-width: 1200px;
      width: 95%;
      margin: 35px auto;
    }

    .main-grid {
      display: grid;
      grid-template-columns: 1.4fr 1fr;
      gap: 24px;
      align-items: start;
    }

    .card {
      background: #ffffff;
      border: 1.5px solid #E2E8F0;
      border-radius: 24px;
      padding: 24px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.01);
      position: relative;
      overflow: hidden;
    }

    .card-title-row {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 12px;
    }

    .icon-box {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background-color: #EAF9FA;
      color: #006b6d;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
    }

    .card-title-row h3 {
      font-size: 16px;
      font-weight: 600;
      color: #1a202c;
    }

    .left-col {
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .auto-pickup-card {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .auto-pickup-card::after {
      content: "";
      position: absolute;
      top: -20px;
      right: -20px;
      width: 120px;
      height: 120px;
      background-color: #EAF9FA;
      border-radius: 50%;
      z-index: 0;
    }

    .auto-pickup-content {
      position: relative;
      z-index: 1;
      max-width: 65%;
    }

    .auto-pickup-content p {
      font-size: 13px;
      color: #718096;
      margin-bottom: 20px;
      line-height: 1.5;
    }

    .schedule-label {
      font-size: 11px;
      color: #a0aec0;
      font-weight: 600;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }

    .schedule-date {
      font-size: 20px;
      color: #006b6d;
      font-weight: 700;
      margin-top: 4px;
    }

    .btn-ubah-jadwal {
      position: relative;
      z-index: 1;
      background-color: #42d4da;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 30px;
      font-size: 13px;
      font-weight: 500;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: background 0.2s;
    }

    .btn-ubah-jadwal:hover {
      background-color: #06afb1;
    }

    .history-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 16px;
    }

    .link-lihat-semua {
      color: #006b6d;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
    }

    .history-table {
      width: 100%;
      border-collapse: collapse;
    }

    .history-table th {
      text-align: left;
      font-size: 13px;
      color: #1a202c;
      font-weight: 600;
      padding: 14px 16px;
      background-color: #f7fafc;
    }

    .history-table th:first-child { border-radius: 12px 0 0 12px; }
    .history-table th:last-child { border-radius: 0 12px 12px 0; text-align: center; }

    .history-table td {
      padding: 16px;
      font-size: 13px;
      color: #4a5568;
      border-bottom: 1px solid #E2E8F0;
    }

    .history-table td:last-child { text-align: center; }
    .history-table tr:last-child td { border-bottom: none; }

    .status-pill {
      background-color: #e6f4f1;
      color: #2b7a78;
      padding: 6px 16px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      display: inline-block;
    }

    .right-col {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .custom-dropdown-container {
      position: relative;
      width: 100%;
    }

    .custom-dropdown-btn {
      width: 100%;
      background: #ffffff;
      border: 1.5px solid #E2E8F0;
      border-radius: 24px;
      padding: 14px 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 14px;
      font-weight: 600;
      color: #4a5568;
      cursor: pointer;
      box-shadow: 0 2px 10px rgba(0,0,0,0.01);
    }

    .custom-dropdown-menu {
      position: absolute;
      top: 110%;
      left: 0;
      width: 100%;
      background: white;
      border: 1.5px solid #E2E8F0;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.05);
      overflow: hidden;
      display: none;
      z-index: 10;
    }

    .custom-dropdown-menu.show {
      display: block;
    }

    .dropdown-item {
      padding: 12px 24px;
      font-size: 14px;
      color: #4a5568;
      cursor: pointer;
      transition: background 0.2s;
    }

    .dropdown-item:hover {
      background: #f7fafc;
      color: #2BB6C4;
    }

    .next-pickup-card {
      border-top: 4px solid #2BB6C4;
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .next-pickup-card .icon-box {
      background: transparent;
      color: #2BB6C4;
      width: auto;
      height: auto;
      font-size: 20px;
    }

    .next-pickup-card .card-title-row h3 {
      color: #2BB6C4;
    }

    .next-date-large {
      font-size: 28px;
      color: #1a202c;
      font-weight: 700;
      line-height: 1.2;
    }

    .estimate-text {
      font-size: 13px;
      color: #718096;
    }

    .driver-box {
      background-color: #f7fafc;
      border-radius: 16px;
      padding: 16px 20px;
      display: flex;
      align-items: center;
      gap: 16px;
      margin-top: 10px;
    }

    .driver-icon-circle {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background-color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #006b6d;
      font-size: 22px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }

    .driver-info {
      display: flex;
      flex-direction: column;
    }

    .driver-info strong {
      font-size: 14px;
      color: #1a202c;
      font-weight: 600;
    }

    .driver-info span {
      font-size: 13px;
      color: #718096;
    }

    .map-banner {
      border-radius: 16px;
      padding: 24px;
      position: relative;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      gap: 16px;
      background: linear-gradient(rgba(10, 50, 35, 0.8), rgba(10, 50, 35, 0.8)), url('{{ asset('img/mitra/gb.png') }}');
      background-color: #0f3622;
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .map-banner p {
      color: #ffffff;
      font-size: 13px;
      line-height: 1.5;
      position: relative;
      z-index: 2;
      width: 85%;
    }

    .btn-map-outline {
      background: transparent;
      border: 1.5px solid rgba(255, 255, 255, 0.4);
      color: white;
      padding: 8px 20px;
      border-radius: 30px;
      font-size: 12px;
      font-weight: 500;
      cursor: pointer;
      position: relative;
      z-index: 2;
      transition: all 0.3s;
    }

    .btn-map-outline:hover {
      background: rgba(255, 255, 255, 0.15);
      border-color: white;
    }

    @media (max-width: 900px) {
      .main-grid { grid-template-columns: 1fr; }
      .auto-pickup-card { flex-direction: column; align-items: flex-start; gap: 20px; }
      .auto-pickup-content { max-width: 100%; }
      .btn-ubah-jadwal { width: 100%; justify-content: center; }
    }
  </style>
</head>
<body>
@include('partials.flash')

<div class="header-wrapper">
  <div class="header-card">
    <button class="back-btn" aria-label="Kembali" onclick="window.history.back()">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <line x1="19" y1="12" x2="5" y2="12"></line>
        <polyline points="12 19 5 12 12 5"></polyline>
      </svg>
    </button>
    <div class="header-text">
      <h2>Pick Up</h2>
      <p>Setor popok ke pusat</p>
    </div>
  </div>
</div>

<div class="content-container">
  <div class="main-grid">

    <div class="left-col">

      <div class="card auto-pickup-card">
        <div class="auto-pickup-content">
          <div class="card-title-row">
            <div class="icon-box"><i class="ph ph-arrows-clockwise"></i></div>
            <h3>Otomatis Pick up</h3>
          </div>
          <p>Penjemputan rutin untuk lokasi operasional Anda.</p>

          <div class="schedule-label">JADWAL TERDEKAT</div>
          <div class="schedule-date">{{ $berikutnya ? $berikutnya->tanggal->locale('id')->translatedFormat('l, d F Y') : 'Belum ada jadwal' }}</div>
        </div>

        <button class="btn-ubah-jadwal" onclick="bukaPickup()">
          <i class="ph ph-calendar-blank" style="font-size: 18px;"></i>
          Ubah Jadwal Pickup
        </button>
      </div>

      <div class="card">
        <div class="history-header">
          <div class="card-title-row" style="margin: 0;">
            <div class="icon-box"><i class="ph ph-clock-counter-clockwise"></i></div>
            <h3>Riwayat Pickup</h3>
          </div>
          <a href="#" class="link-lihat-semua">Lihat Semua</a>
        </div>

        <table class="history-table">
          <thead>
          <tr>
            <th>Tanggal</th>
            <th>Mitra</th>
            <th>Status</th>
          </tr>
          </thead>
          <tbody>
          @forelse ($riwayat as $r)
          <tr>
            <td>{{ $r->tanggal->format('d/m/Y') }}</td>
            <td>{{ $r->lokasi?->nama ?? '-' }}</td>
            <td><span class="status-pill">{{ $r->status === 'selesai' ? 'Selesai' : 'Menunggu' }}</span></td>
          </tr>
          @empty
          <tr><td colspan="3" style="text-align:center;padding:20px 0;color:#718096;">Belum ada riwayat pickup.</td></tr>
          @endforelse
          </tbody>
        </table>
      </div>

    </div>

    <div class="right-col">

      <div class="custom-dropdown-container" id="mitraDropdown">
        <div class="custom-dropdown-btn" onclick="toggleDropdown()">
          <span id="selectedMitra">{{ $lokasiList->first()?->nama ?? 'Belum ada lokasi' }}</span>
          <i class="ph ph-caret-down"></i>
        </div>
        <div class="custom-dropdown-menu" id="dropdownMenu">
          @foreach ($lokasiList as $lok)
          <div class="dropdown-item" onclick='pilihMitra(@json($lok->nama), {{ $lok->id }})'>{{ $lok->nama }}</div>
          @endforeach
        </div>
      </div>

      <div class="card next-pickup-card">
        <div class="card-title-row">
          <div class="icon-box"><i class="ph ph-check-circle"></i></div>
          <h3>Pickup Selanjutnya</h3>
        </div>
        <div class="next-date-large">{!! $berikutnya ? e($berikutnya->tanggal->locale('id')->translatedFormat('l, d F')) . '<br>' . $berikutnya->tanggal->format('Y') : 'Belum ada<br>jadwal' !!}</div>
        <div class="estimate-text">Estimasi kedatangan: 09:00 - 11:00 WIB</div>
        @if ($berikutnya)
        <form method="POST" action="{{ route('mitra.pickup.selesai', $berikutnya->id) }}" onsubmit="return confirm('Tandai pickup ini selesai? Penampungan akan dikosongkan.')" style="margin:10px 0;">
          @csrf
          @method('PATCH')
          <button type="submit" class="btn-map-outline" style="width:100%;">Tandai Selesai</button>
        </form>
        @endif

        <div class="driver-box">
          <div class="driver-icon-circle">
            <i class="ph ph-truck"></i>
          </div>
          <div class="driver-info">
            <strong>Driver Terpilih</strong>
            <span>Ahmad S. (B 1234 OK)</span>
          </div>
        </div>
      </div>

      <div class="map-banner">
        <p>Pantau lokasi pickup secara real-time melalui peta interaktif.</p>
        <button class="btn-map-outline" onclick="bukaModal('Buka Peta', 'Membuka Google Maps / Peta Interaktif...')">Buka Peta</button>
      </div>

    </div>
  </div>
</div>

<div id="pickupModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);align-items:center;justify-content:center;z-index:10000;padding:20px;">
  <div style="background:#fff;width:100%;max-width:460px;border-radius:24px;padding:28px;box-shadow:0 10px 40px rgba(0,0,0,.2);">
    <h2 style="color:#005B66;font-size:22px;margin-bottom:4px;">Jadwal Pickup</h2>
    <p style="color:#718096;font-size:13px;margin-bottom:16px;">Permintaanmu akan dikirim ke pusat.</p>
    <form method="post" action="{{ route('mitra.pickup.store') }}" style="display:flex;flex-direction:column;gap:12px;">
      @csrf
      <input type="hidden" name="lokasi_mitra_id" id="pickupLokasi" value="{{ old('lokasi_mitra_id', $lokasiList->first()?->id) }}">
      <label style="font-size:13px;font-weight:600;">Tanggal pickup
        <input type="date" name="tanggal" min="{{ now()->toDateString() }}" value="{{ old('tanggal') }}" required style="width:100%;padding:11px 14px;border:1px solid #E2E8F0;border-radius:12px;font-family:inherit;margin-top:4px;">
      </label>
      <label style="font-size:13px;font-weight:600;">Catatan (opsional)
        <input type="text" name="catatan" maxlength="255" value="{{ old('catatan') }}" style="width:100%;padding:11px 14px;border:1px solid #E2E8F0;border-radius:12px;font-family:inherit;margin-top:4px;">
      </label>
      <p style="font-size:12px;color:#718096;">Lokasi mengikuti pilihan mitra di bagian atas halaman.</p>
      <div style="display:flex;justify-content:flex-end;gap:10px;">
        <button type="button" onclick="tutupPickup()" style="border:1px solid #CBD5E0;background:#fff;border-radius:30px;padding:10px 22px;font-weight:600;cursor:pointer;font-family:inherit;">Batal</button>
        <button type="submit" style="border:none;background:#2BB6C4;color:#fff;border-radius:30px;padding:10px 22px;font-weight:600;cursor:pointer;font-family:inherit;">Kirim Permintaan</button>
      </div>
    </form>
  </div>
</div>

<script>

  const dropdownMenu = document.getElementById('dropdownMenu');
  const selectedMitraText = document.getElementById('selectedMitra');

  function toggleDropdown() {
    dropdownMenu.classList.toggle('show');
  }

  function pilihMitra(namaMitra, id) {
    selectedMitraText.innerText = namaMitra;
    document.getElementById('pickupLokasi').value = id;
    dropdownMenu.classList.remove('show');
  }

  function bukaModal(judul, pesan) { alert(pesan); }

  function bukaPickup() {
    @if ($lokasiList->isEmpty())
      alert('Tambahkan lokasi mitra terlebih dahulu di Mitra Manajemen.');
      return;
    @endif
    document.getElementById('pickupModal').style.display = 'flex';
  }
  function tutupPickup() { document.getElementById('pickupModal').style.display = 'none'; }

  window.onclick = function(event) {
    if (!event.target.closest('.custom-dropdown-container')) {
      if (dropdownMenu.classList.contains('show')) {
        dropdownMenu.classList.remove('show');
      }
    }
  }

</script>
</body>
</html>
