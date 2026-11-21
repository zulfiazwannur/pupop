# PuPoP – Project Kelompok 6

Website manajemen limbah popok berbasis ekonomi sirkular (popok → poin → produk), dibangun dengan **Laravel (MVC)** dan **MySQL**.

- Dua role: **Pelanggan** dan **Mitra** (dipilih saat daftar).
- Fitur CRUD: Keranjang, Setor Popok, Lokasi Mitra, Riwayat Transaksi Mitra, Data Usaha, Profil.

Dokumentasi:
- [`docs/PANDUAN-MAMP.md`](docs/PANDUAN-MAMP.md) — cara menjalankan di Mac (MAMP) dan menghubungkan database
- [`docs/DOKUMENTASI-FITUR.md`](docs/DOKUMENTASI-FITUR.md) — alur tiap fitur: tampilan → server → database
- [`database/pupop-schema.sql`](database/pupop-schema.sql) — gambaran skema tabel

Perintah singkat:
```bash
composer install && cp .env.example .env && php artisan key:generate
# isi DB_* di .env (lihat env-mamp.txt), buat database kelompok6, lalu:
php artisan migrate --seed && php artisan storage:link && php artisan serve
```
