<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Usaha</title>
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
    <h1 class="main-title">Data Usaha</h1>
    <p class="subtitle">{{ $usaha->exists ? 'PERBARUI DATA USAHA MITRA' : 'ISI DATA USAHA MITRA' }}</p>
  </div>

  <form id="usahaForm" method="post" action="{{ route('mitra.usaha.simpan') }}">
    @csrf

    <div class="form-group">
      <label>Nama Usaha:</label>
      <input type="text" name="nama_usaha" value="{{ old('nama_usaha', $usaha->nama_usaha) }}" maxlength="100" required>
    </div>

    <div class="form-group">
      <label>Jenis Usaha:</label>
      <input type="text" name="jenis_usaha" value="{{ old('jenis_usaha', $usaha->jenis_usaha) }}" maxlength="100" placeholder="Bank sampah popok">
    </div>

    <div class="form-group">
      <label>Telepon:</label>
      <input type="text" name="telepon" value="{{ old('telepon', $usaha->telepon) }}" maxlength="20" inputmode="tel" placeholder="081234567890">
    </div>

    <div class="form-group">
      <label>Deskripsi:</label>
      <input type="text" name="deskripsi" value="{{ old('deskripsi', $usaha->deskripsi) }}" maxlength="1000" placeholder="Deskripsi singkat usaha">
    </div>

    <div class="form-group">
      <label>Jam Buka:</label>
      <input type="time" name="jam_buka" value="{{ old('jam_buka', $usaha->jam_buka) }}" required>
    </div>

    <div class="form-group">
      <label>Jam Tutup:</label>
      <input type="time" name="jam_tutup" value="{{ old('jam_tutup', $usaha->jam_tutup) }}" required>
    </div>

    <div class="form-group">
      <label>Kapasitas Penampungan (pcs):</label>
      <input type="number" name="kapasitas" value="{{ old('kapasitas', $usaha->kapasitas) }}" min="10" max="10000" step="1" required>
    </div>

    <button type="submit" class="btn-submit">
      {{ $usaha->exists ? 'Perbarui Data Usaha' : 'Simpan Data Usaha' }} <i class="fas fa-paper-plane"></i>
    </button>
    <a href="{{ route('mitra.manajemen') }}" style="display:block;text-align:center;margin-top:14px;color:#718096;font-size:13px;text-decoration:none;">Batal</a>
  </form>

  @if ($usaha->exists)
  <form method="post" action="{{ route('mitra.usaha.destroy') }}" onsubmit="return confirm('Hapus data usaha? Status operasional dan kapasitas ikut terhapus.')" style="margin-top:18px;">
    @csrf
    @method('DELETE')
    <button type="submit" style="width:100%;border:1px solid #C62828;background:#fff;color:#C62828;border-radius:50px;padding:12px;font-weight:600;cursor:pointer;font-family:inherit;">Hapus Data Usaha</button>
  </form>
  @endif
</div>

</body>
</html>
