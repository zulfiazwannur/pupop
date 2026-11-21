<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Terima Setor Popok</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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

    .outer-frame-card {
      background: #ffffff;
      border: 1.5px solid #E2E8F0;
      border-radius: 32px;
      padding: 35px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.01);
    }

    .main-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 30px;
      align-items: stretch;
    }

    .inner-card {
      background: #ffffff;
      border: 1.5px solid #E2E8F0;
      border-radius: 24px;
      padding: 35px;
      display: flex;
      flex-direction: column;
    }

    .left-card .image-container {
      width: 100%;
      height: 280px;
      border-radius: 24px;
      overflow: hidden;
      background-color: #f0f4f8;
      margin-bottom: 24px;
    }

    .left-card .image-container img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .left-card h3 {
      font-size: 22px;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 12px;
      line-height: 1.3;
    }

    .left-card p {
      font-size: 14px;
      color: #4a5568;
      line-height: 1.6;
    }

    .right-card {
      align-items: center;
      text-align: center;
    }

    .avatar-container {
      width: 85px;
      height: 85px;
      border-radius: 50%;
      background-color: #ff3b30;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 16px;
    }

    .avatar-container img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .right-card h3 {
      font-size: 22px;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 4px;
    }

    .right-card .address-text {
      font-size: 13px;
      color: #718096;
      margin-bottom: 24px;
    }

    .qr-container-box {
      position: relative;
      width: 240px;
      height: 240px;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      margin-bottom: 30px;
    }

    .qr-container-box::before,
    .qr-container-box::after,
    .qr-frame-bottom::before,
    .qr-frame-bottom::after {
      content: '';
      position: absolute;
      width: 40px;
      height: 40px;
      border-color: #2BB6C4;
      border-style: solid;
      border-width: 0;
    }

    .qr-container-box::before {
      top: 0;
      left: 0;
      border-top-width: 5px;
      border-left-width: 5px;
      border-top-left-radius: 20px;
    }
    .qr-container-box::after {
      top: 0;
      right: 0;
      border-top-width: 5px;
      border-right-width: 5px;
      border-top-right-radius: 20px;
    }

    .qr-frame-bottom::before {
      bottom: 0;
      left: 0;
      border-bottom-width: 5px;
      border-left-width: 5px;
      border-bottom-left-radius: 20px;
    }
    .qr-frame-bottom::after {
      bottom: 0;
      right: 0;
      border-bottom-width: 5px;
      border-right-width: 5px;
      border-bottom-right-radius: 20px;
    }

    .qr-image {
      width: 180px;
      height: 180px;
      object-fit: contain;
    }

    .btn-setor {
      width: 100%;
      max-width: 360px;
      background-color: #2BB6C4;
      color: white;
      border: none;
      padding: 14px 0;
      font-size: 16px;
      font-weight: 700;
      border-radius: 30px;
      cursor: pointer;
      text-align: center;
      margin-top: auto;
      transition: background 0.2s;
    }

    .btn-setor:hover {
      background-color: #2299a5;
    }

    @media (max-width: 768px) {
      .outer-frame-card { padding: 20px; }
      .main-grid { grid-template-columns: 1fr; gap: 20px; }
      .inner-card { padding: 24px; }
      .left-card .image-container { height: 200px; }
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
      <h2>Terima Setor</h2>
      <p>Setor popokmu disini untuk masa depan bumi yang lebih hijau.</p>
    </div>
  </div>
</div>

<div class="content-container">
  <div class="outer-frame-card">
    <div class="main-grid">

      <div class="inner-card left-card">
        <div class="image-container">
          <img src="{{ asset('img/pampers.png') }}" alt="Mulai Perubahan">
        </div>
        <h3>Mulai Perubahan Sekarang</h3>
        <p>Setiap popok yang Anda setor akan diolah kembali menjadi produk bermanfaat, mengurangi limbah di TPA kita.</p>
      </div>

      <div class="inner-card right-card">

        <div class="avatar-container">
          <img src="{{ asset('img/mitra/21.png') }}" alt="Foto Mitra">
        </div>

        <h3>{{ $lokasi?->nama ?? auth()->user()->name }}</h3>
        <p class="address-text">{{ $lokasi?->alamat ?? 'Belum ada lokasi' }}</p>

        <div class="qr-container-box">
          <img src="{{ asset('img/qr.png') }}" alt="QR Code" class="qr-image">
          <div class="qr-frame-bottom"></div>
        </div>

        <form method="post" action="{{ route('mitra.terima.pilih') }}" style="width:100%;display:flex;flex-direction:column;gap:12px;align-items:center;">
          @csrf
          <select name="setor_id" required {{ $antrian->isEmpty() ? 'disabled' : '' }} style="width:100%;padding:12px 14px;border:1px solid #E2E8F0;border-radius:12px;font-family:inherit;font-size:13px;background:#fff;">
            @if ($antrian->isEmpty())
              <option value="">Belum ada setoran yang menunggu</option>
            @else
              <option value="">Pilih setoran pelanggan...</option>
              @foreach ($antrian as $a)
                <option value="{{ $a->id }}">{{ $a->user->name }} - {{ $a->jumlah }} pcs - {{ $a->kode }}</option>
              @endforeach
            @endif
          </select>
          <button type="submit" class="btn-setor" id="btnSetorSekarang" {{ $antrian->isEmpty() ? 'disabled' : '' }}>Setor Sekarang</button>
        </form>

      </div>

    </div>
  </div>
</div>

</body>
</html>
