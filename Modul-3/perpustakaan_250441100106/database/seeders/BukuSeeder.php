<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;
use App\Models\Kategori;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        $novel = Kategori::where('nama', 'Novel')->first();
        $fantasi = Kategori::where('nama', 'Fantasi')->first();
        $pengembanganDiri = Kategori::where('nama', 'Pengembangan Diri')->first();

        Buku::factory()->create([
            'kategori_id' => $novel->id,
            'judul' => 'Laskar Pelangi',
            'penulis' => 'Andrea Hirata',
            'tahun_terbit' => 2005,
        ]);

        Buku::factory()->create([
            'kategori_id' => $fantasi->id,
            'judul' => 'Bumi',
            'penulis' => 'Tere Liye',
            'tahun_terbit' => 2014,
        ]);

        Buku::factory()->create([
            'kategori_id' => $novel->id,
            'judul' => 'Negeri 5 Menara',
            'penulis' => 'Ahmad Fuadi',
            'tahun_terbit' => 2009,
        ]);

        Buku::factory()->create([
            'kategori_id' => $pengembanganDiri->id,
            'judul' => 'Filosofi Teras',
            'penulis' => 'Henry Manampiring',
            'tahun_terbit' => 2018,
        ]);

        Buku::factory()->create([
            'kategori_id' => $pengembanganDiri->id,
            'judul' => 'Atomic Habits',
            'penulis' => 'James Clear',
            'tahun_terbit' => 2018,
        ]);
    }
}