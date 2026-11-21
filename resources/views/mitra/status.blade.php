<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Status Operasional</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #f8fbfc;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }

    .card-container {
      background-color: #ffffff;
      width: 100%;
      max-width: 500px;
      border-radius: 40px;
      border: 1px solid #f0f0f0;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
      padding: 50px 40px;
    }

    .header {
      text-align: center;
      margin-bottom: 40px;
    }

    .header h1 {
      color: #2db3c0;
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 5px;
    }

    .header p {
      color: #8c8c8c;
      font-size: 13px;
      font-weight: 600;
    }

    .status-indicator {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 40px;
    }

    .dot {
      width: 18px;
      height: 18px;
      background-color: #ff0000;
      border-radius: 50%;
      transition: background-color 0.3s ease;
    }

    .status-text {
      color: #000000;
      font-size: 15px;
      font-weight: 700;
    }

    .section-title {
      color: #2db3c0;
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 15px;
    }

    .toggle-wrapper {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-bottom: 35px;
    }

    .switch {
      position: relative;
      display: inline-block;
      width: 54px;
      height: 30px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #b9b9b9;
      transition: .4s;
      border-radius: 34px;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 22px;
      width: 22px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      transition: .4s;
      border-radius: 50%;
    }

    input:checked + .slider {
      background-color: #2ecc71;
    }

    input:checked + .slider:before {
      transform: translateX(24px);
    }

    .toggle-label {
      color: #000000;
      font-size: 18px;
      font-weight: 700;
      transition: color 0.3s ease;
    }

    .input-box {
      border: 1px solid #b3b3b3;
      border-radius: 16px;
      padding: 15px 20px;
      margin-bottom: 40px;
    }

    .input-box input {
      width: 100%;
      border: none;
      border-bottom: 2px solid #dcdcdc;
      padding-bottom: 8px;
      font-size: 14px;
      font-weight: 600;
      color: #a0a0a0;
      outline: none;
    }

    .input-box input::placeholder {
      color: #a5a5a5;
    }

    .btn-simpan {
      width: 100%;
      background-color: #2db3c0;
      color: #ffffff;
      border: none;
      border-radius: 30px;
      padding: 18px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.1s ease;
    }

    .btn-simpan:hover {
      background-color: #2499a4;
    }

    .btn-simpan:active {
      transform: scale(0.98);
    }
  </style>
</head>
<body>
@include('partials.flash')

<div class="card-container">
  <div class="header">
    <h1>Status Operasional</h1>
    <p>Perbarui selalu status operasional kamu</p>
  </div>

  <div class="status-indicator">
    <div class="dot" id="statusDot"></div>
    <div class="status-text" id="statusMainText">Toko sedang tutup</div>
  </div>

  <form method="post" action="{{ route('mitra.status.update') }}">
  @csrf
  <h3 class="section-title">Ubah Status Toko</h3>
  <div class="toggle-wrapper">
    <label class="switch">
      <input type="checkbox" id="toggleSwitch" name="status_buka" value="1" {{ $usaha->status_buka ? 'checked' : '' }}>
      <span class="slider"></span>
    </label>
    <div class="toggle-label" id="toggleLabelText">Tutup</div>
  </div>

  <h3 class="section-title">Catatan Tambahan</h3>
  <div class="input-box">
    <input type="text" name="catatan_status" value="{{ old('catatan_status', $usaha->catatan_status) }}" maxlength="255" placeholder="(misal: libur karena maintenance).">
  </div>

  <button type="submit" class="btn-simpan" id="btnSimpan">Simpan Status Hari Ini</button>
  </form>
</div>

<script>

  const toggleSwitch = document.getElementById('toggleSwitch');
  const toggleLabelText = document.getElementById('toggleLabelText');
  const statusDot = document.getElementById('statusDot');
  const statusMainText = document.getElementById('statusMainText');

  function terapkanStatus() {
    if (toggleSwitch.checked) {
      toggleLabelText.textContent = "Buka";
      statusMainText.textContent = "Toko sedang buka";
      statusDot.style.backgroundColor = "#2ecc71";
      toggleLabelText.style.color = "#2ecc71";
    } else {
      toggleLabelText.textContent = "Tutup";
      statusMainText.textContent = "Toko sedang tutup";
      statusDot.style.backgroundColor = "#ff0000";
      toggleLabelText.style.color = "#000000";
    }
  }

  toggleSwitch.addEventListener('change', terapkanStatus);
  terapkanStatus(); // tampilkan status tersimpan dari database
</script>

</body>
</html>
