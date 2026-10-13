<?php

namespace App\Http\Controllers\Api; 

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ApiBukuController extends Controller
{
    // GET /api/buku
    public function index(Request $request)
    {
        $query = Buku::with('kategori')
            ->withCount('peminjamans');

        // Pencarian berdasarkan judul atau penulis
        if ($request->filled('cari')) {
            $cari = $request->query('cari');

            $query->where(function ($q) use ($cari) {
                $q->where('judul', 'like', "%{$cari}%")
                  ->orWhere('penulis', 'like', "%{$cari}%");
            });
        }

        // Filter kategori
        if ($request->filled('kategori')) {
            $query->where(
                'kategori_id',
                $request->query('kategori')
            );
        }

        // Filter tahun terbit
        if ($request->filled('tahun')) {
            $query->where(
                'tahun_terbit',
                $request->query('tahun')
            );
        }

        // Data terbaru ditampilkan lebih dahulu
        // 10 data per halaman
        $buku = $query->latest('id')
            ->paginate(10)
            ->withQueryString();

        return response()->json($buku, 200);
    }

    // POST /api/buku
    public function store(StoreBukuRequest $request)
    {
        $buku = Buku::create($request->validated());

        $buku->load('kategori')
             ->loadCount('peminjamans');

        return response()->json([
            'message' => 'Buku berhasil ditambahkan.',
            'data' => $buku,
        ], 201);
    }

    // GET /api/buku/{id}
    public function show($id)
    {
        $buku = Buku::with([
            'kategori',
            'peminjamans',
        ])->withCount('peminjamans')->find($id);

        if (!$buku) {
            return response()->json([
                'message' => 'Buku tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'data' => $buku,
        ], 200);
    }

    // PUT /api/buku/{id} //memperbarui data buku yang sudah ada di database
    public function update(UpdateBukuRequest $request, $id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json([
                'message' => 'Buku tidak ditemukan.',
            ], 404);
        }

        $buku->update($request->validated());

        $buku->load('kategori')
             ->loadCount('peminjamans');

        return response()->json([
            'message' => 'Buku berhasil diperbarui.',
            'data' => $buku,
        ], 200);
    }

    // DELETE /api/buku/{id} 
    public function destroy($id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json([
                'message' => 'Buku tidak ditemukan.',
            ], 404);
        }

        if ($buku->peminjamans()->exists()) {
            return response()->json([
                'message' => 'Buku masih memiliki data peminjaman.',
            ], 422);
        }

        $buku->delete();

        return response()->json([
            'message' => 'Buku berhasil dihapus.',
        ], 200);
    }

    // GET /api/rekap/buku-per-kategori
    public function rekapBukuPerKategori()
    {
        $data = Kategori::withCount('bukus')->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    // GET /api/rekap/peminjaman-per-buku
    public function rekapPeminjamanPerBuku()
    {
        $data = Buku::withCount('peminjamans')
            ->with('kategori')
            ->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }
}