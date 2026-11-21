{{-- Popup "Edit Profil" untuk halaman profil mitra (CRUD profil: ubah nama/lokasi/foto, hapus foto, hapus akun). --}}
<style>
  #pmOverlay { position: fixed; inset: 0; background: rgba(0,0,0,.4); display: none; align-items: center; justify-content: center; z-index: 10000; padding: 20px; }
  .pm-modal { background: #fff; width: 100%; max-width: 520px; border-radius: 24px; box-shadow: 0 10px 40px rgba(0,0,0,.2); padding: 32px; position: relative; max-height: 92vh; overflow: auto; font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif; }
  .pm-modal h2 { color: #005B66; font-size: 24px; font-weight: 700; margin-bottom: 6px; }
  .pm-sub { color: #718096; font-size: 13px; margin-bottom: 20px; }
  .pm-form { display: flex; flex-direction: column; gap: 12px; }
  .pm-form label { color: #2d3748; font-size: 13px; font-weight: 600; }
  .pm-form input[type=text], .pm-form input[type=file], .pm-form input[type=password] { width: 100%; padding: 12px 14px; border: 1px solid #E2E8F0; border-radius: 12px; font-size: 13px; font-family: inherit; }
  .pm-check { display: flex; align-items: center; gap: 8px; font-size: 12px; color: #4A5568; }
  .pm-actions { display: flex; justify-content: flex-end; gap: 12px; margin-top: 8px; }
  .pm-cancel { background: #fff; border: 1px solid #CBD5E0; border-radius: 30px; padding: 10px 22px; font-size: 13px; font-weight: 600; cursor: pointer; font-family: inherit; }
  .pm-save { background: #2BB6C4; color: #fff; border: none; border-radius: 30px; padding: 10px 22px; font-size: 13px; font-weight: 600; cursor: pointer; font-family: inherit; }
  .pm-delete { border-top: 1px solid #E2E8F0; margin-top: 18px; padding-top: 16px; display: flex; flex-direction: column; gap: 10px; }
  .pm-delete p { font-size: 12px; color: #718096; }
  .pm-delete button { align-self: flex-start; background: #C62828; color: #fff; border: none; border-radius: 30px; padding: 9px 20px; font-size: 12px; font-weight: 600; cursor: pointer; font-family: inherit; }
</style>

<div id="pmOverlay">
  <div class="pm-modal">
    <h2>Edit Profil</h2>
    <p class="pm-sub">Perbarui informasi akun mitra Anda.</p>

    <form class="pm-form" id="pmForm" method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <label for="pmName">Nama</label>
      <input type="text" id="pmName" name="name" value="{{ old('name', $user->name) }}" maxlength="100" required>

      <label for="pmLokasi">Lokasi</label>
      <input type="text" id="pmLokasi" name="lokasi" value="{{ old('lokasi', $user->lokasi) }}" maxlength="255">

      <label for="pmFoto">Foto Profil</label>
      <input type="file" id="pmFoto" name="foto" accept=".jpg,.jpeg,.png">
      @if ($user->foto_profil)
        <label class="pm-check"><input type="checkbox" name="hapus_foto" value="1"> Hapus foto profil saat ini</label>
      @endif

      <div class="pm-actions">
        <button type="button" class="pm-cancel" onclick="pmTutup()">Batal</button>
        <button type="submit" class="pm-save">Simpan Perubahan</button>
      </div>
    </form>

    <form class="pm-delete" method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Akun mitra dan seluruh datanya akan dihapus permanen. Lanjutkan?')">
      @csrf
      @method('DELETE')
      <p>Hapus akun: lokasi, data usaha, dan riwayat transaksi ikut terhapus permanen.</p>
      <input type="password" name="password_hapus" placeholder="Masukkan password untuk konfirmasi" required>
      <button type="submit">Hapus Akun</button>
    </form>
  </div>
</div>

<script>
  const pmOverlay = document.getElementById('pmOverlay');
  function pmBuka() { pmOverlay.style.display = 'flex'; }
  function pmTutup() { pmOverlay.style.display = 'none'; }
  pmOverlay.addEventListener('click', (e) => { if (e.target === pmOverlay) pmTutup(); });
  @if ($errors->has('name') || $errors->has('lokasi') || $errors->has('foto') || $errors->has('password_hapus'))
    pmBuka();
  @endif
</script>
