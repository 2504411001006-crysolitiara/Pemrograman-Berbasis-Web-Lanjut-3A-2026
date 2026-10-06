<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        $anggota = Anggota::all();
        $buku = Buku::all();

        Peminjaman::factory()->create([
            'anggota_id' => $anggota[0]->id,
            'buku_id' => $buku[0]->id,
        ]);

        Peminjaman::factory()->create([
            'anggota_id' => $anggota[1]->id,
            'buku_id' => $buku[1]->id,
        ]);

        Peminjaman::factory()->create([
            'anggota_id' => $anggota[2]->id,
            'buku_id' => $buku[2]->id,
        ]);
    }
}