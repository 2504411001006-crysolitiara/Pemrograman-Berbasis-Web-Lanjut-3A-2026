<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::factory()->create([
            'nama' => 'Novel',
        ]);

        Kategori::factory()->create([
            'nama' => 'Fantasi',
        ]);

        Kategori::factory()->create([
            'nama' => 'Pengembangan Diri',
        ]);
    }
}