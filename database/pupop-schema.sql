-- =====================================================================
-- PuPoP - skema database (REFERENSI, untuk dibaca / dicek di phpMyAdmin)
--
-- Cara UTAMA membuat tabel adalah:  php artisan migrate --seed
-- File ini hanya gambaran struktur yang sama persis dengan folder
-- database/migrations. JANGAN diimpor lalu menjalankan migrate pada
-- database yang sama (tabel akan bentrok). Pilih salah satu.
-- =====================================================================

CREATE DATABASE IF NOT EXISTS kelompok6 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE kelompok6;

-- Akun. role = 'pelanggan' | 'mitra' (dipilih saat daftar)
CREATE TABLE users (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  email_verified_at TIMESTAMP NULL,
  password VARCHAR(255) NOT NULL,                -- bcrypt
  foto_profil VARCHAR(255) NULL,
  role VARCHAR(20) NOT NULL DEFAULT 'pelanggan',
  lokasi VARCHAR(255) NULL,
  poin INT UNSIGNED NOT NULL DEFAULT 0,
  saldo BIGINT UNSIGNED NOT NULL DEFAULT 0,      -- rupiah (mitra)
  mitra_pilihan_id BIGINT UNSIGNED NULL,         -- mitra favorit pelanggan
  remember_token VARCHAR(100) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB;

-- Pengelolaan Lokasi Mitra
CREATE TABLE lokasi_mitra (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  nama VARCHAR(100) NOT NULL,
  kota VARCHAR(100) NOT NULL,
  alamat VARCHAR(255) NOT NULL,
  jam_buka VARCHAR(5) NOT NULL DEFAULT '08:00',
  jam_tutup VARCHAR(5) NOT NULL DEFAULT '17:00',
  gambar VARCHAR(255) NULL,
  aktif TINYINT(1) NOT NULL DEFAULT 1,
  alamat_lama VARCHAR(255) NULL,
  alasan_pindah VARCHAR(255) NULL,
  tanggal_pindah DATE NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

ALTER TABLE users
  ADD FOREIGN KEY (mitra_pilihan_id) REFERENCES lokasi_mitra(id) ON DELETE SET NULL;

-- Pengelolaan Data Usaha (1 mitra = 1 data usaha)
CREATE TABLE data_usaha (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL UNIQUE,
  nama_usaha VARCHAR(100) NOT NULL,
  jenis_usaha VARCHAR(100) NULL,
  telepon VARCHAR(20) NULL,
  deskripsi TEXT NULL,
  jam_buka VARCHAR(5) NOT NULL DEFAULT '08:00',
  jam_tutup VARCHAR(5) NOT NULL DEFAULT '17:00',
  kapasitas INT UNSIGNED NOT NULL DEFAULT 100,
  terisi DECIMAL(10,2) NOT NULL DEFAULT 0,
  status_buka TINYINT(1) NOT NULL DEFAULT 0,
  catatan_status VARCHAR(255) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Katalog produk tukar poin
CREATE TABLE produk (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  kategori VARCHAR(30) NOT NULL,
  deskripsi TEXT NOT NULL,
  gambar VARCHAR(255) NOT NULL,
  poin INT UNSIGNED NOT NULL DEFAULT 30,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB;

-- Pengelolaan Keranjang
CREATE TABLE keranjang (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  produk_id BIGINT UNSIGNED NOT NULL,
  qty INT UNSIGNED NOT NULL DEFAULT 1,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  UNIQUE KEY keranjang_user_produk (user_id, produk_id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (produk_id) REFERENCES produk(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Penukaran (hasil checkout keranjang)
CREATE TABLE penukaran (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  lokasi_mitra_id BIGINT UNSIGNED NULL,
  jumlah_item INT UNSIGNED NOT NULL,
  total_poin INT UNSIGNED NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (lokasi_mitra_id) REFERENCES lokasi_mitra(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE penukaran_item (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  penukaran_id BIGINT UNSIGNED NOT NULL,
  produk_id BIGINT UNSIGNED NULL,
  nama VARCHAR(100) NOT NULL,
  kategori VARCHAR(30) NOT NULL,
  qty INT UNSIGNED NOT NULL,
  poin_satuan INT UNSIGNED NOT NULL,
  FOREIGN KEY (penukaran_id) REFERENCES penukaran(id) ON DELETE CASCADE,
  FOREIGN KEY (produk_id) REFERENCES produk(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Pengelolaan Data Setor Popok (status: menunggu | diterima)
CREATE TABLE setor_popok (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  lokasi_mitra_id BIGINT UNSIGNED NULL,
  kode VARCHAR(12) NOT NULL UNIQUE,
  jumlah INT UNSIGNED NOT NULL,
  poin_didapat INT UNSIGNED NOT NULL DEFAULT 0,
  status VARCHAR(15) NOT NULL DEFAULT 'menunggu',
  diterima_pada TIMESTAMP NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  INDEX (lokasi_mitra_id, status),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (lokasi_mitra_id) REFERENCES lokasi_mitra(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Pengelolaan Riwayat Transaksi Mitra (tipe: setor | reward | tarik; sumber: otomatis | manual)
CREATE TABLE transaksi_mitra (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  setor_popok_id BIGINT UNSIGNED NULL,
  tipe VARCHAR(10) NOT NULL,
  sumber VARCHAR(10) NOT NULL DEFAULT 'otomatis',
  nama VARCHAR(100) NOT NULL,
  keterangan VARCHAR(255) NOT NULL,
  tanggal DATE NOT NULL,
  jumlah_pcs DECIMAL(10,2) NOT NULL DEFAULT 0,
  nominal BIGINT UNSIGNED NOT NULL DEFAULT 0,
  poin INT UNSIGNED NOT NULL DEFAULT 0,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  INDEX (user_id, tanggal),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (setor_popok_id) REFERENCES setor_popok(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Permintaan pickup mitra (status: menunggu | selesai)
CREATE TABLE pickup_mitra (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  lokasi_mitra_id BIGINT UNSIGNED NULL,
  tanggal DATE NOT NULL,
  catatan VARCHAR(255) NULL,
  status VARCHAR(10) NOT NULL DEFAULT 'menunggu',
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (lokasi_mitra_id) REFERENCES lokasi_mitra(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Tabel bawaan Laravel (sessions, cache, jobs, password_reset_tokens) dibuat oleh php artisan migrate.
