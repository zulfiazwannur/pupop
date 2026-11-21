<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Setor Sukses</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body, html {
      height: 100%;
      background-color: #ffffff; /* Latar belakang bawah warna putih */
    }

    .container {
      display: flex;
      flex-direction: column;
      width: 100vw;
      height: 100vh;
    }

    .top-section {
      flex: 1;
      background: linear-gradient(180deg, #51e6f5 0%, #2dcddc 100%);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      border-bottom-left-radius: 12px;
      border-bottom-right-radius: 12px;
    }

    .mascot-img {
      width: 260px;
      height: auto;
      margin-bottom: 10px;
    }

    .title {
      color: #ffffff;
      font-size: 36px;
      font-weight: 700;
      margin-bottom: 8px;
      letter-spacing: 0.5px;
    }

    .subtitle {
      color: #ffffff;
      font-size: 20px;
      font-weight: 400;
      text-align: center;
      line-height: 1.5;
    }

    .bottom-section {
      height: 250px;
      background-color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .btn-selesai {
      background-color: #3dd4df;
      color: #ffffff;
      border: none;
      padding: 16px 120px;
      border-radius: 50px;
      font-size: 20px;
      font-weight: 700;
      cursor: pointer;
      transition: background-color 0.2s, transform 0.1s;
    }

    .btn-selesai:hover {
      background-color: #2bbac5;
    }

    .btn-selesai:active {
      transform: scale(0.98);
    }
  </style>
</head>
<body>

<div class="container">
  <div class="top-section">
    <img src="{{ asset('img/mitra/POP.png') }}" alt="Maskot POP" class="mascot-img">
    <h1 class="title">Setor Sukses !!</h1>
    <p class="subtitle">Popok dari user telah<br>sukses di setor</p>
  </div>

  <div class="bottom-section">
    <button class="btn-selesai" id="btnSelesai">Selesai</button>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const btnSelesai = document.getElementById('btnSelesai');

    btnSelesai.addEventListener('click', function() {
      window.location.href = '{{ route('mitra.home') }}';
    });
  });
</script>

</body>
</html>
