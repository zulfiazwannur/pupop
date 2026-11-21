<!DOCTYPE html>
<html lang="id">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riwayat Transaksi Mitra</title>
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

    .dashboard-container {
      max-width: 1280px;
      margin: 32px auto;
      padding: 0 40px;
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .riwayat-header-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 8px;
    }

    .header-left {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .header-right {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .search-container {
      position: relative;
      display: flex;
      align-items: center;
    }

    .search-input {
      padding: 14px 16px 14px 44px;
      border: 1px solid #E2E8F0;
      border-radius: 14px;
      font-size: 14px;
      width: 320px;
      background: #ffffff;
      color: #4A5568;
      outline: none;
      transition: border-color 0.2s;
    }

    .search-input:focus {
      border-color: #2BB6C4;
    }

    .search-icon {
      position: absolute;
      left: 16px;
      color: #A0AEC0;
      display: flex;
      align-items: center;
    }

    .filter-btn {
      background: white;
      border: 1px solid #E2E8F0;
      border-radius: 14px;
      padding: 14px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #A0AEC0;
      transition: all 0.2s;
    }

    .filter-btn:hover {
      background: #f7fafc;
      color: #2BB6C4;
    }

    .riwayat-stats-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
    }

    .stat-card {
      background: white;
      border-radius: 20px;
      padding: 28px 32px;
      box-shadow: 0 10px 25px rgb(0 0 0 / 0.14);
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .stat-card-label {
      font-size: 11px;
      font-weight: 700;
      color: #A0AEC0;
      text-transform: uppercase;
      margin-bottom: 12px;
      letter-spacing: 0.5px;
    }

    .stat-card-value-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
    }

    .stat-card-value {
      font-size: 32px;
      font-weight: 800;
      color: #1A202C;
    }

    .badge-trend {
      background: #E6FFFA;
      color: #26B6C4;
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 700;
    }

    .stat-period-text {
      font-size: 13px;
      color: #A0AEC0;
      font-weight: 600;
    }

    .table-card {
      background: white;
      border-radius: 24px;
      padding: 32px;
      box-shadow: 0 10px 25px rgb(0 0 0 / 0.14);
    }

    .table-header-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
    }

    .table-title {
      font-size: 18px;
      font-weight: 700;
      color: #1A202C;
    }

    .table-actions-right {
      font-size: 13px;
      font-weight: 600;
    }

    .table-actions-right a {
      color: #2BB6C4;
      text-decoration: none;
      transition: color 0.2s;
    }

    .table-actions-right a:hover {
      text-decoration: underline;
    }

    .table-actions-right span {
      color: #E2E8F0;
      margin: 0 8px;
    }

    .transaksi-table-wrapper {
      width: 100%;
      overflow-x: auto;
    }

    .transaksi-table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }

    .transaksi-table th {
      font-size: 12px;
      font-weight: 700;
      color: #A0AEC0;
      text-transform: uppercase;
      padding: 18px 24px;
      border-bottom: 1px solid #EDF2F7;
      background-color: #F8FAFC;
    }

    .transaksi-table td {
      padding: 20px 24px;
      border-bottom: 1px solid #EDF2F7;
      font-size: 14px;
      color: #4A5568;
      vertical-align: middle;
    }

    .transaksi-table tr:last-child td {
      border-bottom: none;
    }

    .status-cell {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .status-icon-img {
      width: 40px;
      height: 40px;
      object-fit: contain;
    }

    .status-info {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .status-name {
      font-weight: 700;
      color: #2D3748;
    }

    .badge-status {
      font-size: 10px;
      font-weight: 700;
      padding: 2px 8px;
      border-radius: 6px;
      width: fit-content;
      text-transform: uppercase;
    }

    .badge-status.success {
      background: #E6FFFA;
      color: #239aa7;
    }

    .badge-status.bonus {
      background: #EBF8FF;
      color: #2B6CB0;
    }

    .keterangan-cell strong {
      color: #2D3748;
      font-weight: 700;
    }

    .keterangan-cell span {
      color: #A0AEC0;
      font-size: 12px;
      display: block;
      margin-top: 2px;
    }

    .amount-badge {
      background: #2BB6C4;
      color: white;
      padding: 6px 18px;
      border-radius: 20px;
      font-weight: 700;
      font-size: 13px;
      display: inline-block;
    }

    .aksi-btn {
      background: none;
      border: none;
      color: #A0AEC0;
      cursor: pointer;
      font-weight: bold;
      font-size: 18px;
      padding: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .table-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 24px;
      font-size: 13px;
      color: #A0AEC0;
    }

    .pagination {
      display: flex;
      gap: 8px;
      align-items: center;
    }

    .page-btn {
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      border: 1px solid #E2E8F0;
      background: white;
      color: #4A5568;
      cursor: pointer;
      font-size: 13px;
      font-weight: 600;
      transition: all 0.2s;
    }

    .page-btn.active {
      background: #2BB6C4;
      color: white;
      border-color: #2BB6C4;
    }

    .page-btn:hover:not(.active) {
      background: #F7FAFC;
    }

    @media (max-width: 768px) {
      .riwayat-stats-grid { grid-template-columns: 1fr; gap: 16px; }
      .riwayat-header-row { flex-direction: column; align-items: flex-start; gap: 16px; }
      .search-input { width: 100%; }
      .table-header-row { flex-direction: column; align-items: flex-start; gap: 10px; }
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
    <a href="{{ route('mitra.manajemen') }}" class="nav-link">Mitra Manajemen</a>
    <a href="#" class="nav-link active">Riwayat</a>
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

  <div class="riwayat-header-row">
    <div class="header-left">
      <img src="{{ asset('img/mitra/Group 1844.png') }}" alt="Riwayat Transaksi Banner" style="height: 155px; object-fit: contain;">
    </div>
    <form class="header-right" method="get" action="{{ route('mitra.riwayat') }}">
      <div class="search-container">
        <span class="search-icon">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        </span>
        <input type="text" class="search-input" name="q" value="{{ $q }}" maxlength="100" placeholder="Cari Riwayat...">
      </div>
      <select name="tipe" onchange="this.form.submit()" title="Filter tipe" style="border:1px solid #E2E8F0;border-radius:12px;padding:0 10px;height:44px;font-family:inherit;color:#4A5568;background:#fff;">
        <option value="">Semua tipe</option>
        <option value="setor" {{ $tipe === 'setor' ? 'selected' : '' }}>Setor Popok</option>
        <option value="reward" {{ $tipe === 'reward' ? 'selected' : '' }}>Reward Mitra</option>
        <option value="tarik" {{ $tipe === 'tarik' ? 'selected' : '' }}>Tarik Saldo</option>
      </select>
      <button class="filter-btn" title="Cari / Filter" type="submit">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
      </button>
    </form>
  </div>

  <div class="riwayat-stats-grid">
    <div class="stat-card">
      <div class="stat-card-label">Total Setoran</div>
      <div class="stat-card-value-container">
        <div class="stat-card-value">{{ number_format($total->pcs, 0, ',', '.') }} <span style="font-size: 18px; font-weight: 700; color: #A0AEC0;">pcs</span></div>
        <div class="stat-period-text">Sesuai filter</div>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-card-label">Total Reward</div>
      <div class="stat-card-value-container">
        <div class="stat-card-value">Rp {{ number_format($total->reward, 0, ',', '.') }}</div>
        <div class="stat-period-text">Sesuai filter</div>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-card-label">Poin Terkumpul</div>
      <div class="stat-card-value-container">
        <div class="stat-card-value">{{ number_format($total->poin, 0, ',', '.') }} <span style="font-size: 18px; font-weight: 700; color: #A0AEC0;">pts</span></div>
        <div class="stat-period-text">Sesuai filter</div>
      </div>
    </div>
  </div>

  <div class="table-card">
    <div class="table-header-row">
      <div class="table-title">Detail Transaksi</div>
      <div class="table-actions-right">
        <a href="#" onclick="bukaTambah(); return false;">+ Tambah Catatan</a>
        <span>|</span>
        <a href="#">Download CSV</a>
        <span>|</span>
        <a href="#">Print PDF</a>
      </div>
    </div>

    <div class="transaksi-table-wrapper">
      <table class="transaksi-table">
        <thead>
        <tr>
          <th>Status & Tipe</th>
          <th>Keterangan</th>
          <th>Tanggal</th>
          <th>Nominal / Jumlah</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($transaksi as $t)
        <tr>
          <td>
            <div class="status-cell">
              <img src="{{ asset('img/mitra/' . ($t->tipe === 'reward' ? 'Background.png' : 'Overlay.png')) }}" alt="Icon {{ $t->namaTipe() }}" class="status-icon-img">
              <div class="status-info">
                <span class="status-name">{{ $t->namaTipe() }}</span>
                <span class="badge-status {{ $t->badge()[1] }}">{{ $t->badge()[0] }}</span>
              </div>
            </div>
          </td>
          <td class="keterangan-cell">
            <strong>{{ $t->nama }}</strong>
            <span>{{ $t->keterangan }}</span>
          </td>
          <td>{{ $t->tanggal->format('d/m/Y') }}</td>
          <td>
            <div class="amount-badge">{{ $t->labelJumlah() }}</div>
          </td>
          <td style="position:relative;">
            <button class="aksi-btn" type="button" onclick="toggleAksi(this)">•••</button>
            <div class="aksi-menu" style="display:none;position:absolute;right:0;top:34px;background:#fff;border:1px solid #E2E8F0;border-radius:12px;box-shadow:0 8px 20px rgba(0,0,0,.12);z-index:20;min-width:110px;overflow:hidden;">
              <button type="button" onclick='bukaUbah(@json($t->dataUbah()))' style="display:block;width:100%;text-align:left;padding:10px 14px;border:none;background:none;cursor:pointer;font-family:inherit;font-size:13px;color:#2D3748;">Ubah</button>
              <form method="POST" action="{{ route('mitra.riwayat.destroy', $t->id) }}" onsubmit="return confirm('Hapus transaksi ini dari riwayat? Saldo dan poin tidak berubah.')">
                @csrf
                @method('DELETE')
                <button type="submit" style="display:block;width:100%;text-align:left;padding:10px 14px;border:none;background:none;cursor:pointer;font-family:inherit;font-size:13px;color:#C62828;">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5" style="text-align:center;padding:40px 0;color:#718096;">Belum ada transaksi{{ $q !== '' || $tipe ? ' yang cocok dengan pencarian' : '' }}.</td>
        </tr>
        @endforelse
        </tbody>
      </table>
    </div>

    <div class="table-footer">
      <div>Menampilkan {{ $transaksi->count() }} dari {{ $transaksi->total() }} transaksi</div>
      <div class="pagination">
        @if ($transaksi->hasPages())
          <a class="page-btn" style="text-decoration:none;" href="{{ $transaksi->previousPageUrl() ?? '#' }}">&lt;</a>
          @foreach (range(1, $transaksi->lastPage()) as $hal)
            <a class="page-btn {{ $hal === $transaksi->currentPage() ? 'active' : '' }}" style="text-decoration:none;" href="{{ $transaksi->url($hal) }}">{{ $hal }}</a>
          @endforeach
          <a class="page-btn" style="text-decoration:none;" href="{{ $transaksi->nextPageUrl() ?? '#' }}">&gt;</a>
        @endif
      </div>
    </div>
  </div>

</main>

<div id="trxModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);align-items:center;justify-content:center;z-index:10000;padding:20px;">
  <div style="background:#fff;width:100%;max-width:480px;border-radius:24px;padding:28px;box-shadow:0 10px 40px rgba(0,0,0,.2);max-height:90vh;overflow:auto;">
    <h2 id="trxJudul" style="color:#005B66;font-size:22px;margin-bottom:4px;">Tambah Catatan</h2>
    <p id="trxSub" style="color:#718096;font-size:13px;margin-bottom:18px;">Catatan reward/bonus manual.</p>
    <form id="trxForm" method="post" action="{{ route('mitra.riwayat.store') }}" style="display:flex;flex-direction:column;gap:12px;">
      @csrf
      <input type="hidden" name="_method" id="trxMethod" value="POST" disabled>
      <div data-manual><label style="font-size:13px;font-weight:600;">Judul</label><input type="text" name="nama" id="fNama" maxlength="100" required></div>
      <div><label style="font-size:13px;font-weight:600;">Keterangan</label><input type="text" name="keterangan" id="fKet" maxlength="255" required></div>
      <div data-manual><label style="font-size:13px;font-weight:600;">Tanggal</label><input type="date" name="tanggal" id="fTgl" max="{{ now()->toDateString() }}" required></div>
      <div data-manual><label style="font-size:13px;font-weight:600;">Nominal (Rp)</label><input type="number" name="nominal" id="fNom" min="0" max="100000000" step="1" value="0" required></div>
      <div data-manual><label style="font-size:13px;font-weight:600;">Poin</label><input type="number" name="poin" id="fPoin" min="0" max="1000000" step="1" value="0" required></div>
      <p id="trxInfoOtomatis" style="display:none;font-size:12px;color:#718096;">Transaksi otomatis: hanya keterangan yang dapat diubah.</p>
      <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:6px;">
        <button type="button" onclick="tutupTrx()" style="border:1px solid #CBD5E0;background:#fff;border-radius:30px;padding:10px 22px;font-weight:600;cursor:pointer;font-family:inherit;">Batal</button>
        <button type="submit" style="border:none;background:#2BB6C4;color:#fff;border-radius:30px;padding:10px 22px;font-weight:600;cursor:pointer;font-family:inherit;">Simpan</button>
      </div>
    </form>
  </div>
</div>

<style>
  #trxForm input { width:100%; padding:11px 14px; border:1px solid #E2E8F0; border-radius:12px; font-family:inherit; font-size:13px; margin-top:4px; }
</style>

<script>
  const trxModal = document.getElementById('trxModal');
  const trxForm = document.getElementById('trxForm');

  function toggleAksi(btn) {
    const menu = btn.nextElementSibling;
    const tampil = menu.style.display === 'block';
    document.querySelectorAll('.aksi-menu').forEach(m => m.style.display = 'none');
    menu.style.display = tampil ? 'none' : 'block';
  }
  document.addEventListener('click', (e) => {
    if (!e.target.closest('td')) document.querySelectorAll('.aksi-menu').forEach(m => m.style.display = 'none');
  });

  function aturMode(manual) {
    document.querySelectorAll('[data-manual]').forEach(d => {
      d.style.display = manual ? 'block' : 'none';
      d.querySelector('input').disabled = !manual;
    });
    document.getElementById('trxInfoOtomatis').style.display = manual ? 'none' : 'block';
  }

  function bukaTambah() {
    trxForm.reset();
    trxForm.action = '{{ route('mitra.riwayat.store') }}';
    document.getElementById('trxMethod').disabled = true;
    document.getElementById('trxJudul').textContent = 'Tambah Catatan';
    document.getElementById('trxSub').textContent = 'Catatan reward/bonus manual.';
    document.getElementById('fTgl').value = '{{ now()->toDateString() }}';
    aturMode(true);
    trxModal.style.display = 'flex';
  }

  function bukaUbah(d) {
    trxForm.action = '{{ url('mitra/riwayat') }}/' + d.id;
    document.getElementById('trxMethod').value = 'PUT';
    document.getElementById('trxMethod').disabled = false;
    document.getElementById('trxJudul').textContent = 'Ubah Transaksi';
    document.getElementById('trxSub').textContent = d.manual ? 'Ubah data catatan.' : 'Perbarui keterangan transaksi.';
    document.getElementById('fNama').value = d.nama;
    document.getElementById('fKet').value = d.keterangan;
    document.getElementById('fTgl').value = d.tanggal;
    document.getElementById('fNom').value = d.nominal;
    document.getElementById('fPoin').value = d.poin;
    aturMode(d.manual);
    trxModal.style.display = 'flex';
  }

  function tutupTrx() { trxModal.style.display = 'none'; }
  trxModal.addEventListener('click', (e) => { if (e.target === trxModal) tutupTrx(); });
</script>

</body>
</html>
