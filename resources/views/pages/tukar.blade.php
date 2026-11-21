<!DOCTYPE html>
<html lang="id">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Penukaran - PuPoP</title>
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
      padding-bottom: 120px;
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
      max-width: 1500px;
      margin: 30px auto;
      padding: 0 20px;
    }

    .tabs-container {
      display: flex;
      gap: 16px;
      margin-bottom: 30px;
    }

    .btn-tab {
      padding: 12px 28px;
      border-radius: 30px;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      border: 1px solid #CBD5E0;
      background-color: transparent;
      color: #718096;
    }

    .btn-tab.active {
      background-color: #38C6D5;
      color: white;
      border-color: #38C6D5;
    }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 16px;
    }

    .product-card {
      background: #ffffff;
      border-radius: 20px;
      padding: 20px 14px;
      border: 1px solid #E2E8F0;
      box-shadow: 0 6px 20px rgba(0,0,0,0.03);
      display: flex;
      flex-direction: column;
      position: relative;
    }

    .product-img-wrapper {
      height: 120px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 16px;
    }

    .product-img-wrapper img {
      max-height: 100%;
      max-width: 100%;
      object-fit: contain;
    }

    .product-title {
      font-size: 14px;
      font-weight: 700;
      color: #38C6D5;
      margin-bottom: 6px;
      line-height: 1.3;
    }

    .product-desc {
      font-size: 10px;
      color: #A0AEC0;
      line-height: 1.4;
      margin-bottom: 20px;
      flex-grow: 1;
    }

    .card-action {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      height: 32px;
    }

    .btn-tambah {
      background-color: #38C6D5;
      color: white;
      border: none;
      border-radius: 8px;
      padding: 6px 16px;
      font-size: 12px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s;
    }

    .btn-tambah:hover {
      background-color: #2bb6c4;
    }

    .qty-control {
      display: none;
      align-items: center;
      justify-content: space-between;
      width: 85px;
      background: #EAF9FA;
      border-radius: 8px;
      padding: 4px;
      border: 1px solid #38C6D5;
    }

    .qty-control button {
      background: none;
      border: none;
      color: #38C6D5;
      font-size: 18px;
      font-weight: 600;
      cursor: pointer;
      width: 24px;
      height: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .qty-val {
      font-size: 13px;
      font-weight: 700;
      color: #1a202c;
    }

    .bottom-bar-wrapper {
      position: fixed;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      width: calc(100% - 40px);
      max-width: 1000px;
      background: white;
      border-radius: 20px;
      padding: 16px 24px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
      border: 1px solid #E2E8F0;
      z-index: 100;
    }

    .points-info {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .wallet-icon {
      width: 48px;
      height: 48px;
      background-color: #38C6D5;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
    }

    .points-text {
      display: flex;
      flex-direction: column;
    }

    .points-label {
      font-size: 12px;
      color: #718096;
      font-weight: 500;
    }

    .points-value {
      font-size: 20px;
      font-weight: 700;
      color: #00796B;
    }

    .action-buttons {
      display: flex;
      gap: 12px;
    }

    .btn-batal {
      padding: 12px 32px;
      border-radius: 30px;
      border: 1px solid #718096;
      background: white;
      color: #4A5568;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
    }

    .btn-lanjut {
      padding: 12px 32px;
      border-radius: 30px;
      border: none;
      background: #38C6D5;
      color: white;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
    }

    @media (max-width: 1024px) {
      .product-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 768px) {
      .product-grid { grid-template-columns: repeat(2, 1fr); }
      .bottom-bar-wrapper { flex-direction: column; gap: 16px; padding: 16px; }
      .points-info { width: 100%; justify-content: flex-start; }
      .action-buttons { width: 100%; }
      .action-buttons button { flex: 1; }
    }
    @media (max-width: 480px) {
      .product-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>
@if (session('status'))
<script>alert(@json(session('status')));</script>
@endif
@if ($errors->any())
<script>alert(@json($errors->first()));</script>
@endif

<div class="header-wrapper">
  <div class="header-card">
    <button class="back-btn" id="btnBack" aria-label="Kembali" onclick="window.location.href = '{{ route('home') }}'">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
        <line x1="19" y1="12" x2="5" y2="12"></line>
        <polyline points="12 19 5 12 12 5"></polyline>
      </svg>
    </button>
    <div class="header-text">
      <h2>Penukaran</h2>
      <p>Tukar poinmu disini..</p>
    </div>
  </div>
</div>

<div class="content-container">
  <div class="tabs-container">
    <button class="btn-tab active">Rumah Tangga</button>
    <button class="btn-tab">Pertanian</button>
  </div>

  <div class="product-grid" id="productGrid">
    @foreach ($produkList as $produk)
    <div class="product-card" data-category="{{ $produk->kategori }}" data-produk-id="{{ $produk->id }}">
      <div class="product-img-wrapper">
        <img src="{{ $produk->gambarUrl() }}" alt="{{ $produk->nama }}">
      </div>
      <div class="product-title">{{ $produk->nama }}</div>
      <div class="product-desc">Tukar coin dari setor popok untuk mendapatkan barang ({{ $produk->poin }} poin)</div>
      <div class="card-action">
        <button class="btn-tambah">Tambah</button>
        <div class="qty-control">
          <button class="btn-min">-</button>
          <span class="qty-val">0</span>
          <button class="btn-plus">+</button>
        </div>
      </div>
    </div>
    @endforeach

  </div>
</div>

<div class="bottom-bar-wrapper">
  <div class="points-info">
    <div class="wallet-icon">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="2" y="5" width="20" height="14" rx="2"></rect>
        <line x1="2" y1="10" x2="22" y2="10"></line>
        <path d="M16 14h.01"></path>
      </svg>
    </div>
    <div class="points-text">
      <span class="points-label">Total Poin Digunakan</span>
      <span class="points-value" id="totalPoinDisplay">0 Poin</span>
    </div>
  </div>
  <div class="action-buttons">
    <button class="btn-batal" id="btnBatal">Batal</button>
    <button class="btn-lanjut" id="btnLanjut">Lanjut</button>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Keranjang tersimpan di database; di sini hanya ditampilkan & diubah lewat AJAX (fetch).
    let cart = @json($keranjang);
    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    const totalPoinDisplay = document.getElementById("totalPoinDisplay");
    const cards = document.querySelectorAll('.product-card');

    async function kirim(url, method, body) {
      try {
        const res = await fetch(url, {
          method: method,
          headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf },
          body: body ? JSON.stringify(body) : undefined
        });
        const data = await res.json();
        if (!res.ok) {
          alert(data.errors ? Object.values(data.errors)[0][0] : (data.message || 'Terjadi kesalahan.'));
          return false;
        }
        cart = data;
        render();
        return true;
      } catch (e) {
        alert('Gagal terhubung ke server. Coba lagi.');
        return false;
      }
    }

    function itemUntuk(card) {
      return cart.items.find(i => String(i.produk_id) === card.dataset.produkId);
    }

    function render() {
      cards.forEach(card => {
        const item = itemUntuk(card);
        const btnTambah = card.querySelector('.btn-tambah');
        const qtyControl = card.querySelector('.qty-control');
        card.querySelector('.qty-val').textContent = item ? item.qty : 0;
        btnTambah.style.display = item ? 'none' : 'block';
        qtyControl.style.display = item ? 'flex' : 'none';
      });
      totalPoinDisplay.textContent = `${cart.total_poin} Poin`;
    }

    cards.forEach(card => {
      const pid = card.dataset.produkId;

      card.querySelector('.btn-tambah').addEventListener('click', () => {
        kirim('{{ route('keranjang.store') }}', 'POST', { produk_id: pid, qty: 1 });
      });

      card.querySelector('.btn-plus').addEventListener('click', () => {
        const item = itemUntuk(card);
        if (item) kirim('{{ url('keranjang') }}/' + item.id, 'PATCH', { qty: item.qty + 1 });
      });

      card.querySelector('.btn-min').addEventListener('click', () => {
        const item = itemUntuk(card);
        if (!item) return;
        if (item.qty <= 1) kirim('{{ url('keranjang') }}/' + item.id, 'DELETE');
        else kirim('{{ url('keranjang') }}/' + item.id, 'PATCH', { qty: item.qty - 1 });
      });
    });

    document.getElementById("btnBatal").addEventListener("click", function() {
      if (cart.items.length === 0) return;
      if (confirm('Kosongkan semua barang yang sudah dipilih?')) {
        kirim('{{ route('keranjang.clear') }}', 'DELETE');
      }
    });

    document.getElementById("btnLanjut").addEventListener("click", function() {
      if (cart.total_item === 0) {
        alert("Silahkan tambah minimal 1 barang terlebih dahulu!");
        return;
      }
      window.location.href = "{{ route('tukar1') }}";
    });

    render();
  });
</script>
</body>
</html>
