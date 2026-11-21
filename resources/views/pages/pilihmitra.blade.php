<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pilih Mitra</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>

    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
      font-family:'Poppins',sans-serif;
    }

    body{
      background:#f4f4f4;
    }

    .header-wrapper{
      background:#2BB6C4;
      padding:24px;
      border-radius:0 0 40px 40px;
      box-shadow:0 8px 25px rgba(0,0,0,.08);
    }

    .header-card{
      background:white;
      border-radius:24px;
      height:73px;

      display:flex;
      align-items:center;
      gap:20px;

      padding:0 30px;
    }

    .back-btn{
      width:38px;
      height:38px;

      border:none;
      border-radius:50%;

      background:#E8F8FA;
      color:#0E7D88;

      font-size:24px;
      cursor:pointer;
    }

    .header-title{
      color:#40C4D4;
      font-size:22px;
      font-weight:700;
    }

    .header-subtitle{
      color:#666;
      font-size:14px;
      margin-top:2px;
    }

    .content{
      padding:30px 24px;
    }

    .main-card{
      background:white;
      border-radius:28px;

      min-height:600px;

      display:flex;

      overflow:hidden;

      border:1px solid #d8d8d8;

      box-shadow:0 3px 15px rgba(0,0,0,.08);
    }

    .sidebar{
      width:480px;
      padding:28px;

      border-right:1px solid #cfcfcf;
    }

    .radio-group{
      display:flex;
      flex-direction:column;
      gap:24px;
    }

    .radio-row{
      display:flex;
      justify-content:space-between;
      align-items:center;
    }

    .radio-row span{
      font-size:18px;
      font-weight:600;
    }

    .radio-row input{
      appearance:none;

      width:26px;
      height:26px;

      border-radius:50%;

      border:1px solid #aaa;
      cursor:pointer;
    }

    .radio-row input:checked{
      background:#40C4D4;
      border:4px solid white;
      box-shadow:0 0 0 1px #40C4D4;
    }

    .search-input{
      width:100%;
      height:46px;

      border:none;
      outline:none;

      background:#f1f1f1;

      border-radius:24px;

      padding:0 20px;

      margin-top:22px;

      font-size:18px;
    }

    .tabs{
      display:flex;
      justify-content:space-between;

      margin-top:12px;

      border-bottom:1px solid #d7d7d7;
    }

    .tab{
      position:relative;

      border:none;
      background:none;

      padding:12px 14px;

      font-weight:600;

      cursor:pointer;

      color:#888;
    }

    .tab.active{
      color:#40C4D4;
    }

    .tab.active::after{
      content:"";

      position:absolute;

      left:0;
      bottom:-1px;

      width:100%;
      height:4px;

      border-radius:20px;

      background:#40C4D4;
    }


    .partner-card{
      margin-top:18px;

      display:flex;
      gap:16px;

      padding:14px;

      border-radius:18px;

      border:1px solid #d7d7d7;

      cursor:pointer;
      transition:.2s;
    }

    .partner-card.active{
      border-color:#40C4D4;
    }

    .partner-card:hover{
      transform:translateY(-2px);
    }

    .partner-icon{
      width:94px;
      height:94px;

      border-radius:14px;

      background:#40C4D4;

      display:flex;
      justify-content:center;
      align-items:center;
    }

    .partner-icon img{
      width:54px;
    }

    .partner-info h3{
      font-size:18px;
      margin-bottom:6px;
    }

    .partner-info p{
      color:#777;
      font-size:14px;
    }

    .partner-info small{
      color:#777;
      font-size:13px;
    }

    .selected{
      margin-top:24px;
    }

    .selected h2{
      font-size:18px;
      margin-bottom:12px;
    }

    .selected p{
      color:#777;
      line-height:1.7;
      font-weight:500;
    }


    .action-buttons{
      display:flex;
      gap:22px;

      margin-top:24px;
    }

    .btn{
      flex:1;
      height:66px;

      border-radius:22px;

      font-size:18px;
      font-weight:600;

      cursor:pointer;
    }

    .btn-outline{
      border:1.5px solid #40C4D4;
      background:white;
      color:#40C4D4;
      box-shadow: 2px 2px 2px rgb(128 128 128 / 0.65);
    }

    .btn-primary{
      border:none;
      background:#40C4D4;
      color:white;
    }


    .map-section{
      flex:1;
      padding:24px;
    }

    .map-container{
      width:100%;
      height:100%;

      position:relative;

      border-radius:24px;
      overflow:hidden;
    }

    .map-container img.map{
      width:100%;
      height:100%;
      object-fit:cover;
    }

    .map-popup img{
      width:42px;
    }

    .map-popup h4{
      font-size:16px;
    }

    .map-popup p{
      font-size:11px;
      color:#666;
    }

    .map-popup small{
      font-size:10px;
      color:#666;
    }

    @media(max-width:1100px){

      .main-card{
        flex-direction:column;
        height:auto;
      }

      .sidebar{
        width:100%;
        border-right:none;
        border-bottom:1px solid #ddd;
      }

      .map-section{
        height:500px;
      }

    }
    .custom-popup{
      position:fixed;
      inset:0;
      background:rgba(0,0,0,.4);
      display:none;
      justify-content:center;
      align-items:center;
      z-index:9999;
    }

    .popup-content{
      background:white;
      padding:24px;
      border-radius:20px;
      width:320px;
      text-align:center;
      box-shadow:0 10px 30px rgba(0,0,0,.2);
    }

    .popup-content h3{
      color:#40C4D4;
      margin-bottom:10px;
    }

    .popup-content p{
      margin-bottom:20px;
      color:#555;
    }

    .popup-content button{
      border:none;
      background:#40C4D4;
      color:white;
      padding:10px 24px;
      border-radius:12px;
      cursor:pointer;
    }

  </style>
