<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\KategoriSeeder;
use Database\Seeders\AnggotaSeeder;
use Database\Seeders\BukuSeeder;
use Database\Seeders\PeminjamanSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            KategoriSeeder::class,
            AnggotaSeeder::class,
            BukuSeeder::class,
            PeminjamanSeeder::class,
        ]);
    }
}