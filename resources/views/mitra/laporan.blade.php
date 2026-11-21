<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Aktivitas Mitra</title>

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
      box-shadow: 0 8px 25px rgb(0 0 0 / 0.25);
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

    .main-report-card {
      background: #ffffff;
      border: 1.5px solid #E2E8F0;
      border-radius: 32px;
      padding: 40px;
      box-shadow: 0 4px 24px rgb(0 0 0 / 0.25);
      display: flex;
      flex-direction: column;
      gap: 30px;
    }

    .filter-section {
      display: flex;
      flex-direction: column;
      gap: 8px;
      align-items: flex-start;
    }

    .filter-label {
      font-size: 11px;
      font-weight: 600;
      color: #1a202c;
    }

    .dropdown-container {
      position: relative;
      width: 220px;
    }

    .dropdown-btn {
      width: 100%;
      background: #ffffff;
      border: 1.5px solid #E2E8F0;
      border-radius: 14px;
      padding: 10px 16px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 13px;
      font-weight: 500;
      color: #4a5568;
      cursor: pointer;
      box-shadow: 0 2px 6px rgb(0 0 0 / 0.25);
      transition: border-color 0.2s;
    }

    .dropdown-btn:hover {
      border-color: #2BB6C4;
    }

    .dropdown-btn i {
      color: #718096;
      font-size: 16px;
    }

    .dropdown-menu {
      position: absolute;
      top: 110%;
      left: 0;
      width: 100%;
      background: white;
      border: 1.5px solid #E2E8F0;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgb(0 0 0 / 0.25);
      overflow: hidden;
      display: none;
      z-index: 10;
    }

    .dropdown-menu.show {
      display: block;
    }

    .dropdown-item {
      padding: 10px 16px;
      font-size: 13px;
      color: #4a5568;
      cursor: pointer;
      transition: background 0.2s;
    }

    .dropdown-item:hover {
      background: #EAF9FA;
      color: #2BB6C4;
    }

    .summary-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
    }

    .stat-card {
      border: 1px solid #F0F4F8;
      background: #ffffff;
      border-radius: 16px;
      padding: 28px 32px;
      box-shadow: 0 4px 15px rgb(0 0 0 / 0.25);
    }

    .stat-label {
      font-size: 12px;
      color: #4a5568;
      font-weight: 600;
      margin-bottom: 12px;
    }

    .stat-value {
      font-size: 36px;
      font-weight: 700;
      color: #2BB6C4;
      line-height: 1;
    }

    .section-title {
      font-size: 18px;
      font-weight: 700;
      color: #2BB6C4;
      margin-top: 10px;
      margin-bottom: -10px;
    }

    .report-table-wrapper {
      width: 100%;
      overflow-x: auto;
    }

    .report-table {
      width: 100%;
      border-collapse: collapse;
    }

    .report-table th {
      text-align: left;
      font-size: 13px;
      color: #1a202c;
      font-weight: 700;
      padding: 16px 20px;
      border-bottom: 1px solid #E2E8F0;
    }

    .report-table th:last-child {
      text-align: right;
    }

    .report-table td {
      padding: 20px;
      font-size: 14px;
      color: #4a5568;
      border-bottom: 1px solid #F0F4F8;
    }

    .report-table td:last-child {
      text-align: right;
      font-weight: 600;
    }

    .report-table tr:last-child td {
      border-bottom: none;
    }

    @media (max-width: 768px) {
      .main-report-card { padding: 24px; gap: 20px; }
      .summary-grid { grid-template-columns: 1fr; gap: 16px; }
      .stat-value { font-size: 28px; }
    }
  </style>
</head>
<body>
@include('partials.flash')

<div class="header-wrapper">
  <div class="header-card">
    <button class="back-btn" id="btnBack" aria-label="Kembali" onclick="window.history.back()">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <line x1="19" y1="12" x2="5" y2="12"></line>
        <polyline points="12 19 5 12 12 5"></polyline>
      </svg>
    </button>
    <div class="header-text">
      <h2>Laporan</h2>
      <p>Laporan aktivitas mitra</p>
    </div>
  </div>
</div>

<div class="content-container">
  <div class="main-report-card">

    <div class="filter-section">
      <span class="filter-label">Pilih Waktu</span>
      <div class="dropdown-container">
        <div class="dropdown-btn" onclick="toggleDropdown()">
          <span id="selectedTime">{{ $pilihan[$bulan] }}</span>
          <i class="ph ph-caret-down"></i>
        </div>
        <div class="dropdown-menu" id="dropdownMenu">
          @foreach ($pilihan as $kode => $label)
          <div class="dropdown-item" onclick="pilihWaktu('{{ $kode }}')">{{ $label }}</div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="summary-grid">
      <div class="stat-card">
        <div class="stat-label">Total popok</div>
        <div class="stat-value">{{ number_format($totalPopok, 2, ',', '.') }}</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Total reward</div>
        <div class="stat-value">Rp {{ number_format($totalReward, 0, ',', '.') }}</div>
      </div>
    </div>

    <h3 class="section-title">Rincian bulan ini</h3>

    <div class="report-table-wrapper">
      <table class="report-table">
        <thead>
        <tr>
          <th>Tanggal</th>
          <th>Popok</th>
          <th>Reward</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($baris as $r)
        <tr>
          <td>{{ $r->tanggal->format('d/m/Y') }}</td>
          <td>{{ $r->tipe === 'setor' ? number_format($r->jumlah_pcs, 0, ',', '.') . ' Pcs' : '-' }}</td>
          <td>Rp. {{ number_format($r->nominal, 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr><td colspan="3" style="text-align:center;padding:20px 0;color:#718096;">Belum ada transaksi pada bulan ini.</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>

  </div>
</div>

<script>
  const dropdownMenu = document.getElementById('dropdownMenu');
  const selectedTimeText = document.getElementById('selectedTime');

  function toggleDropdown() {
    dropdownMenu.classList.toggle('show');
  }

  function pilihWaktu(kode) {
    // muat ulang laporan untuk bulan yang dipilih (data diambil dari database)
    window.location.href = "{{ route('mitra.laporan') }}?bulan=" + encodeURIComponent(kode);
  }

  window.onclick = function(event) {
    if (!event.target.closest('.dropdown-container')) {
      if (dropdownMenu.classList.contains('show')) {
        dropdownMenu.classList.remove('show');
      }
    }
  }
</script>
</body>
</html>
