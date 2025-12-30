<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Createtindak_lanjut extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menggunakan locale Indonesia
        $faker = Factory::create('id_ID');

        // Ambil semua ID pengaduan yang sudah dibuat oleh CreatepengaduanDummy
        $pengaduan_ids = DB::table('pengaduan')->pluck('pengaduan_id')->toArray();

        // Jika tabel pengaduan kosong, tampilkan peringatan
        if (empty($pengaduan_ids)) {
            $this->command->warn("Tabel pengaduan kosong! Jalankan CreatepengaduanDummy terlebih dahulu.");
            return;
        }

        // Daftar nama petugas simulasi
        $daftar_petugas = [
            'Budi Santoso', 'Siti Aminah', 'Agus Prayitno',
            'Dewi Lestari', 'Eko Saputra', 'Rina Wijaya',
            'Hendra Kurniawan', 'Ani Suryani'
        ];

        // Daftar catatan berdasarkan aksi
        $catatan_selesai = [
            'Perbaikan sudah dilakukan oleh tim teknis.',
            'Masalah telah diselesaikan di lokasi.',
            'Sudah dilakukan penggantian komponen yang rusak.',
            'Laporan telah ditindaklanjuti dan selesai.',
            'Kondisi di lapangan sudah kembali normal.'
        ];

        $catatan_ditolak = [
            'Lokasi tidak ditemukan.',
            'Laporan tidak sesuai dengan fakta di lapangan.',
            'Bukan merupakan wewenang pihak kami.',
            'Data pendukung pengaduan tidak lengkap.',
            'Pengaduan sudah pernah dilaporkan sebelumnya.'
        ];

        foreach (range(1, 100) as $index) {
            $aksi = $faker->randomElement(['selesai', 'ditolak']);

            // Pilih catatan berdasarkan aksi yang dipilih
            $catatan = ($aksi == 'selesai')
                ? $faker->randomElement($catatan_selesai)
                : $faker->randomElement($catatan_ditolak);

            DB::table('tindak_lanjut')->insert([
                // Mengambil pengaduan secara acak dari data yang ada
                'pengaduan_id' => $faker->randomElement($pengaduan_ids),

                'petugas'      => $faker->randomElement($daftar_petugas),
                'aksi'         => $aksi,

                // Memastikan panjang catatan tidak melebihi limit migration (100 karakter)
                'catatan'      => substr($catatan, 0, 100),

                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }

        $this->command->info("Seeders tindak_lanjut berhasil membuat 100 data dummy.");
    }
}
