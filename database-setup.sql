CREATE DATABASE IF NOT EXISTS kelompok6
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- User khusus aplikasi (BUKAN root), hak akses hanya pada database kelompok6.
CREATE USER IF NOT EXISTS 'kelompok6_app'@'localhost' IDENTIFIED BY 'GANTI_PASSWORD_INI';
GRANT ALL PRIVILEGES ON kelompok6.* TO 'kelompok6_app'@'localhost';
FLUSH PRIVILEGES;