</head>
<body>
<form id="formPilih" method="post" action="{{ route('pilihmitra.store') }}" style="display:none">@csrf<input type="hidden" name="lokasi_mitra_id" id="inputMitraId" value="{{ $terpilih }}"></form>

<div class="header-wrapper">

  <div class="header-card">

    <button class="back-btn" id="btnBack"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
      <line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline>
    </svg></button>

    <div>
      <div class="header-title">
        Pilih Mitra Anda
      </div>

      <div class="header-subtitle">
        Mitra favorit kamu
      </div>
    </div>

  </div>

</div>

<div class="content">

  <div class="main-card">

    <div class="sidebar">

      <div class="radio-group">

        <label class="radio-row">
          <span>Sering di pilih</span>
          <input type="radio" checked name="mitra">
        </label>

        <label class="radio-row">
          <span>Cari Berdasarkan Kota</span>
          <input type="radio" name="mitra">
        </label>

      </div>

      <form method="get" action="{{ route('pilihmitra') }}" style="display:block">
      <input
        class="search-input"
        type="text"
        name="kota"
        value="{{ $kota }}"
        maxlength="100"
        placeholder="Kota (tekan Enter untuk mencari)"
      >
      </form>

      <div class="tabs">
        <button class="tab">
          List
        </button>

        <button class="tab active">
          Lokasi
        </button>
      </div>

      @forelse ($daftar as $m)
      <div class="partner-card {{ $m->id == $terpilih ? 'active' : '' }}" data-id="{{ $m->id }}" data-nama="{{ $m->nama }}" data-alamat="{{ $m->alamat }}" data-kota="{{ $m->kota }}" data-jam="Buka: {{ $m->jam_buka }} - {{ $m->jam_tutup }}">

        <div class="partner-icon">
          <img src="{{ asset('img/log.png') }}">
        </div>

        <div class="partner-info">
          <h3>{{ $m->nama }}</h3>
          <p>{{ $m->kota }}</p>
          <small>Buka: {{ $m->jam_buka }} - {{ $m->jam_tutup }}</small>
        </div>

      </div>
      @empty
      <p style="font-size:13px;color:#718096;padding:12px 0;">Tidak ada mitra{{ $kota !== '' ? ' di kota "' . $kota . '"' : '' }}.</p>
      @endforelse

      <div class="selected">

        <h2>Mitra di pilih</h2>

        <p id="selectedAlamat">
          {{ $daftar->firstWhere('id', $terpilih)?->alamat ?? 'Belum ada mitra dipilih' }}
        </p>

      </div>

      <div class="action-buttons">

        <button class="btn btn-outline" id="cancelBtn">
          Batal
        </button>
        <button class="btn btn-primary" id="saveBtn">
          Simpan
        </button>
      </div>
    </div>

    <div class="map-section">
      <div class="map-container">
        <img src="{{ asset('img/map.png') }}" class="map">

          <div>
            <h4 id="mapNama">{{ $daftar->firstWhere('id', $terpilih)?->nama ?? '-' }}</h4>
            <p id="mapKota">{{ $daftar->firstWhere('id', $terpilih)?->kota }}</p>
            <small id="mapJam"></small>
          </div>

        </div>

      </div>

    </div>

  </div>

