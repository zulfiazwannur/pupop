<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lokasi dan Data Baru</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #f4f7f6;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }

    .card-container {
      width: 100%;
      max-width: 960px;
      background: linear-gradient(180deg, #e3f8f9 0%, #f5fdfd 100%);
      border-radius: 36px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
      padding: 50px 60px;
    }

    .header-section {
      text-align: center;
      margin-bottom: 35px;
    }

    .main-title {
      color: #1cb0bc;
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 2px;
    }

    .subtitle {
      color: #7b9da3;
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 1px;
    }

    .form-group {
      margin-bottom: 24px;
    }

    .form-group label {
      display: block;
      color: #1cb0bc;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 12px;
    }

    .form-group input {
      width: 100%;
      background-color: #ffffff;
      border: 1px solid #e1f0f1;
      border-radius: 14px;
      padding: 16px 24px;
      color: #2b2b2b;
      font-size: 14px;
      font-weight: 500;
      outline: none;
      box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.02);
      transition: all 0.3s ease;
    }

    .form-group input:focus {
      border-color: #1cb0bc;
      box-shadow: 0 0 0 3px rgba(28, 176, 188, 0.1);
    }

    .btn-submit {
      width: 100%;
      background-color: #28b3c1;
      color: #ffffff;
      border: none;
      border-radius: 25px;
      padding: 18px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 12px;
      margin-top: 40px;
      box-shadow: 0 4px 12px rgba(40, 179, 193, 0.2);
      transition: background-color 0.3s ease, transform 0.1s ease;
    }

    .btn-submit:hover {
      background-color: #1f9fae;
    }

    .btn-submit:active {
      transform: scale(0.99);
    }

    .btn-submit i {
      font-size: 16px;
      transform: rotate(0deg);
    }

    @media (max-width: 768px) {
      .card-container {
        padding: 30px 25px;
        border-radius: 24px;
      }
      .main-title {
        font-size: 26px;
      }
    }
  </style>
</head>
<body>
@include('partials.flash')

<div class="card-container">
  <div class="header-section">
    <h1 class="main-title">{{ $lokasi->exists ? 'Lokasi dan Data Baru' : 'Tambah Lokasi Mitra' }}</h1>
    <p class="subtitle">{{ $lokasi->exists ? 'PERBARUI LOKASI MITRA' : 'LOKASI MITRA BARU' }}</p>
  </div>

  <form id="lokasiForm" method="post" action="{{ $lokasi->exists ? route('mitra.lokasi.update', $lokasi->id) : route('mitra.lokasi.store') }}">
    @csrf
    @if ($lokasi->exists)
      @method('PUT')
    @endif

    <div class="form-group">
      <label>Nama Lokasi:</label>
      <input type="text" name="nama" value="{{ old('nama', $lokasi->nama) }}" maxlength="100" placeholder="Mitra 5 - Lowokwaru" required>
    </div>

    <div class="form-group">
      <label>Kota:</label>
      <input type="text" name="kota" value="{{ old('kota', $lokasi->kota) }}" maxlength="100" placeholder="Malang" required>
    </div>

    @if ($lokasi->exists)
    <div class="form-group">
      <label>Lokasi Lama:</label>
      <input type="text" value="{{ $lokasi->alamat_lama ?? $lokasi->alamat }}" id="lokasiLama" readonly>
    </div>
    @endif

    <div class="form-group">
      <label>{{ $lokasi->exists ? 'Lokasi Baru:' : 'Alamat:' }}</label>
      <input type="text" name="alamat" value="{{ old('alamat', $lokasi->alamat) }}" maxlength="255" id="lokasiBaru" placeholder="Jl. Sudimoro, No.3A, Malang" required>
    </div>

    <div class="form-group">
      <label>Jam Buka:</label>
      <input type="time" name="jam_buka" value="{{ old('jam_buka', $lokasi->jam_buka) }}" required>
    </div>

    <div class="form-group">
      <label>Jam Tutup:</label>
      <input type="time" name="jam_tutup" value="{{ old('jam_tutup', $lokasi->jam_tutup) }}" required>
    </div>

    @if ($lokasi->exists)
    <div class="form-group">
      <label>Alasan Pindah:</label>
      <input type="text" name="alasan_pindah" value="{{ old('alasan_pindah', $lokasi->alasan_pindah) }}" maxlength="255" id="alasanPindah" placeholder="Tempat kurang luas">
    </div>

    <div class="form-group">
      <label>Tanggal Terakhir Saat Pindah:</label>
      <input type="date" name="tanggal_pindah" value="{{ old('tanggal_pindah', $lokasi->tanggal_pindah?->toDateString()) }}" max="{{ now()->toDateString() }}" id="tanggalPindah">
    </div>
    @endif

    <button type="submit" class="btn-submit" id="btnPerbarui">
      {{ $lokasi->exists ? 'Perbarui Lokasi' : 'Simpan Lokasi' }} <i class="fas fa-paper-plane"></i>
    </button>
    <a href="{{ route('mitra.manajemen') }}" style="display:block;text-align:center;margin-top:14px;color:#718096;font-size:13px;text-decoration:none;">Batal</a>
  </form>
</div>

</body>
</html>
