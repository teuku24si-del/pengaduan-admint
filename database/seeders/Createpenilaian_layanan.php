<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Createpenilaian_layanan extends Seeder
{
    /**
     * Run the database seeds.
     */
   
    public function run(): void
    {
        // Menggunakan locale Indonesia
        $faker = Factory::create('id_ID');

        // Ambil ID pengaduan yang statusnya 'sudah_selesai' agar lebih logis
        // (Biasanya penilaian diberikan setelah pengaduan selesai)
        $pengaduan_ids = DB::table('pengaduan')
            ->where('status', 'sudah_selesai')
            ->pluck('pengaduan_id')
            ->toArray();

        // Jika tidak ada yang selesai, ambil semua ID saja sebagai fallback
        if (empty($pengaduan_ids)) {
            $pengaduan_ids = DB::table('pengaduan')->pluck('pengaduan_id')->toArray();
        }

        // Template komentar berdasarkan rating
        $komentar_bagus = [
            'Pelayanan sangat cepat dan ramah.',
            'Terima kasih, lampu jalan sudah menyala kembali.',
            'Sangat puas dengan respon petugas lapangan.',
            'Pengerjaan rapi dan petugas sangat membantu.',
            'Luar biasa, masalah langsung beres dalam sehari.',
        ];

        $komentar_cukup = [
            'Respon cukup baik, tapi agak lambat.',
            'Perbaikan sudah selesai, terima kasih.',
            'Lumayan lah, yang penting diperbaiki.',
            'Petugas datang tepat waktu, tapi alatnya kurang lengkap.',
        ];

        $komentar_buruk = [
            'Prosesnya lama sekali.',
            'Petugas kurang ramah saat di lokasi.',
            'Hasil perbaikan kurang rapi.',
            'Harus sering ditanya baru dikerjakan.',
        ];

        foreach (range(1, 100) as $index) {
            // Generate rating 1 - 5
            $rating = $faker->numberBetween(1, 5);

            // Pilih komentar berdasarkan rating
            if ($rating >= 4) {
                $komentar = $faker->randomElement($komentar_bagus);
            } elseif ($rating == 3) {
                $komentar = $faker->randomElement($komentar_cukup);
            } else {
                $komentar = $faker->randomElement($komentar_buruk);
            }

            DB::table('penilaian_layanan')->insert([
                'pengaduan_id' => $faker->randomElement($pengaduan_ids),
                'rating'       => $rating,
                // Memastikan tidak melebihi 255 karakter sesuai migration
                'komentar'     => substr($komentar . ' ' . $faker->sentence(3), 0, 255),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }

        $this->command->info("Seeders penilaian_layanan berhasil membuat 100 data dummy.");
    }
}
