<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Createkategori_pengaduan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $faker = Factory::create();

        // Data kategori contoh
        $kategoriNames = [
            'Infrastruktur Jalan',
            'Kebersihan Lingkungan',
            'Penerangan Jalan',
            'Drainase dan Saluran Air',
            'Keamanan Lingkungan',
            'Kesehatan Masyarakat',
            'Administrasi Kependudukan',
            'Fasilitas Umum',
            'Bencana Alam',
            'Layanan Publik',
            'Pengaduan Sosial',
            'Lingkungan Hidup',
            'Transportasi',
            'Pendidikan',
            'Kesejahteraan Masyarakat'
        ];

        $prioritasOptions = ['Rendah', 'Sedang', 'Tinggi', 'Kritis'];

        foreach (range(1, 15) as $index) {
            DB::table('kategori_pengaduan')->insert([
                'nama' => $kategoriNames[$index - 1] ?? $faker->words(2, true),
                'sla_hari' => $faker->numberBetween(1, 14),
                'prioritas' => $faker->randomElement($prioritasOptions),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
