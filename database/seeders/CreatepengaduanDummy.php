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
        // Menggunakan locale Indonesia
        $faker = Factory::create('id_ID');

        // Ambil semua ID kategori yang tersedia
        $kategori_id = DB::table('kategori_pengaduan')->pluck('kategori_id')->toArray();

        // Ambil semua ID warga yang tersedia
        $warga_id = DB::table('warga')->pluck('warga_id')->toArray();

        // Daftar kata kunci pengaduan untuk membuat data lebih realistis
        $topik_pengaduan = [
            'Lampu jalan mati', 'Sampah menumpuk', 'Jalan berlubang',
            'Pipa bocor', 'Drainase mampet', 'Pohon tumbang',
            'Kebisingan tetangga', 'Keamanan lingkungan', 'Fasilitas umum rusak'
        ];

        foreach (range(1, 100) as $index) {
            $topik = $faker->randomElement($topik_pengaduan);

            DB::table('pengaduan')->insert([
                // Foreign Keys
                'kategori_id' => $faker->randomElement($kategori_id),
                'warga_id'    => $faker->randomElement($warga_id),

                // Format No Tiket: TKT-20231027-0001
                'no_tiket'    => 'TKT' . date('Ymd') . str_pad($index, 4, '0', STR_PAD_LEFT),

                // Judul menggunakan topik khas Indonesia
                'judul'       => substr($topik . " di " . $faker->streetName(), 0, 50),

                // Deskripsi menggunakan teks bahasa Indonesia
                'deskripsi'   => substr("Mohon ditindaklanjuti mengenai " . strtolower($topik) . " yang terjadi di sekitar lingkungan kami. " . $faker->sentence(5), 0, 80),

                'status'      => $faker->randomElement(['sedang_diproses', 'sudah_selesai']),

                // Alamat Indonesia
                'lokasi_text' => substr($faker->address(), 0, 80),

                // Format RT/RW Indonesia (Contoh: 001, 005)
                'rt'          => str_pad($faker->numberBetween(1, 15), 3, '0', STR_PAD_LEFT),
                'rw'          => str_pad($faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT),

                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