</div>

<script>

    const saveBtn = document.getElementById("saveBtn");
    const cancelBtn = document.getElementById("cancelBtn");
    const btnBack = document.getElementById("btnBack");
    const cards = document.querySelectorAll(".partner-card");
    const inputMitraId = document.getElementById("inputMitraId");

    function showPopup(title,message){
    document.getElementById("popupTitle").textContent = title;
    document.getElementById("popupMessage").textContent = message;
    document.getElementById("customPopup").style.display = "flex";
  }
    function closePopup(){
    document.getElementById("customPopup").style.display = "none";
  }

    function pilihKartu(card){
    cards.forEach(c => c.classList.remove("active"));
    card.classList.add("active");
    inputMitraId.value = card.dataset.id;
    document.getElementById("selectedAlamat").textContent = card.dataset.alamat;
    document.getElementById("mapNama").textContent = card.dataset.nama;
    document.getElementById("mapKota").textContent = card.dataset.kota;
    document.getElementById("mapJam").textContent = card.dataset.jam;
  }

    cards.forEach(card => card.addEventListener("click", () => pilihKartu(card)));

    const aktif = document.querySelector(".partner-card.active");
    if (aktif) { document.getElementById("mapJam").textContent = aktif.dataset.jam; }

    saveBtn.addEventListener("click",()=>{
    if (!inputMitraId.value) {
      showPopup("Belum dipilih", "Pilih salah satu mitra terlebih dahulu.");
      return;
    }
    document.getElementById("formPilih").submit();
  });

    cancelBtn.addEventListener("click",()=>{
    showPopup(
      "Dibatalkan",
      "Pemilihan mitra telah dibatalkan."
    );
  });

    document.querySelectorAll(".tab").forEach(tab=>{
    tab.addEventListener("click",()=>{

      document
        .querySelectorAll(".tab")
        .forEach(t=>t.classList.remove("active"));

      tab.classList.add("active");
    });
  });

    btnBack.addEventListener("click",()=>{

    if(document.referrer){
    history.back();
  }else{
    window.location.href = "{{ route('home') }}";
  }

  });

    document.addEventListener("DOMContentLoaded", () => {
    @if (session('status'))
    showPopup("Berhasil", @json(session('status')));
    @endif
    @if ($errors->any())
    showPopup("Gagal", @json($errors->first()));
    @endif
    });

</script>

<div id="customPopup" class="custom-popup">
  <div class="popup-content">
    <h3 id="popupTitle">Berhasil</h3>
    <p id="popupMessage">Data berhasil disimpan</p>
    <button onclick="closePopup()">OK</button>
  </div>
</div>

</body>
</html>
