<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Terima Setor (Detail)</title>

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
      color: #718096;
      line-height: 1.6;
    }

    .right-card {
      align-items: flex-start; /* Rata kiri */
      text-align: left;
    }

    .profile-row {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 40px;
      width: 100%;
    }

    .avatar-container {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      background-color: #ff3b30;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .avatar-container img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .profile-text h4 {
      font-size: 18px;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 4px;
    }

    .profile-text p {
      font-size: 14px;
      color: #718096;
    }

    .detail-group {
      margin-bottom: 20px;
      width: 100%;
    }

    .detail-title {
      font-size: 13px;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 8px;
    }

    .detail-value {
      font-size: 13px;
      color: #a0aec0;
    }

    .divider {
      width: 70%;
      border: none;
      border-top: 1.5px solid #E2E8F0;
      margin: 25px 0;
    }

    .btn-container {
      width: 100%;
      margin-top: auto;
      display: flex;
      justify-content: center;
    }

    .btn-terima {
      width: 100%;
      max-width: 320px;
      background-color: #2BB6C4;
      color: white;
      border: none;
      padding: 14px 0;
      font-size: 16px;
      font-weight: 700;
      border-radius: 30px;
      cursor: pointer;
      text-align: center;
      transition: background 0.2s;
    }

    .btn-terima:hover {
      background-color: #2299a5;
    }

    @media (max-width: 768px) {
      .outer-frame-card { padding: 20px; }
      .main-grid { grid-template-columns: 1fr; gap: 20px; }
      .inner-card { padding: 24px; }
      .left-card .image-container { height: 200px; }
      .divider { width: 100%; }
      .btn-terima { max-width: 100%; }
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

        <div class="profile-row">
          <div class="avatar-container">
            <img src="{{ asset('img/mitra/21.png') }}" alt="Foto pelanggan">
          </div>
          <div class="profile-text">
            <h4>User - {{ $setor->user->name }}</h4>
            <p>{{ $setor->user->email }}</p>
          </div>
        </div>

        <div class="detail-group">
          <div class="detail-title">Jumlah Setor</div>
          <div class="detail-value">{{ number_format($setor->jumlah, 2, ',', '.') }} Pcs</div>
        </div>

        <hr class="divider">

        <div class="detail-group">
          <div class="detail-title">Poin yang di dapatkan</div>
          <div class="detail-value">{{ $poin }} Poin</div>
        </div>

        <div class="btn-container">
          <form method="post" action="{{ route('mitra.terima.proses', $setor->id) }}" style="display:contents">
            @csrf
            <button type="submit" class="btn-terima" id="btnTerimaSetor">Terima Setor</button>
          </form>
        </div>

      </div>

    </div>
  </div>
</div>

</body>
</html>
