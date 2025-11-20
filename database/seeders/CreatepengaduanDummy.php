<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreatepengaduanDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        // Ambil semua ID kategori yang tersedia
        $kategori_id = DB::table('kategori_pengaduan')->pluck('kategori_id')->toArray();

        // Ambil semua ID warga yang tersedia
        $warga_id = DB::table('warga')->pluck('warga_id')->toArray();

          foreach (range(1, 100) as $index) {
            DB::table('pengaduan')->insert([
                // Foreign Keys
                'kategori_id' => $faker->randomElement($kategori_id),
                'warga_id' => $faker->randomElement($warga_id),

                // Kolom unik dan regular
                'no_tiket' => 'TKT' . date('Ymd') . str_pad($index, 4, '0', STR_PAD_LEFT),
                'judul' => substr($faker->sentence(3), 0, 50), // Batasi maksimal 50 karakter
                'deskripsi' => substr($faker->text(80), 0, 80), // Batasi maksimal 80 karakter untuk aman
                'status' => $faker->randomElement(['sedang_diproses', 'sudah_selesai']),
                'lokasi_text' => substr($faker->streetAddress(), 0, 80), // Batasi alamat
                'rt' => str_pad($faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT),
                'rw' => str_pad($faker->numberBetween(1, 5), 3, '0', STR_PAD_LEFT),

                // Timestamps akan otomatis terisi
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
}
