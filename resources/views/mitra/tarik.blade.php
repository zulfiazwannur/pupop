<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tarik Saldo</title>

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
      display: flex;
      gap: 32px;
      align-items: flex-start;
    }

    .sidebar-layout {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 24px;
      max-width: 340px;
      width: 100%;
    }

    .card-poin-mitra {
      background: #ffffff;
      border-radius: 24px;
      padding: 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.015);
      border: 1px solid #E2E8F0;
    }

    .card-poin-mitra .label-text {
      color: #a0aec0;
      font-size: 12px;
      font-weight: 500;
      margin-bottom: 2px;
    }

    .card-poin-mitra .value-text {
      font-size: 24px;
      font-weight: 700;
      color: #2d3748;
    }

    .card-poin-mitra .value-text span {
      color: #2BB6C4;
    }

    .star-icon-container {
      background-color: #EAF9FA;
      color: #2BB6C4;
      width: 44px;
      height: 44px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
    }

    .card-saldo-gradient {
      background: linear-gradient(180deg, #39cbd9 0%, #209ba7 100%);
      border-radius: 24px;
      padding: 28px;
      color: #ffffff;
      box-shadow: 0 8px 24px rgba(43, 182, 196, 0.2);
    }

    .card-saldo-gradient .label-text {
      font-size: 14px;
      font-weight: 400;
      opacity: 0.95;
      margin-bottom: 6px;
    }

    .card-saldo-gradient .amount-text {
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 16px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.3);
      padding-bottom: 16px;
    }

    .card-saldo-gradient .desc-text {
      font-size: 12px;
      line-height: 1.6;
      opacity: 0.9;
    }

    .card-catatan-box {
      background: #ffffff;
      border: 4px solid #2BB6C4;
      border-radius: 24px;
      padding: 24px;
    }

    .card-catatan-box h3 {
      font-size: 12px;
      font-weight: 700;
      color: #2d3748;
      margin-bottom: 12px;
      letter-spacing: 0.5px;
    }

    .card-catatan-box p {
      font-size: 11px;
      color: #4a5568;
      line-height: 1.6;
      margin-bottom: 14px;
    }

    .card-catatan-box p:last-child {
      margin-bottom: 0;
    }

    .main-form-card {
      flex: 2.5;
      background: #ffffff;
      border: 1.5px solid #E2E8F0;
      border-radius: 32px;
      padding: 40px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.01);
    }

    .form-item-group {
      margin-bottom: 24px;
    }

    .form-item-group label {
      display: block;
      font-size: 14px;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 10px;
    }

    .input-field {
      width: 100%;
      background-color: #f7fafc;
      border: 1px solid #E2E8F0;
      border-radius: 14px;
      padding: 16px 20px;
      font-size: 13px;
      color: #2d3748;
      outline: none;
      transition: border-color 0.2s;
    }

    .input-field:focus {
      border-color: #2BB6C4;
    }

    .input-field::placeholder {
      color: #a0aec0;
    }

    .dropdown-select-wrapper {
      position: relative;
      margin-bottom: 14px;
    }

    .dropdown-select-wrapper:last-child {
      margin-bottom: 0;
    }

    .dropdown-select-wrapper select {
      appearance: none;
      -webkit-appearance: none;
      cursor: pointer;
    }

    .dropdown-select-wrapper::after {
      content: "";
      position: absolute;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
      width: 12px;
      height: 8px;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 10 6'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%23718096' stroke-width='2' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
      background-size: contain;
      background-repeat: no-repeat;
      pointer-events: none;
    }

    .submit-withdraw-btn {
      width: 100%;
      background-color: #2BB6C4;
      color: #ffffff;
      border: none;
      border-radius: 16px;
      padding: 18px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 6px 20px rgba(43, 182, 196, 0.25);
      transition: background-color 0.2s, transform 0.1s;
      margin-top: 12px;
    }

    .submit-withdraw-btn:hover {
      background-color: #229aa6;
    }

    .submit-withdraw-btn:active {
      transform: scale(0.99);
    }

    .popup-blur-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.4);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 2000;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s ease;
    }

    .popup-blur-overlay.active {
      opacity: 1;
      pointer-events: auto;
    }

    .frame-40-box {
      background-color: #ffffff;
      padding: 36px;
      border-radius: 28px;
      width: 90%;
      max-width: 440px;
      text-align: center;
      box-shadow: 0 12px 36px rgba(0, 0, 0, 0.15);
      transform: translateY(-25px);
      transition: transform 0.3s ease;
    }

    .popup-blur-overlay.active .frame-40-box {
      transform: translateY(0);
    }

    .popup-alert-icon {
      width: 64px;
      height: 64px;
      background-color: #EAF9FA;
      color: #2BB6C4;
      font-size: 30px;
      font-weight: 700;
      border-radius: 50%;
      display: inline-flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 20px;
    }

    .frame-40-box h2 {
      font-size: 20px;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 12px;
    }

    .frame-40-box p {
      font-size: 13px;
      color: #718096;
      line-height: 1.6;
      margin-bottom: 28px;
    }

    .popup-action-buttons {
      display: flex;
      gap: 14px;
    }

    .modal-btn {
      flex: 1;
      padding: 14px;
      border-radius: 12px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      border: none;
      transition: background 0.2s;
    }

    .btn-dismiss {
      background-color: #edf2f7;
      color: #4a5568;
    }

    .btn-dismiss:hover {
      background-color: #e2e8f0;
    }

    .btn-proceed {
      background-color: #2BB6C4;
      color: #ffffff;
    }

    .btn-proceed:hover {
      background-color: #229aa6;
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
      <h2>Tarik Saldo</h2>
      <p>Saldo anda</p>
    </div>
  </div>
</div>

<div class="content-container">

  <div class="sidebar-layout">
    <div class="card-poin-mitra">
      <div>
        <p class="label-text">Poin Anda</p>
        <p class="value-text">{{ number_format($user->poin, 0, ',', '.') }} <span>Pupin</span></p>
      </div>
      <div class="star-icon-container">
        <i class="ph-fill ph-star"></i>
      </div>
    </div>

    <div class="card-saldo-gradient">
      <p class="label-text">Saldo Pupin Anda</p>
      <p class="amount-text">Rp {{ number_format($user->saldo, 0, ',', '.') }},00</p>
      <p class="desc-text">Tersedia untuk ditarik ke rekening bank atau e-wallet pilihan Anda.</p>
    </div>

    <div class="card-catatan-box">
      <h3>CATATAN:</h3>
      <p>Proses Penarikan Membutuhkan Waktu 1-3 Hari Kerja.</p>
      <p>Pastikan Nomor Rekening Atau Nomor HP E-Wallet Sudah Benar.</p>
      <p>Biaya Administrasi Mungkin Berlaku Sesuai Kebijakan Penyedia Layanan.</p>
    </div>
  </div>

  <div class="main-form-card">
    <form id="formPenarikanDana" method="post" action="{{ route('mitra.tarik.store') }}">
      @csrf

      <div class="form-item-group">
        <label>Tarik Saldo</label>
        <input type="text" inputmode="numeric" name="jumlah" id="inputJumlah" value="{{ old('jumlah') }}" maxlength="10" class="input-field" placeholder="Masukkan Jumlah Penarikan (min. 10000)">
      </div>

      <div class="form-item-group">
        <label>Pilih Metode Penarikan</label>

        <div class="dropdown-select-wrapper">
          <select class="input-field" id="dropdownBank" name="bank">
            <option value="" selected>Rekening Bank</option>
            <option value="bca">BCA (Bank Central Asia)</option>
            <option value="mandiri">Bank Mandiri</option>
            <option value="bni">BNI (Bank Negara Indonesia)</option>
            <option value="bri">BRI (Bank Rakyat Indonesia)</option>
          </select>
        </div>

        <div class="dropdown-select-wrapper">
          <select class="input-field" id="dropdownWallet" name="ewallet">
            <option value="" selected>E-Wallet</option>
            <option value="gopay">GoPay</option>
            <option value="ovo">OVO</option>
            <option value="dana">DANA</option>
            <option value="linkaja">LinkAja</option>
          </select>
        </div>
      </div>

      <div class="form-item-group">
        <label>Masukkan No Rekening / No Hp E-Wallet</label>
        <input type="text" inputmode="numeric" name="tujuan" id="inputTujuan" value="{{ old('tujuan') }}" maxlength="20" class="input-field" placeholder="Masukkan No Rek / Hp">
      </div>

      <button type="button" class="submit-withdraw-btn" id="triggerTarikBtn">Tarik Sekarang</button>
    </form>
  </div>

</div>

<div class="popup-blur-overlay" id="popupFrame40">
  <div class="frame-40-box">
    <div class="popup-alert-icon">?</div>
    <h2>Konfirmasi Penarikan</h2>
    <p>Apakah Anda yakin ingin melakukan transaksi penarikan saldo ini? Pastikan seluruh data instansi tujuan transfer Anda sudah terisi dengan benar.</p>
    <div class="popup-action-buttons">
      <button class="modal-btn btn-dismiss" id="dismissPopupBtn">Kembali</button>
      <button class="modal-btn btn-proceed" id="confirmWithdrawBtn">Ya, Tarik Sekarang</button>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const dropdownBank = document.getElementById('dropdownBank');
    const dropdownWallet = document.getElementById('dropdownWallet');
    const triggerTarikBtn = document.getElementById('triggerTarikBtn');
    const popupFrame40 = document.getElementById('popupFrame40');
    const dismissPopupBtn = document.getElementById('dismissPopupBtn');
    const confirmWithdrawBtn = document.getElementById('confirmWithdrawBtn');

    dropdownBank.addEventListener('change', function() {
      if (this.value !== "") {
        dropdownWallet.value = "";
      }
    });

    dropdownWallet.addEventListener('change', function() {
      if (this.value !== "") {
        dropdownBank.value = "";
      }
    });

    triggerTarikBtn.addEventListener('click', function() {
      // Validasi sisi klien; server tetap memvalidasi ulang.
      const jumlah = document.getElementById('inputJumlah').value.trim();
      const tujuan = document.getElementById('inputTujuan').value.trim();
      if (!/^[0-9]+$/.test(jumlah) || parseInt(jumlah, 10) < 10000) { alert('Jumlah penarikan harus angka, minimal 10000.'); return; }
      if (dropdownBank.value === '' && dropdownWallet.value === '') { alert('Pilih rekening bank atau e-wallet.'); return; }
      if (!/^[0-9]{8,20}$/.test(tujuan)) { alert('Nomor rekening / HP hanya angka (8-20 digit).'); return; }
      popupFrame40.classList.add('active');
    });

    dismissPopupBtn.addEventListener('click', function() {
      popupFrame40.classList.remove('active');
    });


    popupFrame40.addEventListener('click', function(e) {
      if (e.target === popupFrame40) {
        popupFrame40.classList.remove('active');
      }
    });

    confirmWithdrawBtn.addEventListener('click', function() {

      document.getElementById('formPenarikanDana').submit();
    });
  });
</script>

</body>
</html>
