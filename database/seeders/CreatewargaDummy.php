<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreatewargaDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $faker = Factory::create();

    foreach (range(1, 40) as $index) {
        DB::table('warga')->insert([
            'nama' => $faker->name(),
            'agama'  => $faker->randomElement(['Islam', 'Kristen','Katolik','Hindu','Budha','Kong Hucu']),
            'pekerjaan'   => $faker->jobTitle(),
            'jenis_kelamin'  => $faker->randomElement(['Laki-laki', 'Perempuan']),
            'email'      => $faker->unique()->safeEmail,
            'No_Hp'      => $faker->numerify('08##########'),
        ]);
    }
}
}
