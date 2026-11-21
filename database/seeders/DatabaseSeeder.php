<?php

namespace Database\Seeders;

use App\Models\DataUsaha;
use App\Models\LokasiMitra;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Data awal: katalog produk + 4 akun mitra contoh (lengkap dengan lokasi & data usaha)
 * + 1 akun pelanggan contoh. Password semua akun contoh: password123
 * (hanya untuk demo/pengembangan, hapus sebelum dipakai sungguhan).
 */
class DatabaseSeeder extends Seeder
{
    private const SALDO_AWAL_MITRA = 500000;
    private const POIN_AWAL_MITRA = 200;

    public function run(): void
    {
        $produk = [
            ['Sabun Mandi Bayi - My Baby', 'Rumah Tangga', 'Sabun cuci piring dengan berat 100ml, bisa digunakan di rumah sudah berbahan food grade', 'sabunmandibayi.png'],
            ['Pupuk ZA Plus', 'Pertanian', 'Pupuk yang bermanfaat bagi tanaman dengan formula NPK terlengkap.', 'pupuknpk.png'],
            ['Sabun Batang', 'Rumah Tangga', 'Sabun batang anti bakteri yang wanginya segar dan melembabkan kulit keluarga.', 'sabunbatang.png'],
            ['Shampo Bayi', 'Rumah Tangga', 'Shampo anti pedih di mata, membuat rambut si kecil halus dan mudah disisir.', 'shampoobayi.png'],
            ['Tisu Basah', 'Rumah Tangga', 'Tisu basah bebas alkohol, sangat higienis untuk membersihkan tangan atau peralatan.', 'tisubasah.png'],
        ];
        foreach ($produk as [$nama, $kategori, $deskripsi, $gambar]) {
            Produk::updateOrCreate(['nama' => $nama], [
                'kategori' => $kategori, 'deskripsi' => $deskripsi, 'gambar' => $gambar, 'poin' => 30,
            ]);
        }

        $mitra = [
            ['Mitra 1 - Sudimoro', 'Malang', 'Jl. Sudimoro, No. 09, Kec. Mojolangu', 'sudimoro.png'],
            ['Mitra 2 - Kalpataru', 'Malang', 'Jl. Kalpataru, No. 09, Kec. Lowokwaru', 'kalpataru.png'],
            ['Mitra 3 - Dinoyo', 'Malang', 'Jl. MT. Haryono, No. 09, Kec. Lowokwaru', 'dinoyo.png'],
            ['Mitra 4 - Sigura', 'Malang', 'Jl. Sigura-gura, No. 09, Kec. Sukun', 'sigura.png'],
        ];
        foreach ($mitra as $i => [$nama, $kota, $alamat, $gambar]) {
            $email = 'mitra' . ($i + 1) . '@pupop.test';
            $u = User::where('email', $email)->first();

            if (! $u) {
                $u = new User(['name' => $nama, 'email' => $email, 'password' => 'password123']);
                $u->role = 'mitra';
                $u->saldo = self::SALDO_AWAL_MITRA;   // Saldo Pupin awal (Rp)
                $u->poin = self::POIN_AWAL_MITRA;     // Poin Pupin awal
                $u->save();
            } elseif ($u->saldo == 0) {
                // Mitra hasil seed sebelumnya: beri saldo awal bila masih 0 agar bisa uji tarik saldo.
                $u->saldo = self::SALDO_AWAL_MITRA;
                $u->poin = max($u->poin, self::POIN_AWAL_MITRA);
                $u->save();
            }

            // Pulihkan lokasi bila belum ada (mis. terhapus saat uji coba) dan pastikan aktif.
            $lokasi = LokasiMitra::where('user_id', $u->id)->first();
            if (! $lokasi) {
                $lokasi = new LokasiMitra(['nama' => $nama, 'kota' => $kota, 'alamat' => $alamat, 'jam_buka' => '08:00', 'jam_tutup' => '17:00']);
                $lokasi->user_id = $u->id;
                $lokasi->gambar = $gambar;
            }
            $lokasi->aktif = true;
            $lokasi->save();

            if (! DataUsaha::where('user_id', $u->id)->exists()) {
                $usaha = new DataUsaha(['nama_usaha' => $nama, 'jenis_usaha' => 'Bank sampah popok', 'telepon' => '081234567890',
                    'jam_buka' => '08:00', 'jam_tutup' => '17:00', 'kapasitas' => 100, 'status_buka' => true]);
                $usaha->user_id = $u->id;
                $usaha->save();
            }
        }

        if (! User::where('email', 'pelanggan@pupop.test')->exists()) {
            $p = new User(['name' => 'Pelanggan Contoh', 'email' => 'pelanggan@pupop.test', 'password' => 'password123']);
            $p->role = 'pelanggan';
            $p->save();
        }
    }
}
